<?php

declare(strict_types=1);

namespace App\Support;

use Exception;

/**
 * Class to compress and decompress LZ2. Which is used in GFX for ALttP.
 *
 * Usage (decompress):
 *
 * ```php
 * $lz2 = new Lz2();
 *
 * $data = array_values(unpack("C*", file_get_contents('newitems.gfx')));
 *
 * $uncompressed  = $lz2->decompress($data);
 *
 * file_put_contents('newitems.bin', pack('C*', ...$uncompressed));
 * ```
 *
 * compress:
 *
 * ```php
 * $lz2 = new Lz2();
 *
 * $data = array_values(unpack("C*", file_get_contents('newitems.bin')));
 *
 * $compressed  = $lz2->compress($data);
 *
 * file_put_contents('newitems.gfx', pack('C*', ...$compressed));
 * ```
 *
 * Thank you to Smallhacker for the base (C#) code on this.
 */
final class Lz2
{
    const DIRECT_COPY = 0;
    const BYTE_FILL = 1;
    const WORD_FILL = 2;
    const INCREASE_FILL = 3;
    const REPEAT = 4;
    const LONG_COMMAND = 7;

    // How many bytes each command must encode to outdo Direct Copy
    const COMMAND_WEIGHT = [
        0,  // Direct Copy
        3,  // Byte Fill
        4,  // Word Fill
        3,  // Increasing Fill
        4,  // Repeat
    ];
    protected $reverse_bytes = false;

    /**
     * In Lz2 for ALttP, they use 2 different Lz2 algs, where the Repeat command can either have the address
     * reversed or not. False is what you would want generally for GFX (de)compression. Other areas such as
     * the sprite dmg table would be true.
     *
     * @param bool $reverse_bytes Reverse bytes in repeat command.
     *
     * @return void
     */
    public function __construct(bool $reverse_bytes = false)
    {
        $this->reverse_bytes = $reverse_bytes;
    }

    /**
     * Get compressed array of bytes.
     *
     * @param array $data array of byte data to compress
     *
     * @throws Exception if invoked on empty data
     */
    public function compress(array $data): array
    {
        if (empty($data)) {
            throw new Exception("Data is null.");
        }

        $output = [];
        $position = 0;
        $length = count($data);

        $directCopyBuffer = [];

        while ($position < $length) {
            $currentByte = $data[$position++];
            $nextByte = 0;
            $repeatAddress = 0;

            $byteCount = array_fill(0, self::REPEAT + 1, 0);

            // Evaluate Byte Fill
            $byteCount[self::BYTE_FILL] = 1;
            for ($i = $position; $i < $length; $i++) {
                if ($data[$i] !== $currentByte) {
                    break;
                }
                $byteCount[self::BYTE_FILL]++;
            }

            // Evaluate Word Fill
            $byteCount[self::WORD_FILL] = 1;
            if ($position < $length) {
                $byteCount[self::WORD_FILL]++;
                $nextByte = $data[$position];
                $oddEven = 0;
                for ($i = $position + 1; $i < $length; $i++, $oddEven++) {
                    $currentOddEvenByte = ($oddEven & 1) == 0 ? $currentByte : $nextByte;
                    if ($data[$i] != $currentOddEvenByte) {
                        break;
                    }
                    $byteCount[self::WORD_FILL]++;
                }
            }

            // Evaluate Increasing Fill
            $byteCount[self::INCREASE_FILL] = 1;
            $increaseByte = ($currentByte + 1);
            for ($i = $position; $i < $length; $i++) {
                if ($data[$i] !== $increaseByte++) {
                    break;
                }
                $byteCount[self::INCREASE_FILL]++;
            }

            // Evaluate Repeat
            $byteCount[self::REPEAT] = 0;
            //Slow O(n^2) brute force algorithm for now
            $maxAddressInt = min(0xFFFF, $position - 2);
            if ($maxAddressInt >= 0) {
                for ($start = 0; $start <= $maxAddressInt; $start++) {
                    $chunkSize = 0;

                    for ($pos = $position - 1; $pos < $length && $chunkSize < 1023; $pos++) {
                        if ($data[$pos] != $data[$start + $chunkSize]) {
                            break;
                        }
                        $chunkSize++;
                    }

                    if ($chunkSize > $byteCount[self::REPEAT]) {
                        $repeatAddress = $start;
                        $byteCount[self::REPEAT] = $chunkSize;
                    }
                }
            }

            // Choose next command
            $nextCommand = self::DIRECT_COPY; // Default command unless anything better is found
            $nextCommandByteCount = 1;
            for ($commandSuggestion = 1; $commandSuggestion < count($byteCount); $commandSuggestion++) {
                // Would this command save any space?
                if ($byteCount[$commandSuggestion] >= self::COMMAND_WEIGHT[$commandSuggestion]) {
                    // Is it better than what we already have?
                    if ($byteCount[$commandSuggestion] > $nextCommandByteCount) {
                        $nextCommand = $commandSuggestion;
                        $nextCommandByteCount = $byteCount[$commandSuggestion];
                    }
                }
            }

            // Direct Copy commands are incrementally built.
            // Output or add to as needed.
            if ($nextCommand == self::DIRECT_COPY) {
                array_push($directCopyBuffer, $currentByte);
                if (count($directCopyBuffer) >= 1023) {
                    // Direct Copy has a maximum length of 1023 bytes
                    $this->outputCommand(self::DIRECT_COPY, count($directCopyBuffer), $output);
                    foreach ($directCopyBuffer as $buffer) {
                        array_push($output, $buffer);
                    }
                    $directCopyBuffer = [];
                }
            } else {
                if (!empty($directCopyBuffer)) {
                    // Direct Copy command in progress. Write it to output before proceeding
                    $this->outputCommand(self::DIRECT_COPY, count($directCopyBuffer), $output);
                    foreach ($directCopyBuffer as $buffer) {
                        array_push($output, $buffer);
                    }
                    $directCopyBuffer = [];
                }
            }

            // Output command
            switch ($nextCommand) {
                case self::DIRECT_COPY:
                    // Already handled above
                    break;
                case self::BYTE_FILL:
                    $this->outputCommand($nextCommand, $nextCommandByteCount, $output);
                    array_push($output, $currentByte);
                    break;
                case self::WORD_FILL:
                    $this->outputCommand($nextCommand, $nextCommandByteCount, $output);
                    array_push($output, $currentByte);
                    array_push($output, $nextByte);
                    break;
                case self::INCREASE_FILL:
                    $this->outputCommand($nextCommand, $nextCommandByteCount, $output);
                    array_push($output, $currentByte);
                    break;
                case self::REPEAT:
                    $this->outputCommand($nextCommand, $nextCommandByteCount, $output);
                    if ($this->reverse_bytes) {
                        array_push($output, $repeatAddress >> 8, $repeatAddress % 256);
                    } else {
                        array_push($output, $repeatAddress % 256, $repeatAddress >> 8);
                    }
                    break;
            }

            $position += ($nextCommandByteCount) - 1;
        }

        // Output Direct Copy buffer if it exists
        if (!empty($directCopyBuffer)) {
            $this->outputCommand(self::DIRECT_COPY, count($directCopyBuffer), $output);
            foreach ($directCopyBuffer as $buffer) {
                array_push($output, $buffer);
            }
        }

        array_push($output, 0xFF);
        return $output;
    }

    /**
     * Get Decompressed LZ2 byte array.
     *
     * Confidence that this works properly, 99%.
     *
     * @param array $compressedData array of bytes
     * @param int $start starting point in array
     *
     * @throws Exception if encounters an unknown decompress command or invoked on empty data
     */
    public function decompress(array $compressedData, int $start = 0): array
    {
        if (empty($compressedData)) {
            throw new Exception("Compressed data is null.");
        }

        $output = [];
        $position = $start;

        while (true) {
            $commandLength = $compressedData[$position++];
            if ($commandLength == 0xFF) {
                break;
            }

            $command = ($commandLength >> 5);

            if ($command == self::LONG_COMMAND) {
                $length = $compressedData[$position++];
                $length |= (($commandLength & 3) << 8);
                $length++;
                $command = (($commandLength >> 2) & 7);
            } else {
                $length = ($commandLength & 0x1F) + 1;
            }

            switch ($command) {
                case self::DIRECT_COPY:
                    for ($i = 0; $i < $length; $i++) {
                        array_push($output, $compressedData[$position++]);
                    }
                    break;
                case self::BYTE_FILL:
                    $fillByte = $compressedData[$position++];
                    for ($i = 0; $i < $length; $i++) {
                        array_push($output, $fillByte);
                    }
                    break;
                case self::WORD_FILL:
                    $fillByteEven = $compressedData[$position++];
                    $fillByteOdd = $compressedData[$position++];
                    for ($i = 0; $i < $length; $i++) {
                        $thisByte = ($i & 1) == 0 ? $fillByteEven : $fillByteOdd;
                        array_push($output, $thisByte);
                    }
                    break;
                case self::INCREASE_FILL:
                    $increaseFillByte = $compressedData[$position++];
                    for ($i = 0; $i < $length; $i++) {
                        array_push($output, $increaseFillByte++);
                    }
                    break;
                case self::REPEAT:
                    if ($this->reverse_bytes) {
                        $origin = (($compressedData[$position++] << 8) | $compressedData[$position++]);
                    } else {
                        $origin = ($compressedData[$position++] | ($compressedData[$position++] << 8));
                    }
                    for ($i = 0; $i < $length; $i++) {
                        $output[] = $output[$origin++];
                    }
                    break;
                default:
                    throw new Exception("Invalid Lz2 command: " . $command);
            }
        }

        return $output;
    }

    /**
     * prep command and add to byte stream
     *
     * @param int $command command to be added to byte array
     * @param int $length number of bytes this command is related to
     * @param array $output reference array we are adding the command to
     */
    private function outputCommand(int $command, int $length, array &$output): void
    {
        if ($length > 32) {
            // Long command
            $length--;
            $firstByte = (0xE0 | ($command << 2) | ($length >> 8));
            $secondByte = $length;
            array_push($output, $firstByte);
            array_push($output, $secondByte % 256);
        } else {
            // Short command
            $length--;
            $commandLength = ($command << 5 | $length);
            array_push($output, $commandLength);
        }
    }
}

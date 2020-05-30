<?php

namespace ALttP\Support;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

/**
 * Flips wrapper class for creating/applying delta patches on files.
 *
 * Specifically BPS for our needs, other functonality is not modeled.
 */
class Flips
{
    /**
     * Generate a BPS file from source and target files.
     *
     * @param string $original location of source file
     * @param string $modified location of target file
     * @param array  $metaData data to be added to metadata, will be encoded as json
     *
     * @throws \Exception if unable to create temporary files or create the bps
     *
     * @return string
     */
    public function createBpsFromFiles(string $original, string $modified, array $metaData = []): string
    {
        if (!is_readable($modified) || !is_readable($original)) {
            throw new \Exception('Source Files not readable');
        }

        $tmp_file = tempnam(sys_get_temp_dir(), 'Flips-');
        if ($tmp_file === false) {
            // @codeCoverageIgnoreStart
            throw new \Exception('Unable to create tmp file');
            // @codeCoverageIgnoreEnd
        }

        $tmp_file_meta = tempnam(sys_get_temp_dir(), 'Flips-meta-');
        if ($tmp_file_meta === false) {
            // @codeCoverageIgnoreStart
            throw new \Exception('Unable to create tmp meta file');
            // @codeCoverageIgnoreEnd
        }
        file_put_contents($tmp_file_meta, json_encode($metaData, JSON_FORCE_OBJECT));

        $system = php_uname('s') == 'Darwin' ? 'macos' : 'linux';

        $proc = new Process([
            base_path("bin/flips/$system/flips"),
            "-m$tmp_file_meta",
            '--create',
            '--bps',
            $original,
            $modified,
            $tmp_file,
        ]);

        if ('phpdbg' === PHP_SAPI) {
            // @codeCoverageIgnoreStart
            $proc->setTty(true);
            $proc->disableOutput();
            // @codeCoverageIgnoreEnd
        }

        Log::debug($proc->getCommandLine());
        $proc->run();

        if (!$proc->isSuccessful()) {
            // @codeCoverageIgnoreStart
            Log::debug($proc->getOutput());
            Log::debug($proc->getErrorOutput());
            throw new \Exception('Unable to generate');
            // @codeCoverageIgnoreEnd
        }

        $bps_string = file_get_contents($tmp_file);
        // cleanup
        unlink($tmp_file);

        if ($bps_string === false) {
            // @codeCoverageIgnoreStart
            throw new \Exception('BPS data creation failed');
            // @codeCoverageIgnoreEnd
        }

        return $bps_string;
    }

    /**
     * Apply a BPS file to a source file and get back a data string of patched file.
     *
     * @param string $original Source file location to apply patch to
     * @param string $bps      BPS file location
     *
     * @throws \Exception if unable to create temporary files or create the patched file
     *
     * @return string
     */
    public function applyBpsToFile(string $original, string $bps): string
    {
        if (!is_readable($bps) || !is_readable($original)) {
            throw new \Exception('Source Files not readable');
        }

        $tmp_file = tempnam(sys_get_temp_dir(), 'Flips-');
        if ($tmp_file === false) {
            // @codeCoverageIgnoreStart
            throw new \Exception('Unable to create tmp file');
            // @codeCoverageIgnoreEnd
        }

        $system = php_uname('s') == 'Darwin' ? 'macos' : 'linux';

        $proc = new Process([
            base_path("bin/flips/$system/flips"),
            '--apply',
            $bps,
            $original,
            $tmp_file,
        ]);

        if ('phpdbg' === PHP_SAPI) {
            // @codeCoverageIgnoreStart
            $proc->setTty(true);
            $proc->disableOutput();
            // @codeCoverageIgnoreEnd
        }

        Log::debug($proc->getCommandLine());
        $proc->run();

        if (!$proc->isSuccessful()) {
            // @codeCoverageIgnoreStart
            Log::debug($proc->getOutput());
            Log::debug($proc->getErrorOutput());
            throw new \Exception('Unable to generate');
            // @codeCoverageIgnoreEnd
        }

        $modified = file_get_contents($tmp_file);
        // cleanup
        unlink($tmp_file);

        if ($modified === false) {
            // @codeCoverageIgnoreStart
            throw new \Exception('BPS application failed');
            // @codeCoverageIgnoreEnd
        }

        return $modified;
    }
}

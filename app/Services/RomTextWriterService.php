<?php

namespace App\Services;

use App\Graph\Item;
use App\Rom;
use App\Graph\World;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Yaml\Yaml;

/**
 * Service class to update all the textboxes for the game.
 */
class RomTextWriterService
{
    private const LOCATIONS = [
        'mastersword_pedestal_translated' => "Master Sword Pedestal",
        'tablet_bombos_book' => "Bombos Tablet",
        'tablet_ether_book' => "Ether Tablet",
    ];

    /** @var Collection<array> */
    public Collection $strings;

    public function __construct()
    {
        $this->strings = cache()->rememberForever('textboxes', function () {
            return collect([
                'items' => Yaml::parse(file_get_contents(base_path('strings/textboxes.yml'))),
                'locations' => Yaml::parse(file_get_contents(base_path('strings/locations.yml'))),
                'uncle' => $this->getTextArray('strings/uncle.txt'),
                'tavern_man' => $this->getTextArray('strings/tavern_man.txt'),
                'blind' => $this->getTextArray('strings/blind.txt'),
                'ganon_1' => $this->getTextArray('strings/ganon_1.txt'),
                'triforce' => $this->getTextArray('strings/triforce.txt'),
            ]);
        });
    }

    /**
     * determine the textboxes to write and write them to the rom.
     *
     * @param World $world world to pull data from
     * @param Rom $rom Rom to write data to
     *
     * @return void
     */
    public function writeTextToRom(World $world, Rom $rom): void
    {
        foreach (self::LOCATIONS as $key => $location) {
            $world_location = $world->getLocation($location);
            if (!$world_location) {
                continue;
            }

            $item = $world_location->item ?? Item::get('Nothing', $world->id);
            $rom->setText($key, $this->strings['items'][$item->raw_name][$location]);
        }

        $rom->setText('uncle_leaving_text', Arr::first(fy_shuffle($this->strings['uncle'])));

        if ($world->config('spoil.BootsLocation', false)) {
            $boots_location = $world->getLocationsWithItem(Item::get('PegasusBoots', $world->id))->first();
            Log::info('Boots revealed');
            if ($world->collected_items->has('PegasusBoots')) {
                $uncleBootsText = "Lonk! Boots\nare on\nyour feet.";
            } else if (!$boots_location) {
                $uncleBootsText = "I couldn't\nfind the Boots\ntoday.\nRIP me.";
            } else {
                $uncleBootsText = "Lonk! Boots\nare in the\n" . $boots_location->getAttribute('name');
                switch ($boots_location->getAttribute('name')) {
                    case "Link's House":
                        $uncleBootsText = "Lonk!\nYou'll never\nfind the boots.";
                        break;
                    case "Maze Race":
                        $uncleBootsText = "Boots at race?\nSeed confirmed\nimpossible.";
                        break;
                    case "Link's Uncle":
                        $uncleBootsText = "Ganon offered\nme the Boots.\nTime to run!";
                        break;
                }
            }
            $rom->setText('uncle_leaving_text', $uncleBootsText);
            $rom->setText('sign_east_of_links_house', $uncleBootsText);
        }

        $green_pendant_location = $world->getLocationsWithItem(Item::get('PendantOfCourage', $world->id))->first();

        $rom->setText('sahasrahla_bring_courage', "Want something\nfor free? Go\nearn the green\npendant in\n"
            . ($this->strings['locations'][preg_replace('/:\d*/', '', $green_pendant_location->getAttribute('name'))]['region'] ?? 'I forget?')
            . "\nand I'll give\nyou something.");

        $crystal5_location = $world->getLocationsWithItem(Item::get('Crystal5', $world->id))->first();
        $crystal6_location = $world->getLocationsWithItem(Item::get('Crystal6', $world->id))->first();

        $rom->setText('bomb_shop', "bring me the\ncrystals from\n"
            . ($this->strings['locations'][preg_replace('/:\d*/', '', $crystal5_location->getAttribute('name'))]['region'] ?? 'I forget?')
            . "\nand\n"
            . ($this->strings['locations'][preg_replace('/:\d*/', '', $crystal6_location->getAttribute('name'))]['region'] ?? 'I forget?')
            . "\nso I can make\na big bomb!");

        $rom->setText('blind_by_the_light', Arr::first(fy_shuffle($this->strings['blind'])));

        $rom->setText('kakariko_tavern_fisherman', Arr::first(fy_shuffle($this->strings['tavern_man'])));

        $rom->setText('ganon_fall_in', Arr::first(fy_shuffle($this->strings['ganon_1'])));

        $rom->setText('ganon_phase_3_alt', "Got wax in\nyour ears?\nI cannot die!");

        $silver_arrows_location = $world->getLocationsWithItem(Item::get('SilverArrowUpgrade', $world->id))->first();
        if (!$silver_arrows_location) {
            $silver_arrows_location = $world->getLocationsWithItem(Item::get('BowAndSilverArrows', $world->id))->first();
        }

        if (!$silver_arrows_location) {
            $rom->setText('ganon_phase_3_no_silvers', "Did you find\nthe arrows on\nPlanet Zebes?");
        } else {
            switch ($silver_arrows_location->getAttribute('name')) {
                case "Ganons Tower":
                    $rom->setText('ganon_phase_3_no_silvers', "Did you find\nthe arrows in\nMy tower?");
                    break;
                default:
                    $rom->setText('ganon_phase_3_no_silvers', "Did you find\nthe arrows in\n" . $silver_arrows_location->getAttribute('name'));
            }
        }

        // progressive bow hint and handling
        // @todo this swap of item really shouldn't happen here, we don't know
        // for sure that the items haven't already been written to the rom.
        $progressive_bow_locations = $world->getLocationsWithItem(Item::get('ProgressiveBow', $world->id));
        if ($progressive_bow_locations->count() > 0) {
            $first_location = $progressive_bow_locations->pop();
            switch ($first_location->getAttribute('name')) {
                case "Ganons Tower":
                    $rom->setText('ganon_phase_3_no_silvers', "Did you find\nthe arrows in\nMy tower?");
                    break;
                default:
                    $rom->setText('ganon_phase_3_no_silvers', "Did you find\nthe arrows in\n" . $first_location->getAttribute('name'));
            }
            // Progressive Bow Alternate
            $first_location->item = new Item('ProgressiveBow', [0x65], $world->id);

            if ($progressive_bow_locations->count() > 0) {
                $second_location = $progressive_bow_locations->pop();
                switch ($second_location->getAttribute('name')) {
                    case "Ganons Tower":
                        $rom->setText('ganon_phase_3_no_silvers_alt', "Did you find\nthe arrows in\nMy tower?");
                        break;
                    default:
                        $rom->setText('ganon_phase_3_no_silvers_alt', "Did you find\nthe arrows in\n" . $second_location->getAttribute('name'));
                }
            }
            // Remove Hint in Hard+ Item Pool
            if ($world->config('item.overflow.count.Bow') < 2) {
                $rom->setText('ganon_phase_3_no_silvers', "Did you find\nthe arrows on\nPlanet Zebes?");
                $rom->setText('ganon_phase_3_no_silvers_alt', "Did you find\nthe arrows on\nPlanet Zebes?");
                // Special No Silvers "Hint" for Crowd Control
                if ($world->config('item.pool') == 'crowd_control') {
                    $rom->setText('ganon_phase_3_no_silvers', "Chat said no\nto Silvers.\nIt's over Hero");
                    $rom->setText('ganon_phase_3_no_silvers_alt', "Chat said no\nto Silvers.\nIt's over Hero");
                }
            }
        }

        if ($world->config('crystals.tower') < 7) {
            $tower_string = $world->config('crystals.tower') == 1 ? 'You need %d crystal to enter.' : 'You need %d crystals to enter.';
            $tower_require = sprintf($tower_string, $world->config('crystals.tower'));
            $rom->setText('sign_ganons_tower', $tower_require);
        }
        if ($world->config('crystals.ganon') < 7) {
            $ganon_string = $world->config('crystals.ganon') == 1 ? 'You need %d crystal to beat Ganon.' : 'You need %d crystals to beat Ganon.';
            $ganon_require = sprintf($ganon_string, $world->config('crystals.ganon'));
            $rom->setText('sign_ganon', $ganon_require);
        }

        switch ($world->config('goal')) {
            case 'pedestal':
                $rom->setText('ganon_fall_in_alt', "You cannot\nkill me. You\nshould go for\nyour real goal\nIt's on the\npedestal.\n\nYou dingus!\n");
                $rom->setText('sign_ganon', "You need to get to the pedestal... Dingus!");

                break;
            case 'triforce-hunt':
                $rom->setText('ganon_fall_in_alt', "So you thought\nyou could come\nhere and beat\nme? I have\nhidden the\nTriforce\npieces well.\nWithout them,\nyou can't win!");
                $rom->setText('sign_ganon', "Go find the Triforce pieces... Dingus!");
                $rom->setText('murahdahla', sprintf("Hello @. I\nam Murahdahla, brother of\nSahasrahla and Aginah. Behold the power of\ninvisibility.\n\n\n\n… … …\n\nWait! you can see me? I knew I should have\nhidden in  a hollow tree. If you bring\n%d triforce pieces, I can reassemble it.", $world->config('item.Goal.Required')));

                break;
            case 'dungeons':
                $rom->setText('sign_ganon', "You need to defeat all of Ganon's bosses.");

                // no-break
            default:
                $rom->setText('ganon_fall_in_alt', "You think you\nare ready to\nface me?\n\nI will not die\n\nunless you\ncomplete your\ngoals. Dingus!");
        }

        $rom->setText('end_triforce', "{NOBORDER}\n" . Arr::first(fy_shuffle($this->strings['triforce'])));

        $rom->writeText();
    }

    /**
     * Read the silly textbox file format I made. woot!
     *
     * @param string $file location of file to read
     *
     * @return array
     */
    private function getTextArray(string $file): array
    {
        return array_filter(explode(
            "\n-\n",
            (string) preg_replace(
                '/^-\n/',
                '',
                (string) preg_replace('/\r\n/', "\n", (string) file_get_contents(base_path($file)))
            )
        ));
    }
}

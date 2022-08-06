<?php

namespace App\Services;

use App\Graph\Item;
use App\Rom;
use App\Graph\World;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Yaml\Yaml;

/**
 * Service class to update the credits for the game based on items in locations.
 */
class RomCreditWriterService
{
    private const LOCATIONS = [
        'zora' => "King Zora",
        'witch' => "Potion Shop",
        'pedestal' => "Master Sword Pedestal",
        'kakariko2' => "Sick Kid",
        'grove' => "Flute Spot",
        'house' => "Link's Uncle",
    ];

    public Collection $strings;

    public function __construct()
    {
        $this->strings = Cache::rememberForever('textcredits', function () {
            return collect(Yaml::parse(file_get_contents(base_path('strings/credits.yml'))));
        });
    }

    /**
     * determine the credits to write and write them to the rom.
     *
     * @todo move the static credits to a cached read file
     *
     * @param World $world world to pull data from
     * @param Rom $rom Rom to write data to
     */
    public function writeCreditsToRom(World $world, Rom $rom): void
    {
        foreach (self::LOCATIONS as $key => $location) {
            $world_location = $world->getLocation($location);
            if (!$world_location) {
                continue;
            }

            $item = $world_location->item ?? Item::get('Nothing', $world->id);
            $rom->setCredit($key, $this->strings[$item->raw_name][$location]);
        }

        $rom->setCredit('castle', Arr::first(fy_shuffle([
            "the return of the king",
            "fellowship of the ring",
            "the two towers",
        ])));

        $rom->setCredit('sanctuary', Arr::first(fy_shuffle([
            "the loyal priest",
            "read a book",
            "sits in own pew",
            "heal plz",
        ])));

        $rom->setCredit('kakariko', sprintf("%s's homecoming", Arr::first(fy_shuffle([
            "sahasralah", "sabotaging", "sacahuista", "sacahuiste", "saccharase", "saccharide", "saccharify",
            "saccharine", "saccharins", "sacerdotal", "sackcloths", "salmonella", "saltarelli", "saltarello",
            "saltations", "saltbushes", "saltcellar", "saltshaker", "salubrious", "sandgrouse", "sandlotter",
            "sandstorms", "sandwiched", "sauerkraut", "schipperke", "schismatic", "schizocarp", "schmalzier",
            "schmeering", "schmoosing", "shibboleth", "shovelnose", "sahananana", "sarararara", "salamander",
            "sharshalah", "shahabadoo", "sassafrass", "saddlebags", "sandalwood", "shagadelic", "sandcastle",
            "saltpeters", "shabbiness", "shlrshlrsh", "sassyralph", "sallyacorn", "sahasrahbot"
        ]))));

        $rom->setCredit('lumberjacks', Arr::first(fy_shuffle([
            "twin lumberjacks",
            "fresh flapjacks",
            "two woodchoppers",
            "double lumberman",
            "lumberclones",
            "woodfellas",
            "dos axes",
        ])));

        $rom->setCredit('smithy', Arr::first(fy_shuffle([
            "the dwarven swordsmiths",
            "the dwarven breadsmiths",
        ])));

        $rom->setCredit('bridge', Arr::first(fy_shuffle([
            "the lost old man",
            "gary the old man",
            "Your ad here",
        ])));

        $rom->setCredit('woods', Arr::first(fy_shuffle([
            "the forest thief",
            "dancing pickles",
            "flying vultures",
        ])));

        $rom->setCredit('well', Arr::first(fy_shuffle([
            "venus. queen of faeries",
            "Venus was her name",
            "I'm your Venus",
            "Yeah, baby, she's got it",
            "Venus, I'm your fire",
            "Venus, At your desire",
            "Venus Love Chain",
            "Venus Crescent Beam",
        ])));

        $rom->writeCredits();
    }
}

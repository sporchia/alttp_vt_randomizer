<?php

namespace ALttP;

use ALttP\Support\Dialog;
use Log;

/**
 * Overwrite all the text in the main portion of the ROM
 *
 * from: 0xE0000 to: 0xE7355
 *
 * 394 required things in table
 * but extended a bit by the randomizer
 */
class Text
{
    protected $text_array;
    protected $converter;

    public function __construct($translation = 'en')
    {
        $this->converter = new Dialog;
        $this->text_array = $this->$translation();
    }

    /**
     * Updates a specific string in the table, including
     * encoding the string.
     *
     * @param string $id The ID of the string to update
     * @param string $value the string to add to the table
     *
     * @return void
     */
    public function setString(string $id, string $value, ...$flags)
    {
        $this->text_array[$id] = $this->converter->convertDialogCompressed($value, ...$flags);
    }

    /**
     * Updates a specific string in the table, given the
     * raw bytes
     *
     * @param string $id The ID of the string to update
     * @param array $rawvalue The raw bytes to add to the table
     *
     * @return void
     */
    public function setStringRaw(string $id, array $rawvalue)
    {
        $this->text_array[$id] = $rawvalue;
    }

    public function getByteArray(bool $pad = false)
    {
        $data = array_merge(...array_values($this->text_array));

        Log::debug(sprintf('Localization free space: %s', 0x7355 - count($data)));

        if (count($data) > 0x7355) {
            throw new \Exception("Too BIG", 1);
        }
        if ($pad) {
            return array_pad($data, 0x7355, 0xFF);
        } else {
            return $data;
        }
    }

    public function en()
    {
        $converter = $this->converter;
        // php all arrays are ordered

        // Numbers in comments refer to US text numbers. Except for
        // the first few entries, JP1.0 text numbers are smaller by 2
        return [
            'set_cursor' => [0xFB, 0xFC, 0x00, 0xF9, 0xFF, 0xFF, 0xFF, 0xF8, 0xFF, 0xFF, 0xE4, 0xFE, 0x68],
            'set_cursor2' => [0xFB, 0xFC, 0x00, 0xF8, 0xFF, 0xFF, 0xFF, 0xF9, 0xFF, 0xFF, 0xE4, 0xFE, 0x68],

            'game_over_menu' => $converter->convertDialogCompressed("{SPEED0}\nSave-Continue\nSave-Quit\nContinue", false),

            'var_test' => $converter->convertDialogCompressed("0= ᚋ, 1= ᚌ\n2= ᚍ, 3= ᚎ", false),

            'follower_no_enter' => $converter->convertDialogCompressed("Can't you take me some place nice."),

            'choice_1_3' => [0xFB, 0xFC, 0x00, 0xF7, 0xE4, 0xF8, 0xFF, 0xF9, 0xFF, 0xFE, 0x71],
            'choice_2_3' => [0xFB, 0xFC, 0x00, 0xF7, 0xFF, 0xF8, 0xE4, 0xF9, 0xFF, 0xFE, 0x71],
            'choice_3_3' => [0xFB, 0xFC, 0x00, 0xF7, 0xFF, 0xF8, 0xFF, 0xF9, 0xE4, 0xFE, 0x71],
            'choice_1_2' => [0xFB, 0xFC, 0x00, 0xF7, 0xE4, 0xF8, 0xFF, 0xFE, 0x72],
            'choice_2_2' => [0xFB, 0xFC, 0x00, 0xF7, 0xFF, 0xF8, 0xE4, 0xFE, 0x72],

            'uncle_leaving_text' => $converter->convertDialogCompressed("I'm just going out for a pack of smokes."),

            'uncle_dying_sewer' => $converter->convertDialogCompressed("I've fallen and I can't get up, take this."),
            // 0x10
            'tutorial_guard_1' => $converter->convertDialogCompressed("Only adults should travel at night."),

            'tutorial_guard_2' => $converter->convertDialogCompressed("You can press X to see the Map."),

            'tutorial_guard_3' => $converter->convertDialogCompressed("Press the A button to lift things by you."),

            'tutorial_guard_4' => $converter->convertDialogCompressed("When you has a sword, press B to slash it."),

            'tutorial_guard_5' => $converter->convertDialogCompressed("このメッセージはニホンゴでそのまま"), // on purpose

            'tutorial_guard_6' => $converter->convertDialogCompressed("Are we really still reading these?"),

            'tutorial_guard_7' => $converter->convertDialogCompressed("Jeeze! There really are a lot of things."),

            'priest_sanctuary_before_leave' => $converter->convertDialogCompressed("Go be a hero!"),

            'sanctuary_enter' => $converter->convertDialogCompressed("YAY!\nYou saved Zelda!"),

            'zelda_sanctuary_story' => $converter->convertDialogCompressed("Do you want to hear me say this again?\n{HARP}\n  ≥ No\n    Yes\n{CHOICE}"),

            'priest_sanctuary_before_pendants' => $converter->convertDialogCompressed("Go'on and get them pendants so you can beat up Agahnim."),

            'priest_sanctuary_after_pendants_before_master_sword' => $converter->convertDialogCompressed("Kudos! But seriously, you should be getting the Master Sword, not having a kegger in here."),

            'priest_sanctuary_dying' => $converter->convertDialogCompressed("They took her to the castle! Take your sword and save her!"),

            'zelda_save_sewers' => $converter->convertDialogCompressed("You saved me!"),

            'priest_info' => $converter->convertDialogCompressed("So, I'm the dude that will protect Zelda. Don't worry, I got this covered."),

            'zelda_sanctuary_before_leave' => $converter->convertDialogCompressed("Be careful!"),

            'telepathic_intro' => $converter->convertDialogCompressed("{NOBORDER}\n{SPEED6}\nHey, come find me and help me!"),
            // 0x20
            'telepathic_reminder' => $converter->convertDialogCompressed("{NOBORDER}\n{SPEED6}\nI'm in the castle basement."),

            'zelda_go_to_throne' => $converter->convertDialogCompressed("Go north to the throne."),

            'zelda_push_throne' => $converter->convertDialogCompressed("Let's push it from the left!"),

            'zelda_switch_room_pull' => $converter->convertDialogCompressed("Pull this lever using A."),

            'zelda_save_lets_go' => $converter->convertDialogCompressed("Let's get out of here!"),

            'zelda_save_repeat' => $converter->convertDialogCompressed("I like talking, do you?\n  ≥ No\n    Yes\n{CHOICE}"),

            'zelda_before_pendants' => $converter->convertDialogCompressed("You need to find all the pendants…\n\n\nNumpty."),

            'zelda_after_pendants_before_master_sword' => $converter->convertDialogCompressed("Very pretty pendants, but really you should be getting that sword in the forest!"),

            'telepathic_zelda_right_after_master_sword' => $converter->convertDialogCompressed("{NOBORDER}\n{SPEED6}\nHi @,\nHave you been thinking about me?\narrrrrgghh…\n… … …"),

            'zelda_sewers' => $converter->convertDialogCompressed("Just a little further to the Sanctuary."),

            'zelda_switch_room' => $converter->convertDialogCompressed("The Sanctuary!\n\nPull my finger"),

            'kakariko_saharalasa_wife' => $converter->convertDialogCompressed("Heya, @!\nLong time no see.\nYou want a Master Sword?\n\nWell good luck with that."),

            'kakariko_saharalasa_wife_sword_story' => $converter->convertDialogCompressed("It occurs to me that I like toast and jam, but cheese and crackers is better.\nYou like?\n  ≥ Cheese\n    Jam\n{CHOICE}"),

            'kakariko_saharalasa_wife_closing' => $converter->convertDialogCompressed("Anywho, I have things to do. You see those 2 ovens?\n\nYeah, 2!\nWho has 2 ovens nowadays?!"),

            'kakariko_saharalasa_after_master_sword' => $converter->convertDialogCompressed("Cool sword!\n\n\n…\n\n\n…\n\n\nPlease save us"),

            'kakariko_alert_guards' => $converter->convertDialogCompressed("GUARDS! HELP!\nThe creeper\n@ is here!"),
            // 0x30
            'sahasrahla_quest_have_pendants' => $converter->convertDialogCompressed("{BOTTOM}\nCool beans, but I think you should mosey on over to the Lost Woods."),

            'sahasrahla_quest_have_master_sword' => $converter->convertDialogCompressed("{BOTTOM}\nThat's a pretty sword, but I'm old, forgetful, and old. Why don't you go do all the hard work while I hang out in this hut."),

            'sahasrahla_quest_information' => $converter->convertDialogCompressed("{BOTTOM}\n"
                . "Sahasrahla, I am. You would do well to find the 3 pendants from the 3 dungeons in the Light World.\n"
                . "Understand?\n  ≥ yes\n    no\n{CHOICE}"),

            'sahasrahla_bring_courage' => $converter->convertDialogCompressed("{BOTTOM}\n"
                . "While you're here, could you do me a solid and get the green pendant from that dungeon?\n"
                . "{HARP}\nI'll give you a present if you do."),

            'sahasrahla_have_ice_rod' => $converter->convertDialogCompressed("{BOTTOM}\nLike, I sit here, and tell you what to do?\n\n\nAlright, go and find all the maidens, there are, like, maybe 7 of them. I dunno anymore. I'm old."),

            'telepathic_sahasrahla_beat_agahnim' => $converter->convertDialogCompressed("{NOBORDER}\n{SPEED6}\nNice, so you beat Agahnim. Now you must beat Ganon. Good Luck!"),

            'telepathic_sahasrahla_beat_agahnim_no_pearl' => $converter->convertDialogCompressed("{NOBORDER}\n{SPEED6}\nOh, also you forgot the Moon Pearl, dingus. Go back and find it!"),

            'sahasrahla_have_boots_no_icerod' => $converter->convertDialogCompressed("{BOTTOM}\nCave in South East has a cool item."),

            'sahasrahla_have_courage' => $converter->convertDialogCompressed("{BOTTOM}\nLook, you have the green pendant! I'll give you something. Go kill the other two bosses for more pendant fun!"),

            'sahasrahla_found' => $converter->convertDialogCompressed("{BOTTOM}\nYup!\n\nI'm the old man you are looking for. I'll keep it short and sweet: Go into that dungeon, then bring me the green pendant and talk to me again."),

            'sign_rain_north_of_links_house' => $converter->convertDialogCompressed("↑ Dying Uncle\n  This way…"),

            'sign_north_of_links_house' => $converter->convertDialogCompressed("> Randomizer The telepathic tiles can have hints!"),

            'sign_path_to_death_mountain' => $converter->convertDialogCompressed("Cave to lost, old man.\nGood luck."),

            'sign_lost_woods' => $converter->convertDialogCompressed("\n↑ Lost Woods"),

            'sign_zoras' => $converter->convertDialogCompressed("Danger!\nDeep water!\nZoras!"),

            'sign_outside_magic_shop' => $converter->convertDialogCompressed("Welcome to the Magic Shoppe"),
            // 0x40
            'sign_death_mountain_cave_back' => $converter->convertDialogCompressed("Cave away from sky cabbages"),

            'sign_east_of_links_house' => $converter->convertDialogCompressed("↓ Lake Hylia\n\n Also, a shop"),

            'sign_south_of_lumberjacks' => $converter->convertDialogCompressed("← Kakariko\n  Village"),

            'sign_east_of_desert' => $converter->convertDialogCompressed("← Desert\n\n     It's hot."),

            'sign_east_of_sanctuary' => $converter->convertDialogCompressed("↑→ Potions!\n\nWish Waterfall"),

            'sign_east_of_castle' => $converter->convertDialogCompressed("→ East Palace\n\n← Castle"),

            'sign_north_of_lake' => $converter->convertDialogCompressed("\n Lake  Hiriah"),

            'sign_desert_thief' => $converter->convertDialogCompressed("Don't talk to me or touch my sign!"),

            'sign_lumberjacks_house' => $converter->convertDialogCompressed("Lumberjacks, Inc.\nYou see 'em, we saw 'em."),

            'sign_north_kakariko' => $converter->convertDialogCompressed("↓ Kakariko\n  Village"),

            'witch_bring_mushroom' => $converter->convertDialogCompressed("Double, double toil and trouble!\nBring me a mushroom!"),

            'witch_brewing_the_item' => $converter->convertDialogCompressed("This mushroom is busy brewing. Come back later."),

            'witch_assistant_no_bottle' => $converter->convertDialogCompressed("You got to give me the mushroom, Numpty."),

            'witch_assistant_no_empty_bottle' => $converter->convertDialogCompressed("Gotta use your stuff before you can get more."),

            'witch_assistant_informational' => $converter->convertDialogCompressed("Red is life\nGreen is magic\nBlue is both\nI'll heal you for free, though."),

            'witch_assistant_no_bottle_buying' => $converter->convertDialogCompressed("If only you had something to put that in, like a bottle…"),
            // 0x50
            'potion_shop_no_empty_bottles' => $converter->convertDialogCompressed("Whoa, bucko!\nNo empty bottles."),

            'item_get_lamp' => $converter->convertDialogCompressed("Lamp! You can see in the dark, and light torches."),

            'item_get_boomerang' => $converter->convertDialogCompressed("Boomerang! Press START to select it."),

            'item_get_bow' => $converter->convertDialogCompressed("You're in bow mode now!"),

            'item_get_shovel' => $converter->convertDialogCompressed("This is my new mop. My friend George, he gave me this mop. It's a pretty good mop. It's not as good as my old mop. I miss my old mop. But it's still a good mop."),

            'item_get_magic_cape' => $converter->convertDialogCompressed("Finally! We get to play Invisible Man!"),

            'item_get_powder' => $converter->convertDialogCompressed("It's the powder. Let's cause some mischief!"),

            'item_get_flippers' => $converter->convertDialogCompressed("Splish! Splash! Let's go take a bath!"),

            'item_get_power_gloves' => $converter->convertDialogCompressed("Feel the power! You can now lift light rocks! Rock on!"),

            'item_get_pendant_courage' => $converter->convertDialogCompressed("We have the Pendant of Courage! How brave!"),

            'item_get_pendant_power' => $converter->convertDialogCompressed("We have the Pendant of Power! How robust!"),

            'item_get_pendant_wisdom' => $converter->convertDialogCompressed("We have the Pendant of Wisdom! How astute!"),

            'item_get_mushroom' => $converter->convertDialogCompressed("A Mushroom! Don't eat it. Find a witch."),

            'item_get_book' => $converter->convertDialogCompressed("It book! U R now litterit!"),

            'item_get_moonpearl' => $converter->convertDialogCompressed("I found a shiny marble! No more hops!"),

            'item_get_compass' => $converter->convertDialogCompressed("A compass! I can now find the boss."),
            // 0x60
            'item_get_map' => $converter->convertDialogCompressed("Yo! You found a MAP! Press X to see it."),

            'item_get_ice_rod' => $converter->convertDialogCompressed("It's the Ice Rod! Freeze Ray time."),

            'item_get_fire_rod' => $converter->convertDialogCompressed("A Rod that shoots fire? Let's burn all the things!"),

            'item_get_ether' => $converter->convertDialogCompressed("We can chill out with this!"),

            'item_get_bombos' => $converter->convertDialogCompressed("Let's set everything on fire, and melt things!"),

            'item_get_quake' => $converter->convertDialogCompressed("Time to make the earth shake, rattle, and roll!"),

            'item_get_hammer' => $converter->convertDialogCompressed("STOP!\n\nHammer Time!"), // 66

            'item_get_ocarina' => $converter->convertDialogCompressed("Finally! We can play the Song of Time!"),

            'item_get_cane_of_somaria' => $converter->convertDialogCompressed("Make blocks!\nThrow blocks!\nSplode Blocks!"),

            'item_get_hookshot' => $converter->convertDialogCompressed("BOING!!!\nBOING!!!\nSay no more…"),

            'item_get_bombs' => $converter->convertDialogCompressed("BOMBS! Use A to pick 'em up, throw 'em, get hurt!"),

            'item_get_bottle' => $converter->convertDialogCompressed("It's a terrarium. I hope we find a lizard!"),

            'item_get_big_key' => $converter->convertDialogCompressed("Yo! You got a Big Key!"),

            'item_get_titans_mitts' => $converter->convertDialogCompressed("So, like, you can now lift anything.\nANYTHING!"),

            'item_get_magic_mirror' => $converter->convertDialogCompressed("We could stare at this all day or, you know, beat Ganon…"),

            'item_get_fake_mastersword' => $converter->convertDialogCompressed("It's the Master Sword! …or not…\n\n         FOOL!"),
            // 0x70
            'post_item_get_mastersword' => $converter->convertDialogCompressed("{NOBORDER}\n{SPEED6}\n@, you got the sword!\n{CHANGEMUSIC}\nNow let's go beat up Agahnim!"),

            'item_get_red_potion' => $converter->convertDialogCompressed("Red goo to go! Nice!"),

            'item_get_green_potion' => $converter->convertDialogCompressed("Green goo to go! Nice!"),

            'item_get_blue_potion' => $converter->convertDialogCompressed("Blue goo to go! Nice!"),

            'item_get_bug_net' => $converter->convertDialogCompressed("Surprise Net! Let's catch stuff!"),

            'item_get_blue_mail' => $converter->convertDialogCompressed("Blue threads? Less damage activated!"),

            'item_get_red_mail' => $converter->convertDialogCompressed("You feel the power of the eggplant on your head."),

            'item_get_temperedsword' => $converter->convertDialogCompressed("Nice… I now have a craving for Cheetos."),

            'item_get_mirror_shield' => $converter->convertDialogCompressed("Pit would be proud!"),

            'item_get_cane_of_byrna' => $converter->convertDialogCompressed("It's the Blue Cane. You can now protect yourself with lag!"),

            'missing_big_key' => $converter->convertDialogCompressed("Something is missing…\nThe Big Key?"),

            'missing_magic' => $converter->convertDialogCompressed("Something is missing…\nMagic meter?"),

            'item_get_pegasus_boots' => $converter->convertDialogCompressed("Finally, it's bonking time!\nHold A to dash"),

            'talking_tree_info_start' => $converter->convertDialogCompressed("Whoa! I can talk again!"),

            'talking_tree_info_1' => $converter->convertDialogCompressed("Yank on the pitchfork in the center of town, ya heard it here."),

            'talking_tree_info_2' => $converter->convertDialogCompressed("Ganon is such a dingus, no one likes him, ya heard it here."),
            // 0x80
            'talking_tree_info_3' => $converter->convertDialogCompressed("There is a portal near the Lost Woods, ya heard it here."),

            'talking_tree_info_4' => $converter->convertDialogCompressed("Use bombs to quickly kill the Hinox, ya heard it here."),

            'talking_tree_other' => $converter->convertDialogCompressed("I can breathe!"),

            'item_get_pendant_power_alt' => $converter->convertDialogCompressed("We have the Pendant of Power! How robust!"),

            'item_get_pendant_wisdom_alt' => $converter->convertDialogCompressed("We have the Pendant of Wisdom! How astute!"),

            'game_shooting_choice' => $converter->convertDialogCompressed("20 rupees.\n5 arrows.\nWin rupees!\nWant to play?\n  ≥ Yes\n    No\n{CHOICE}"),

            'game_shooting_yes' => $converter->convertDialogCompressed("Let's do this!"),

            'game_shooting_no' => $converter->convertDialogCompressed("Where are you going? Straight up!"),

            'game_shooting_continue' => $converter->convertDialogCompressed("Keep playing?\n  ≥ Yes\n    No\n{CHOICE}"),

            'pond_of_wishing' => $converter->convertDialogCompressed("-Wishing Pond-\n\n On Vacation"),

            'pond_item_select' => $converter->convertDialogCompressed("Pick something\nto throw in.\n{ITEMSELECT}"),

            'pond_item_test' => $converter->convertDialogCompressed("You toss this?\n  ≥ Yup\n    Wrong\n{CHOICE}"),

            'pond_will_upgrade' => $converter->convertDialogCompressed("You're honest, so I'll give you a present."),

            'pond_item_test_no' => $converter->convertDialogCompressed("You sure?\n  ≥ Oh yeah\n    Um…\n{CHOICE}"),

            'pond_item_test_no_no' => $converter->convertDialogCompressed("Well, I don't want it, so take it back."),

            'pond_item_boomerang' => $converter->convertDialogCompressed("I don't much like you, so have this worse Boomerang."),
            // 0x90
            'pond_item_shield' => $converter->convertDialogCompressed("I grant you the ability to block fireballs. Don't lose this to a Pikit!"),

            'pond_item_silvers' => $converter->convertDialogCompressed("So, wouldn't it be nice to kill Ganon? These should help in the final phase."),

            'pond_item_bottle_filled' => $converter->convertDialogCompressed("Bottle filled!\nMoney saved!"),

            'pond_item_sword' => $converter->convertDialogCompressed("Thank you for the sword, here is a stick of butter."),

            'pond_of_wishing_happiness' => $converter->convertDialogCompressed("Happiness up!\nYou are now\nᚌᚋ happy!"),

            'pond_of_wishing_choice' => $converter->convertDialogCompressed("Your wish?\n  ≥More bombs\n   More arrows\n{CHOICE}"),

            'pond_of_wishing_bombs' => $converter->convertDialogCompressed("Woo-hoo!\nYou can now\ncarry ᚌᚋ bombs"),

            'pond_of_wishing_arrows' => $converter->convertDialogCompressed("Woo-hoo!\nYou can now\nhold ᚌᚋ arrows"),

            'pond_of_wishing_full_upgrades' => $converter->convertDialogCompressed("You have all I can give you, here are your rupees back."),

            'mountain_old_man_first' => $converter->convertDialogCompressed("Look out for holes, and monsters."),

            'mountain_old_man_deadend' => $converter->convertDialogCompressed("Oh, goody, hearts in jars! This place is creepy."),

            'mountain_old_man_turn_right' => $converter->convertDialogCompressed("Turn right. Let's get out of this place."),

            'mountain_old_man_lost_and_alone' => $converter->convertDialogCompressed("Hello. I can't see anything. Take me with you."),

            'mountain_old_man_drop_off' => $converter->convertDialogCompressed("Here's a thing to help you, good luck!"),

            'mountain_old_man_in_his_cave_pre_agahnim' => $converter->convertDialogCompressed("You need to beat the tower at the top of the mountain."),

            'mountain_old_man_in_his_cave' => $converter->convertDialogCompressed("You can find stuff in the tower at the top of this mountain.\nCome see me if you'd like to be healed."),
            // 0xA0
            'mountain_old_man_in_his_cave_post_agahnim' => $converter->convertDialogCompressed("You should be heading to the castle… you have a portal there now.\nSay hi anytime you like."),

            'tavern_old_man_awake' => $converter->convertDialogCompressed("Life? Love? Happiness? The question you should really ask is: Was this generated by Stoops Alu or Stoops Jet?"),

            'tavern_old_man_unactivated_flute' => $converter->convertDialogCompressed("You should play that flute for the weathervane, cause reasons."),

            'tavern_old_man_know_tree_unactivated_flute' => $converter->convertDialogCompressed("You should play that flute for the weathervane, cause reasons."),

            'tavern_old_man_have_flute' => $converter->convertDialogCompressed("Life? Love? Happiness? The question you should really ask is: Was this generated by Stoops Alu or Stoops Jet?"),

            'chicken_hut_lady' => $converter->convertDialogCompressed("This is\nChristos' hut.\n\nHe's out, searching for a bow."),

            'running_man' => $converter->convertDialogCompressed("Hi, Do you\nknow Veetorp?\n\nYou really\nshould. And\nall the other great guys who made this possible.\nGo thank them.\n\n\nIf you can catch them…"),

            'game_race_sign' => $converter->convertDialogCompressed("Why are you reading this sign? Run!!!"),

            'sign_bumper_cave' => $converter->convertDialogCompressed("You need Cape, but not Hookshot"),

            'sign_catfish' => $converter->convertDialogCompressed("Toss rocks\nToss items\nToss cookies"),

            'sign_north_village_of_outcasts' => $converter->convertDialogCompressed("↑ Skull Woods\n\n↓ Steve's Town"),

            'sign_south_of_bumper_cave' => $converter->convertDialogCompressed("\n→ Karkat's cave"),

            'sign_east_of_pyramid' => $converter->convertDialogCompressed("\n→ Dark Palace"),

            'sign_east_of_bomb_shop' => $converter->convertDialogCompressed("\n← Bomb Shoppe"),

            'sign_east_of_mire' => $converter->convertDialogCompressed("\n← Misery Mire\n No way in.\n No way out."),

            'sign_village_of_outcasts' => $converter->convertDialogCompressed("Have a Trulie Awesome Day!"),
            // 0xB0
            'sign_before_wishing_pond' => $converter->convertDialogCompressed("Waterfall\nup ahead\nMake wishes"),

            'sign_before_catfish_area' => $converter->convertDialogCompressed("→↑ Have you met Woeful Ike?"),

            'castle_wall_guard' => $converter->convertDialogCompressed("Looking for a Princess? Look downstairs."),

            'gate_guard' => $converter->convertDialogCompressed("No Lonks Allowed!"),

            'telepathic_tile_eastern_palace' => $converter->convertDialogCompressed("{NOBORDER}\nYou need a Bow to get past the red Eyegore. derpy"),

            'telepathic_tile_tower_of_hera_floor_4' => $converter->convertDialogCompressed("{NOBORDER}\nIf you find a shiny ball, you can be you in the Dark World."),

            'hylian_text_1' => $converter->convertDialogCompressed("%== %== %==\n ^ %==% ^\n%== ^%%^ ==^"),

            'mastersword_pedestal_translated' => $converter->convertDialogCompressed("A test of strength: If you have 3 pendants, I'm yours."),

            'telepathic_tile_spectacle_rock' => $converter->convertDialogCompressed("{NOBORDER}\nUse the Mirror, or the Hookshot and Hammer, to get to Tower of Hera!"),

            'telepathic_tile_swamp_entrance' => $converter->convertDialogCompressed("{NOBORDER}\nDrain the floodgate to raise the water here!"),

            'telepathic_tile_thieves_town_upstairs' => $converter->convertDialogCompressed("{NOBORDER}\nBlind hates bright light."),

            'telepathic_tile_misery_mire' => $converter->convertDialogCompressed("{NOBORDER}\nLighting 4 torches will open your way forward!"),

            'hylian_text_2' => $converter->convertDialogCompressed("%%^= %==%\n ^ =%^=\n==%= ^^%^"),

            'desert_entry_translated' => $converter->convertDialogCompressed("Kneel before this stone, and magic will move around you."),

            'telepathic_tile_under_ganon' => $converter->convertDialogCompressed("Secondary tournament winners\n{HARP}\n  ~~~2019~~~\ndragonstrike\n\n  ~~~2018~~~\nChisame\n\n  ~~~2017~~~\nA: Zaen"),

            'telepathic_tile_palace_of_darkness' => $converter->convertDialogCompressed("{NOBORDER}\nThis is a funny looking Enemizer."),
            // 0xC0
            'telepathic_tile_desert_bonk_torch_room' => $converter->convertDialogCompressed("{NOBORDER}\nThings can be knocked down, if you fancy yourself a dashing dude."),

            'telepathic_tile_castle_tower' => $converter->convertDialogCompressed("{NOBORDER}\nYou can reflect Agahnim's energy with Sword, Bug-net or Hammer."),

            'telepathic_tile_ice_large_room' => $converter->convertDialogCompressed("{NOBORDER}\nAll right stop collaborate and listen\nIce is back with my brand new invention."),

            'telepathic_tile_turtle_rock' => $converter->convertDialogCompressed("{NOBORDER}\nYou Shall Not Pass… without the Red Cane."),

            'telepathic_tile_ice_entrace' => $converter->convertDialogCompressed("{NOBORDER}\nYou can use Fire Rod or Bombos to pass."),

            'telepathic_tile_ice_stalfos_knights_room' => $converter->convertDialogCompressed("{NOBORDER}\nKnock 'em down and then bomb them dead."),

            'telepathic_tile_tower_of_hera_entrance' => $converter->convertDialogCompressed("{NOBORDER}\nThis is a bad place, with a guy who will make you fall…\n\n\na lot."),

            'houlihan_room' => $converter->convertDialogCompressed("Randomizer tournament winners\n{HARP}\n  ~~~2019~~~\nJet082\n\n  ~~~2018~~~\nS: Andy\n\n  ~~~2017~~~\nA: ajneb174\nS: ajneb174"),

            'caught_a_bee' => $converter->convertDialogCompressed("Caught a Bee\n  ≥ keep\n    release\n{CHOICE}"),

            'caught_a_fairy' => $converter->convertDialogCompressed("Caught Fairy!\n  ≥ keep\n    release\n{CHOICE}"),

            'no_empty_bottles' => $converter->convertDialogCompressed("Whoa, bucko!\nNo empty bottles."),

            'game_race_boy_time' => $converter->convertDialogCompressed("Your time was\nᚎᚍ min ᚌᚋ sec."),

            'game_race_girl' => $converter->convertDialogCompressed("You have 15 seconds,\nGo… Go… Go…"),

            'game_race_boy_success' => $converter->convertDialogCompressed("Nice!\nYou can have this trash!"),

            'game_race_boy_failure' => $converter->convertDialogCompressed("Too slow!\nI keep my\nprecious!"),

            'game_race_boy_already_won' => $converter->convertDialogCompressed("You already have your prize, dingus!"),
            // 0xD0
            'game_race_boy_sneaky' => $converter->convertDialogCompressed("Thought you could sneak in, eh?"),

            'bottle_vendor_choice' => $converter->convertDialogCompressed("I gots bottles.\nYous gots 100 rupees?\n  ≥ I want\n    No way!"),

            'bottle_vendor_get' => $converter->convertDialogCompressed("Nice! Hold it up son! Show the world what you got!"),

            'bottle_vendor_no' => $converter->convertDialogCompressed("Fine! I didn't want your money anyway."),

            'bottle_vendor_already_collected' => $converter->convertDialogCompressed("Dude! You already have it."),

            'bottle_vendor_bee' => $converter->convertDialogCompressed("Cool! A bee! Here's 100 rupees."),

            'bottle_vendor_fish' => $converter->convertDialogCompressed("Whoa! A fish! You walked this all the way here?"),

            'hobo_item_get_bottle' => $converter->convertDialogCompressed("You think life is rough? I guess you can take my last item. Except this tent. That's MY tent!"),

            'blacksmiths_what_you_want' => $converter->convertDialogCompressed("Nice of you to come back!\nWould you like us mess with your sword?\n  ≥ Temper\n    It's fine\n{CHOICE}"),

            'blacksmiths_paywall' => $converter->convertDialogCompressed("It's 10 rupees\n  ≥ Easy\n    Hang on…\n{CHOICE}"),

            'blacksmiths_extra_okay' => $converter->convertDialogCompressed("Are you sure you're sure?\n  ≥ Ah, yup\n    Hang on…\n{CHOICE}"),

            'blacksmiths_tempered_already' => $converter->convertDialogCompressed("Whelp… We can't make this any better."),

            'blacksmiths_temper_no' => $converter->convertDialogCompressed("Oh, come by any time!"),

            'blacksmiths_bogart_sword' => $converter->convertDialogCompressed("We're going to have to take it to work on it."),

            'blacksmiths_get_sword' => $converter->convertDialogCompressed("Sword is done. Now, back to our bread!"),

            'blacksmiths_shop_before_saving' => $converter->convertDialogCompressed("I lost my friend. Help me find him!"),
            // 0xE0
            'blacksmiths_shop_saving' => $converter->convertDialogCompressed("You found him! Colour me happy! Come back right away and we will bang on your sword."),

            'blacksmiths_collect_frog' => $converter->convertDialogCompressed("Ribbit! Ribbit! Let's find my partner. To the shop!"),

            'blacksmiths_still_working' => $converter->convertDialogCompressed("Something this precious takes time… Come back later."),

            'blacksmiths_saving_bows' => $converter->convertDialogCompressed("Thanks!\n\nThanks!"),

            'blacksmiths_hammer_anvil' => $converter->convertDialogCompressed("Dernt Take Er Jerbs!"),

            'dark_flute_boy_storytime' => $converter->convertDialogCompressed("Hi!\nI'm Stumpy!\nI've been chillin' in this world for a while now, but I miss my flute. If I gave you a shovel, would you go digging for it?\n  ≥ Sure\n    Nahh\n{CHOICE}"),

            'dark_flute_boy_get_shovel' => $converter->convertDialogCompressed("Schaweet! Here you go. Happy digging!"),

            'dark_flute_boy_no_get_shovel' => $converter->convertDialogCompressed("Oh I see, not good enough for you… FINE!"),

            'dark_flute_boy_flute_not_found' => $converter->convertDialogCompressed("Still haven't found the item? Dig in the Light World around here, dingus!"),

            'dark_flute_boy_after_shovel_get' => $converter->convertDialogCompressed("So I gave you an item, and you're still here.\n\n\n\n\n\nI mean, we can sit here and stare at each other, if you like…\n\n\n\n\n\n\n\nFine, I guess you should just go."),

            'shop_fortune_teller_lw_hint_0' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, the book opens the desert"),

            'shop_fortune_teller_lw_hint_1' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, nothing doing"),

            'shop_fortune_teller_lw_hint_2' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, I'm cheap"),

            'shop_fortune_teller_lw_hint_3' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, am I cheap?"),

            'shop_fortune_teller_lw_hint_4' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, Zora lives at the end of the river"),

            'shop_fortune_teller_lw_hint_5' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, The Cape can pass through the barrier"),
            // 0xF0
            'shop_fortune_teller_lw_hint_6' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, Spin, Hammer, or Net to hurt Agahnim"),

            'shop_fortune_teller_lw_hint_7' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, You can jump in the well by the blacksmiths"),

            'shop_fortune_teller_lw_no_rupees' => $converter->convertDialogCompressed("{BOTTOM}\nThe black cats are hungry, come back with rupees"),

            'shop_fortune_teller_lw' => $converter->convertDialogCompressed("{BOTTOM}\nWelcome to the Fortune Shoppe!\nFancy a read?\n  ≥I must know\n   Negative\n{CHOICE}"),

            'shop_fortune_teller_lw_post_hint' => $converter->convertDialogCompressed("{BOTTOM}\nFor ᚋᚌ rupees\nIt is done.\nBe gone!"),

            'shop_fortune_teller_lw_no' => $converter->convertDialogCompressed("{BOTTOM}\nWell then, why did you even come in here?"),

            'shop_fortune_teller_lw_hint_8' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, why you do?"),

            'shop_fortune_teller_lw_hint_9' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, panda crackers"),

            'shop_fortune_teller_lw_hint_10' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, the missing blacksmith is south of the Village of Outcasts"),

            'shop_fortune_teller_lw_hint_11' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, open chests to get stuff"),

            'shop_fortune_teller_lw_hint_12' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, you can buy a new bomb at the Bomb Shoppe"),

            'shop_fortune_teller_lw_hint_13' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, big bombs blow up cracked walls in pyramids"),

            'shop_fortune_teller_lw_hint_14' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, you need all the crystals to open Ganon's Tower"),

            'shop_fortune_teller_lw_hint_15' => $converter->convertDialogCompressed("{BOTTOM}\nBy the black cats, Silver Arrows will defeat Ganon in his final phase"),

            'dark_sanctuary' => $converter->convertDialogCompressed("For 20 rupees I'll tell you something?\nHow about it?\n  ≥ Yes\n    No\n{CHOICE}"),

            'dark_sanctuary_hint_0' => $converter->convertDialogCompressed("I once was a tea kettle, but then I moved up in the world, and now you can see me as this. Makes you wonder what I could be next time."),
            // 0x100
            'dark_sanctuary_no' => $converter->convertDialogCompressed("Then go away!"),

            'dark_sanctuary_hint_1' => $converter->convertDialogCompressed("There is a thief in the desert, he can open creepy chests that follow you. But now that we have that out of the way, do you like my hair? I've spent eons getting it this way."),

            'dark_sanctuary_yes' => $converter->convertDialogCompressed("With Crystals 5&6, you can find a great fairy in the pyramid.\n\nFlomp Flomp, Whizzle Whomp"),

            'dark_sanctuary_hint_2' => $converter->convertDialogCompressed("All I can say is that my life is pretty plain,\n"
                . "I like watchin' the puddles gather rain,\n"
                . "And all I can do is just pour some tea for two,\n"
                . "And speak my point of view but it's not sane,\n"
                . "It's not sane"),

            'sick_kid_no_bottle' => $converter->convertDialogCompressed("{BOTTOM}\nI'm sick! Show me a bottle, get something!"),

            'sick_kid_trade' => $converter->convertDialogCompressed("{BOTTOM}\nCool bottle! Here's something for you."),

            'sick_kid_post_trade' => $converter->convertDialogCompressed("{BOTTOM}\nLeave me alone\nI'm sick. You have my item."),

            'desert_thief_sitting' => $converter->convertDialogCompressed("………………………"),

            'desert_thief_following' => $converter->convertDialogCompressed("Why……………"),

            'desert_thief_question' => $converter->convertDialogCompressed("I was a thief. I open purple chests!\nKeep secret?\n  ≥ Sure thing\n    Never!\n{CHOICE}"),

            'desert_thief_question_yes' => $converter->convertDialogCompressed("Cool, bring me any purple chests you find."),

            'desert_thief_after_item_get' => $converter->convertDialogCompressed("You tell anyone and I will give you such a pinch!"),

            'desert_thief_reassure' => $converter->convertDialogCompressed("Bring chests. It's a secret to everyone."),

            'hylian_text_3' => $converter->convertDialogCompressed("^^ ^%=^= =%=\n=%% =%%=^\n==%^= %=^^%"),

            'tablet_ether_book' => $converter->convertDialogCompressed("Can you make things fall out of the sky? With the Master Sword, you can!"),

            'tablet_bombos_book' => $converter->convertDialogCompressed("Can you make things fall out of the sky? With the Master Sword, you can!"),
            // 0x110
            'magic_bat_wake' => $converter->convertDialogCompressed("You bum! I was sleeping! Where's my magic bolts?"),

            'magic_bat_give_half_magic' => $converter->convertDialogCompressed("How you like me now?"),

            'intro_main' => $converter->convertDialogCompressed("{INTRO}\n Episode  III\n{PAUSE3}\n A Link to\n   the Past\n"
                . "{PAUSE3}\n  Randomizer\n{PAUSE3}\nAfter mostly disregarding what happened in the first two games.\n"
                . "{PAUSE3}\nLink awakens to his uncle leaving the house.\n{PAUSE3}\nHe just runs out the door,\n"
                . "{PAUSE3}\ninto the rainy night.\n{PAUSE3}\n{CHANGEPIC}\nGanon has moved around all the items in Hyrule.\n"
                . "{PAUSE7}\nYou will have to find all the items necessary to beat Ganon.\n"
                . "{PAUSE7}\nThis is your chance to be a hero.\n{PAUSE3}\n{CHANGEPIC}\n"
                . "You must get enough crystals to beat Ganon.\n{PAUSE9}\n{CHANGEPIC}", false),

            'intro_throne_room' => $converter->convertDialogCompressed("{IBOX}\nLook at this Stalfos on the throne.", false),

            'intro_zelda_cell' => $converter->convertDialogCompressed("{IBOX}\nIt is your time to shine!", false),

            'intro_agahnim' => $converter->convertDialogCompressed("{IBOX}\nAlso, you need to defeat this guy!", false),

            'pickup_purple_chest' => $converter->convertDialogCompressed("A curious box. Let's take it with us!"),

            'bomb_shop' => $converter->convertDialogCompressed("30 bombs for 100 rupees. Good deals all day!"),

            'bomb_shop_big_bomb' => $converter->convertDialogCompressed("30 bombs for 100 rupees, 100 rupees 1 BIG bomb. Good deals all day!"),

            'bomb_shop_big_bomb_buy' => $converter->convertDialogCompressed("Thanks!\nBoom goes the dynamite!"),

            'item_get_big_bomb' => $converter->convertDialogCompressed("YAY! Press A to 'splode it!"),

            'kiki_second_extortion' => $converter->convertDialogCompressed("For 100 more, I'll open this place.\nHow about it?\n  ≥ Open\n    Nah\n{CHOICE}"),

            'kiki_second_extortion_no' => $converter->convertDialogCompressed("Heh, good luck getting in."),

            'kiki_second_extortion_yes' => $converter->convertDialogCompressed("Yay! Rupees!\nOkay, let's do this!"),

            'kiki_first_extortion' => $converter->convertDialogCompressed("I'm Kiki. I like rupees, may I have 10?\nHow about it?\n  ≥ Yes\n    No\n{CHOICE}"),

            'kiki_first_extortion_yes' => $converter->convertDialogCompressed("Nice. I'll tag along with you for a bit."),
            // 0x120
            'kiki_first_extortion_no' => $converter->convertDialogCompressed("Pfft. I have no reason to hang. See ya!"),

            'kiki_leaving_screen' => $converter->convertDialogCompressed("No no no no no! We should play by my rules! Goodbye…"),

            'blind_in_the_cell' => $converter->convertDialogCompressed("You saved me!\nPlease get me out of here!"),

            'blind_by_the_light' => $converter->convertDialogCompressed("Aaaahhhh~!\nS-so bright~!"),

            'blind_not_that_way' => $converter->convertDialogCompressed("No! Don't go that way!"),

            'aginah_l1sword_no_book' => $converter->convertDialogCompressed("I once had a fish dinner. I still remember it to this day."),

            'aginah_l1sword_with_pendants' => $converter->convertDialogCompressed("Do you remember when I was young?\n\nI sure don't."),

            'aginah' => $converter->convertDialogCompressed("So, I've been living in this cave for years, and you think you can just come along and bomb open walls?"),

            'aginah_need_better_sword' => $converter->convertDialogCompressed("Once, I farted in this cave so bad all the jazz hands guys ran away and hid in the sand."),

            'aginah_have_better_sword' => $converter->convertDialogCompressed("Pandas are very vicious animals. Never forget…\n\n\n\n\nI never will…"),

            'catfish' => $converter->convertDialogCompressed("You woke me from my nap! Take this, and get out!"),

            'catfish_after_item' => $converter->convertDialogCompressed("I don't have anything else for you!\nTake this!"),
            // 12C
            'lumberjack_right' => $converter->convertDialogCompressed("One of us always lies."),

            'lumberjack_left' => $converter->convertDialogCompressed("One of us always tells the truth."),

            'lumberjack_left_post_agahnim' => $converter->convertDialogCompressed("One of us likes peanut butter."),

            'fighting_brothers_right' => $converter->convertDialogCompressed("I walled off my brother Leo.\n\nWhat a dingus."),
            // 0x130
            'fighting_brothers_right_opened' => $converter->convertDialogCompressed("Now I should probably talk to him…"),

            'fighting_brothers_left' => $converter->convertDialogCompressed("Did you come from my brother's room?\n\nAre we cool?"),

            'maiden_crystal_1' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nI have a pretty red dress.\n{SPEED1}\n{SPEED2}Just thought I would tell you."),

            'maiden_crystal_2' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nI have a pretty blue dress.\n{SPEED1}\n{SPEED2}Just thought I would tell you."),

            'maiden_crystal_3' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nI have a pretty gold dress.\n{SPEED1}\n{SPEED2}Just thought I would tell you."),

            'maiden_crystal_4' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nI have a pretty redder dress.\n{SPEED1}\n{SPEED2}Just thought I would tell you."),

            'maiden_crystal_5' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nI have a pretty green dress.\n{SPEED1}\n{SPEED2}Just thought I would tell you."),

            'maiden_crystal_6' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nI have a pretty green dress.\n{SPEED1}\n{SPEED2}Just thought I would tell you."),

            'maiden_crystal_7' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nIt's about friggin time.\n{SPEED1}\n{SPEED2}Do you know how long I've been waiting?!"),

            'maiden_ending' => $converter->convertDialogCompressed("May the way of the hero lead to the Triforce."),

            'maiden_confirm_undersood' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nCapisce?\n  ≥ Yes\n    No\n{CHOICE}"),

            'barrier_breaking' => $converter->convertDialogCompressed("What did the seven crystals say to Ganon's Tower?"),

            'maiden_crystal_7_again' => $converter->convertDialogCompressed("{SPEED2}\n{BOTTOM}\n{NOBORDER}\nIt's about friggin time.\n{SPEED1}\n{SPEED2}Do you know how long I've been waiting?!"),

            'agahnim_zelda_teleport' => $converter->convertDialogCompressed("I am a magician, and this is my act. Watch as I make this girl disappear!"),

            'agahnim_magic_running_away' => $converter->convertDialogCompressed("And now, the end is near\nAnd so I face the final curtain\nMy friend, I'll say it clear\nI'll state my case, of which I'm certain\nI've lived a life that's full\nI've traveled each and every highway\nBut more, much more than this\nI did it my way"),

            'agahnim_hide_and_seek_found' => $converter->convertDialogCompressed("Peek-a-boo!"),
            // 0x140
            'agahnim_defeated' => $converter->convertDialogCompressed("Arrrgggghhh. Well you're coming with me!"),

            'agahnim_final_meeting' => $converter->convertDialogCompressed("You have done well to come this far. Now, die!"),
            // 0x142
            'zora_meeting' => $converter->convertDialogCompressed("What do you want?\n  ≥ Flippers\n    Nothin'\n{CHOICE}"),

            'zora_tells_cost' => $converter->convertDialogCompressed("Fine! But they aren't cheap. You got 500 rupees?\n  ≥ Duh\n    Oh carp\n{CHOICE}"),

            'zora_get_flippers' => $converter->convertDialogCompressed("Here's some Flippers for you! Swim little fish, swim."),

            'zora_no_cash' => $converter->convertDialogCompressed("Fine!\nGo get some more money first."),

            'zora_no_buy_item' => $converter->convertDialogCompressed("Wah hoo! Well, whenever you want to see these gills, stop on by."),

            'kakariko_saharalasa_grandson' => $converter->convertDialogCompressed("My grandpa is over in the East. I'm bad with directions. I'll mark your map. Best of luck!\n{HARP}"),

            'kakariko_saharalasa_grandson_next' => $converter->convertDialogCompressed("Someday I'll be in a high school band!"),

            'dark_palace_tree_dude' => $converter->convertDialogCompressed("Did you know…\n\n\nA tree typically has many secondary branches supported clear of the ground by the trunk. This trunk typically contains woody tissue for strength, and vascular tissue to carry materials from one part of the tree to another."),

            'fairy_wishing_ponds' => $converter->convertDialogCompressed("\n-Wishing pond-\n\nThrow item in?\n  ≥ Yesh\n    No\n{CHOICE}"),

            'fairy_wishing_ponds_no' => $converter->convertDialogCompressed("\n   Stop it!"),

            'pond_of_wishing_no' => $converter->convertDialogCompressed("\n  Fine then!"),

            'pond_of_wishing_return_item' => $converter->convertDialogCompressed("Okay. Here's your item back, 'cause I can't use it. I'm stuck in this fountain."),

            'pond_of_wishing_throw' => $converter->convertDialogCompressed("How many?\n  ≥ᚌᚋ rupees\n   ᚎᚍ rupees\n{CHOICE}"),

            'pond_pre_item_silvers' => $converter->convertDialogCompressed("I like you, so here's a thing you can use to beat up Ganon."),
            // 0x150
            'pond_of_wishing_great_luck' => $converter->convertDialogCompressed("\nis great luck"),

            'pond_of_wishing_good_luck' => $converter->convertDialogCompressed("\n is good luck"),

            'pond_of_wishing_meh_luck' => $converter->convertDialogCompressed("\n is meh luck"),
            // Repurposed to no items in Randomizer
            'pond_of_wishing_bad_luck' => $converter->convertDialogCompressed("Why you come in here and pretend like you have something this fountain wants? Come back with bottles!"),

            'pond_of_wishing_fortune' => $converter->convertDialogCompressed("By the way, your fortune,"),

            'item_get_14_heart' => $converter->convertDialogCompressed("3 more to go\n      ¼\nYay!"),

            'item_get_24_heart' => $converter->convertDialogCompressed("2 more to go\n      ½\nWhee!"),

            'item_get_34_heart' => $converter->convertDialogCompressed("1 more to go\n      ¾\nGood job!"),

            'item_get_whole_heart' => $converter->convertDialogCompressed("You got a whole ♥!!\nGo you!"),

            'item_get_sanc_heart' => $converter->convertDialogCompressed("You got a whole ♥!\nGo you!"),

            'fairy_fountain_refill' => $converter->convertDialogCompressed("Well done, lettuce have a cup of tea…"),

            'death_mountain_bullied_no_pearl' => $converter->convertDialogCompressed("I wrote a word. Just one. On a stone and threw it into the ocean. It was my word. It was what would save me. I hope someday someone finds that word and brings it to me. The word is the beginning of my song."),

            'death_mountain_bullied_with_pearl' => $converter->convertDialogCompressed("I wrote a song. Just one. On a guitar and threw it into the sky. It was my song. It could tame beasts and free minds. It flitters on the wind and lurks in our minds. It is the song of nature, of humanity, of dreams and dreamers."),

            'death_mountain_bully_no_pearl' => $converter->convertDialogCompressed("Add garlic, ginger and apple and cook for 2 minutes. Add carrots, potatoes, garam masala and curry powder and stir well. Add tomato paste, stir well and slowly add red wine and bring to a boil. Add sugar, soy sauce and water, stir and bring to a boil again."),

            'death_mountain_bully_with_pearl' => $converter->convertDialogCompressed("I think I forgot how to smile…"),

            'shop_darkworld_enter' =>  $converter->convertDialogCompressed("It's dangerous outside, buy my crap for safety."),
            // 0x160
            'game_chest_village_of_outcasts' => $converter->convertDialogCompressed("Pay 30 rupees, open 2 chests. Are you lucky?\nSo, play game?\n  ≥ Play\n    Never!\n{CHOICE}"),

            'game_chest_no_cash' => $converter->convertDialogCompressed("So, like, you need 30 rupees.\nSilly!"),

            'game_chest_not_played' => $converter->convertDialogCompressed("You want to play a game?\nTalk to me."),

            'game_chest_played' => $converter->convertDialogCompressed("You've opened the chests!\nTime to go."),

            'game_chest_village_of_outcasts_play' => $converter->convertDialogCompressed("Alright, brother!\nGo play!"),

            'shop_first_time' => $converter->convertDialogCompressed("Welcome to my shop! Select stuff with A.\nDO IT NOW!"),

            'shop_already_have' => $converter->convertDialogCompressed("So, like, you already have one of those."),

            'shop_buy_shield' => $converter->convertDialogCompressed("Thanks! Now you can block fire balls."),

            'shop_buy_red_potion' => $converter->convertDialogCompressed("Red goo, so good! It's like a fairy in a bottle, except you have to activate it yourself."),

            'shop_buy_arrows' => $converter->convertDialogCompressed("Arrows! Cause you were too lazy to look under some pots!"),

            'shop_buy_bombs' => $converter->convertDialogCompressed("You bought bombs. What, couldn't find any under bushes?"),

            'shop_buy_bee' => $converter->convertDialogCompressed("He's my best friend. Please take care of him, and never lose him."),

            'shop_buy_heart' => $converter->convertDialogCompressed("You really just bought this?"),

            'shop_first_no_bottle_buy' => $converter->convertDialogCompressed("Why does no one own bottles? Go find one first!"),

            'shop_buy_no_space' => $converter->convertDialogCompressed("You are carrying to much crap, go use some of it first!"),

            'ganon_fall_in' => $converter->convertDialogCompressed("You drove\naway my other\nself, Agahnim,\ntwo times…\nBut, I won't\ngive you the\nTriforce.\nI'll defeat\nyou!"),
            // 0x170
            'ganon_phase_3' => $converter->convertDialogCompressed("Can you beat\nmy darkness\ntechnique?"),

            'lost_woods_thief' => $converter->convertDialogCompressed("Have you seen Andy?\n\nHe was out looking for our prized Ether medallion.\nI wonder when he will be back?"),

            'blinds_hut_dude' => $converter->convertDialogCompressed("I'm just some dude. This is Blind's hut."),

            'end_triforce' => $converter->convertDialogCompressed("{SPEED2}\n{MENU}\n{NOBORDER}\n     G G"),
            // 0x174
            'toppi_fallen' => $converter->convertDialogCompressed("Ouch!\n\nYou jerk!"),

            'kakariko_tavern_fisherman' => $converter->convertDialogCompressed("Don't argue\nwith a frozen\nDeadrock.\nHe'll never\nchange his\nposition!"),

            'thief_money' => $converter->convertDialogCompressed("It's a secret to everyone."),

            'thief_desert_rupee_cave' => $converter->convertDialogCompressed("So you, like, busted down my door, and are being a jerk by talking to me? Normally I would be angry and make you pay for it, but I bet you're just going to break all my pots and steal my 50 rupees."),

            'thief_ice_rupee_cave' => $converter->convertDialogCompressed("I'm a rupee pot farmer. One day I will take over the world with my skillz. Have you met my brother in the desert? He's way richer than I am."),

            'telepathic_tile_south_east_darkworld_cave' => $converter->convertDialogCompressed("~~ dev cave ~~\n  no farming\n   required"),
            // 0x17A
            'cukeman' => $converter->convertDialogCompressed("Did you hear that Veetorp beat ajneb174 in a 1 on 1 race at AGDQ?"),

            'cukeman_2' => $converter->convertDialogCompressed("You found Shabadoo, huh?\nNiiiiice."),

            'potion_shop_no_cash' => $converter->convertDialogCompressed("Yo! I'm not running a charity here."),

            'kakariko_powdered_chicken' => $converter->convertDialogCompressed("Smallhacker…\n\n\nWas hiding, you found me!\n\n\nOkay, you can leave now."),

            'game_chest_south_of_kakariko' => $converter->convertDialogCompressed("Pay 20 rupees, open 1 chest. Are you lucky?\nSo, play game?\n  ≥ Play\n    Never!\n{CHOICE}"),

            'game_chest_play_yes' => $converter->convertDialogCompressed("Good luck then."),
            // 0x180
            'game_chest_play_no' => $converter->convertDialogCompressed("Well fine, I didn't want your rupees."),

            'game_chest_lost_woods' => $converter->convertDialogCompressed("Pay 100 rupees open 1 chest. Are you lucky?\nSo, play game?\n  ≥ Play\n    Never!\n{CHOICE}"),

            'kakariko_flophouse_man_no_flippers' => $converter->convertDialogCompressed("I sure do have a lot of beds.\n\nZora is a cheapskate and will try to sell you his trash for 500 rupees…"),

            'kakariko_flophouse_man' => $converter->convertDialogCompressed("I sure do have a lot of beds.\n\nDid you know if you played the flute in the center of town things could happen?"),

            'menu_start_2' => $converter->convertDialogCompressed("{MENU}\n{SPEED0}\n≥@'s house\n Sanctuary\n{CHOICE3}", false),

            'menu_start_3' => $converter->convertDialogCompressed("{MENU}\n{SPEED0}\n≥@'s house\n Sanctuary\n Mountain Cave\n{CHOICE2}", false),

            'menu_pause' => $converter->convertDialogCompressed("{SPEED0}\n≥Continue\n Save and Quit\n{CHOICE3}", false),

            'game_digging_choice' => $converter->convertDialogCompressed("Have 80 Rupees? Want to play digging game?\n  ≥Yes\n   No\n{CHOICE}"),

            'game_digging_start' => $converter->convertDialogCompressed("Okay, use the shovel with Y!"),

            'game_digging_no_cash' => $converter->convertDialogCompressed("Shovel rental is 80 rupees.\nI have all day"),

            'game_digging_end_time' => $converter->convertDialogCompressed("Time's up!\nTime for you to go."),

            'game_digging_come_back_later' => $converter->convertDialogCompressed("Come back later, I have to bury things."),

            'game_digging_no_follower' => $converter->convertDialogCompressed("Something is following you. I don't like."),

            'menu_start_4' => $converter->convertDialogCompressed("{MENU}\n{SPEED0}\n≥@'s house\n Mountain Cave\n{CHOICE3}", false),

            'ganon_fall_in_alt' => $converter->convertDialogCompressed("You think you\nare ready to\nface me?\n\nI will not die\n\nunless you\ncomplete your\ngoals. Dingus!"),

            'ganon_phase_3_alt' => $converter->convertDialogCompressed("Got wax in your ears? I cannot die!"),
            // 0x190
            'sign_east_death_mountain_bridge' => $converter->convertDialogCompressed("OWG tournament winners\n{HARP}\n  ~~~2019~~~\nGlan\n\n  ~~~2018~~~\nChristosOwen"),

            'fish_money' => $converter->convertDialogCompressed("It's a secret to everyone."),

            'sign_ganons_tower' => $converter->convertDialogCompressed("You need all 7 crystals to enter."),

            'sign_ganon' => $converter->convertDialogCompressed("You need all 7 crystals to beat Ganon."),

            'ganon_phase_3_no_bow' => $converter->convertDialogCompressed("You have no bow. Dingus!"),

            'ganon_phase_3_no_silvers_alt' => $converter->convertDialogCompressed("You can't best me without silver arrows!"),

            'ganon_phase_3_no_silvers' => $converter->convertDialogCompressed("You can't best me without silver arrows!"),

            'ganon_phase_3_silvers' => $converter->convertDialogCompressed("Oh no! Silver! My one true weakness!"),

            'murahdahla' => $converter->convertDialogCompressed("Hello @. I\nam Murahdahla, brother of\nSahasrahla and Aginah. Behold the power of\ninvisibility.\n{PAUSE3}\n… … …\nWait! you can see me? I knew I should have\nhidden in  a hollow tree."),

            'end_pad_data' => $converter->convertDialogCompressed(""),
            'terminator' => [0xFF, 0xFF]
        ];
    }

    /**
     * Removing the various string that we don't want to actually
     * appear in the randomizer.
     */
    public function removeUnwanted()
    {
        $messages_to_zero = [
            // escort Messages
            'zelda_go_to_throne',
            'zelda_push_throne',
            'zelda_switch_room_pull',
            'zelda_switch_room',
            'zelda_sewers',
            'mountain_old_man_first',
            'mountain_old_man_deadend',
            'mountain_old_man_turn_right',
            'blind_not_that_way',

            // Note: Maiden text gets skipped by a change we will keep, so technically we don't need to replace them
            // Replacing them anyway to make more room in translation table
            'maiden_crystal_1',
            'maiden_crystal_2',
            'maiden_crystal_3',
            'maiden_crystal_4',
            'maiden_crystal_5',
            'maiden_crystal_6',
            'maiden_crystal_7',
            'maiden_ending',
            'maiden_confirm_undersood',
            'maiden_crystal_7_again',

            // Note: Item pickup text is skipped by a change we will keep, so technically we don't need to replace them
            // Replacing them anyway to make more room in translation table
            'item_get_lamp',
            'item_get_boomerang',
            'item_get_bow',
            'item_get_shovel',
            'item_get_magic_cape',
            'item_get_powder',
            'item_get_flippers',
            'item_get_power_gloves',
            'item_get_pendant_courage',
            'item_get_pendant_power',
            'item_get_pendant_wisdom',
            'item_get_mushroom',
            'item_get_book',
            'item_get_moonpearl',
            'item_get_compass',
            'item_get_map',
            'item_get_ice_rod',
            'item_get_fire_rod',
            'item_get_ether',
            'item_get_bombos',
            'item_get_quake',
            'item_get_hammer',
            'item_get_ocarina',
            'item_get_cane_of_somaria',
            'item_get_hookshot',
            'item_get_bombs',
            'item_get_bottle',
            'item_get_big_key',
            'item_get_titans_mitts',
            'item_get_magic_mirror',
            'item_get_fake_mastersword',
            'post_item_get_mastersword',
            'item_get_red_potion',
            'item_get_green_potion',
            'item_get_blue_potion',
            'item_get_bug_net',
            'item_get_blue_mail',
            'item_get_red_mail',
            'item_get_temperedsword',
            'item_get_mirror_shield',
            'item_get_cane_of_byrna',
            'item_get_pegasus_boots',
            'item_get_pendant_wisdom_alt',
            'item_get_pendant_power_alt',
            'pond_item_boomerang',
            'pond_item_bottle_filled',
            'blacksmiths_tempered_already',
            'item_get_whole_heart',
            'item_get_sanc_heart',
            'item_get_14_heart',
            'item_get_24_heart',
            'item_get_34_heart',
            'pond_item_test',
            'pond_will_upgrade',

            // misc
            'agahnim_final_meeting',
            'agahnim_hide_and_seek_found',
            'telepathic_sahasrahla_beat_agahnim',
            'telepathic_sahasrahla_beat_agahnim_no_pearl',
            'magic_bat_wake',
            'magic_bat_give_half_magic',
            'mountain_old_man_in_his_cave_pre_agahnim',
            'mountain_old_man_in_his_cave',
            'mountain_old_man_in_his_cave_post_agahnim',
            'priest_sanctuary_before_leave',
            'priest_sanctuary_before_pendants',
            'priest_sanctuary_after_pendants_before_master_sword',
            'zelda_sanctuary_before_leave',
            'zelda_before_pendants',
            'zelda_after_pendants_before_master_sword',
            'zelda_save_sewers',
            'zelda_save_lets_go',
            'zelda_save_repeat',
            'priest_info',
            'sanctuary_enter',
            'zelda_sanctuary_story',
            'sick_kid_trade',
            'hobo_item_get_bottle',
            'sahasrahla_have_courage',
            'sahasrahla_found',
            'sahasrahla_have_boots_no_icerod',
            'sahasrahla_bring_courage',
            'sahasrahla_quest_have_master_sword',
            'shop_darkworld_enter',
            'shop_first_time',
            'shop_buy_shield',
            'shop_buy_red_potion',
            'shop_buy_arrows',
            'shop_buy_bombs',
            'shop_buy_bee',
            'shop_buy_heart',
            'bomb_shop_big_bomb_buy',
            'item_get_big_bomb',
            'catfish',
            'catfish_after_item',
            'zora_meeting',
            'zora_tells_cost',
            'zora_get_flippers',
            //'zora_no_cash',
            'zora_no_buy_item',
            'agahnim_zelda_teleport',
            'agahnim_magic_running_away',
            'blind_in_the_cell',
            'kiki_first_extortion',
            'kiki_first_extortion_yes',
            'kiki_second_extortion',
            'kiki_second_extortion_yes',
            'witch_brewing_the_item',
            'barrier_breaking',
            'mountain_old_man_lost_and_alone',
            'mountain_old_man_drop_off',
            'pickup_purple_chest',
            'agahnim_defeated',
            'blacksmiths_collect_frog',
            'blacksmiths_what_you_want',
            'blacksmiths_get_sword',
            'blacksmiths_shop_saving',
            'blacksmiths_paywall',
            'blacksmiths_extra_okay',
            'blacksmiths_bogart_sword',
            'blacksmiths_tempered_already',
            'missing_magic',
            'witch_assistant_no_empty_bottle',
            'witch_assistant_informational',
            'bottle_vendor_choice',
            'bottle_vendor_get',
            'game_digging_choice',
            'game_digging_start',
            'dark_flute_boy_storytime',
            'dark_flute_boy_get_shovel',
            'thief_money',
            'game_chest_village_of_outcasts',
            'game_chest_village_of_outcasts_play',
            'hylian_text_2',
            'desert_entry_translated',
            'uncle_dying_sewer',
            'telepathic_intro',
            'desert_thief_sitting',
            'desert_thief_following',
            'desert_thief_question',
            'desert_thief_question_yes',
            'desert_thief_after_item_get',
            'desert_thief_reassure'
        ];

        foreach ($messages_to_zero as $msg) {
            $this->text_array[$msg] = $this->converter->convertDialogCompressed("{NOTEXT}", false);
        }
    }
}

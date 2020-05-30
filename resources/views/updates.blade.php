@extends('layouts.default', ['title' => 'Updates - '])

@section('content')

<h2>v31.0.5</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Use BPS for patching.</li>
        <li>Minor logic fixes.</li>
        <li>Added new player options<br />
            <img src="https://alttpr.s3.us-east-2.amazonaws.com/sprites.31.0.5.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
</div>

<ins class="adsbygoogle" style="display:inline-block;width:100%;height:90px" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408"></ins>

<h2>v31.0.4</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>The logic for Ganon was updated to include a fire source when playing Swordless weapons.</li>
        <li>Minor logic fixes</li>
        <ul>
            <li>Open OWG/MG: Spinspeed entry into Ganon's Tower no longer requires a sword</li>
            <li>Inverted: The Flippers will no longer be placed on Lake Hylia Island with No Glitches logic.</li>
            <li>Inverted logic has new unit tests, which should ensure future logic bugs do not appear.</li>
            <li>Fixed logic checks that involve ensuring the player can fire the bow.</li>
            <li>Ice Palace: Allow access to the right side chests with one Small Key if the Big Key is accessible in a right-side chest (this permits access to these locations without the Hookshot).</li>
            <li>Ice Palace: Allow access to the right-side chests in Retro World State, regardless of the Big Key location.</li>
            <li>Other miscellaneous glitched logic bug fixes</li>
        </ul>
        <li>The correct number of small keys will be removed from the item pool when choosing Retro World State.  This is based on the item pool setting (-10 keys for Normal, -15 for Hard and Expert).</li>
        <li>Added additional text selections for Uncle, Blind, Ganon, and joke hints.</li>
        <li>Vanilla swords now properly place all four Progressive Swords in the world, unless the goal is Master Sword Pedestal.</li>
        <li>There is now a 5% chance that the daily challenge will be a mystery.</li>
        <li>A new message will appear on the permalink for mystery games to indicate that it is a mystery game.</li>
        <li>The hint Ganon provides for the Progressive Bow not found by the player will indicate if Silver Arrows were unobtainable.  This hint applies to Hard, Expert, and Crowd Control item pool settings.</li>
        <li>Renamed the "Generate ROM" and "Generate ROM (with spoilers)" buttons to "Generate Race ROM" and "Generate Normal ROM" to more clearly indicate each button's purpose.</li>
        <li>Added additional checks to ensure that the logic provides some offensive capability in enemy kill rooms if the enemy health setting is something other than "Default."</li>
        <li>Customizer: Enemizer options (boss shuffle, enemy shuffle, enemy damage, and enemy health) are now available.  Customizing boss locations is not yet supported.</li>
        <li>Customizer: It is now possible to manually place Uncle's item when choosing Standard state and randomized swords.</li>
        <li>Crowd Control: Properly remove the Bug Catching Net from the Crowd Control item pool.  Blue mail armor upgrade is also available again in Crowd Control.</li>
        <li>Added API endpoint for retrieving the hash and day of the latest daily (/api/daily).</li>
    </ul>
</div>

<h2>v31.0.3</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Mirror wraps removed from OWG logic ;__;</li>
        <li>Uncle credit updated for progressive bow</li>
        <li>Old permalinks will work with BG music disable now</li>
        <li>Ginormous Overhaul of glitched logics</li>
        <li>Fixed Silver Arrows being unavailable in Swordless games with a Hard+ Item Pool setting</li>
        <li>Fixed hints in customizer games</li>
        <li>Fixed issue with manually placed Triforce Pieces were not counted in customizer.</li>
        <li>Customizer players may now set what rom fixes are applied to their glitched games.</li>
        <li>Added Underworld One Frame Clips to customizer Logic Settings<li>
        <li>API support for mystery games</li>
        <li>API support for z3rsim</li>
        <li>Miscellaneous site content updates</li>
    </ul>
</div>

<h2>v31.0.2</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Customizer spoiler toggle added</li>
        <li>Permalink page settings not saving fixed</li>
        <li>File name shortened</li>
        <li>Hint updates</li>
        <li>Daily Generation glitched logic fix</li>
        <li>Console generation memory leak fix</li>
        <li>Thieves’ Town 100% locations key bug fix</li>
        <li>Quickswap fixed on spoiler generation</li>
        <li>Daily weights adjustments</li>
        <li>Fix Customizer bug with item placement</li>
    </ul>
</div>

<h2>v31.0.1</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Hint updates</li>
        <li>Updates to Glitched logics</li>
        <li>Customizer 2x armor bug fixed</li>
        <li>Quickswap fixed on Entrance generation</li>
        <li>Crowd Control and Basic placement</li>
        <li>Allow progression in Pinball Room when not forcing key</li>
    </ul>
</div>

<h2>v31</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Progressive Bows</li>
        <li>Unified interface for Item Randomizer, Entrance Randomizer, and Enemizer</li>
        <li>Presets!</li>
        <li>Triforce Hunt has a turn in point instead of insta-warp to end</li>
        <li>New Item Placement option</li>
        <li>New Accessibility option</li>
        <li>New Fast Ganon goal</li>
        <li>New options Tower entry and Ganon vulnerablity</li>
        <li>Entrance shuffle supports standard and inverted</li>
        <li>Hints can be toggled in main interface</li>
        <li>Removed Uncle Assured weapons option</li>
        <li>Added Vanilla and Assured weapons options</li>
        <li>Difficulty split into Item Pool and Item Functionality</li>
        <li>Palette Shuffle has moved to a post-generation option</li>
        <li>Pot Shuffle has been removed (for now)</li>
        <li>Removed variations</li>
        <li>Retro moved to world state</li>
        <li>Keysanity moved to Dungeon Items and now has more options</li>
        <li>OWG may require mirror wraps now</li>
        <li>Customizer logic flags</li>
        <li>Customizer starting eq added pendants and crystals</li>
        <li>Faster fairies</li>
        <li>Fix for bunny pallet when mapping</li>
        <li>Fix for losing glove colors</li>
        <li>Fix for link's pallet affecting NPCs</li>
        <li>MSU-1 Expanded track list</li>
        <li>SPC fallback for MSU-1 (NoBGM option is no longer required for MSU-1)</li>
        <li>Music logic is fixed in inverted mode</li>
        <li>Myramong's wallmaster fix</li>
        <li>Added new player options<br />
            <img src="https://alttpr.s3.us-east-2.amazonaws.com/sprites.31.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
    <div class="card border-info mt-4">
        <div class="card-header bg-info text-white">View updates</div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/DJUBFGdKIPE?rel=0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<ins class="adsbygoogle" style="display:inline-block;width:100%;height:90px" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408"></ins>

<h2>v30.5</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Updated Entrance Randomizer to v0.6.2 (now with more hints).</li>
        <li>Added new player options<br />
            <img src="https://alttpr.s3.us-east-2.amazonaws.com/sprites.30.5.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
</div>

<h2>v30.4</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Fixed bottle with random in customizer</li>
        <li>Fixed key-sanity menu in customizer</li>
        <li>Fixed generic key on uncle</li>
        <li>Fixed missing 3rd skull woods key</li>
        <li>Fixed tablets not having progression due to swords</li>
        <li>Fixed junk fill in no logic</li>
        <li>Fixed sewers key in inverted</li>
        <li>Fixed buying shields in hard+</li>
        <li>Updated replacement to be green 20 rupees</li>
        <li>Fixed witch text when you have mushroom and talk to her</li>
        <li>Fixed hard+ pieces of heart missing</li>
        <li>Fixed customizer &lt;3 starting hearts by not allowing &lt; 3 starting hearts</li>
        <li>Fixed spelling of Knockout</li>
        <li>Added under water to zora and catfish hints</li>
        <li>Removed triforce hunt difficulty options description</li>
        <li>Fixed Skull Woods Customizer extra key</li>
    </ul>
</div>

<h2>v30.3</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Hints:<ul>
        <li>Fixed a bug where old V29 general hints were sometimes coming through in V30</li>
        <li>Fake hints now have a :LinkFace: included to more easily identify them</li>
        </ul></li>
        <li>Added Race ROM support to Customizer and split generated Customizers to their own tab</li>
        <li>Added warning to OHKO/Enemizer that it may be impossible with unlucky enemy placements</li>
        <li>In inverted the NPC “thing” in Dark Chapel now instafills your health without any text (but still costs you 20 rupees!)</li>
        <li>Fixed a bug where the Blacksmith would give theitem even if you didn’t have 10 rupees!<ul>
            <li>A text box has been added to tell you if you have insufficient rupees</li>
        </ul></li>
        <li>Fixed a bug in Inverted where some enemies in Agahnim’s Tower and Old Man Cave had DW properties</li>
        <li>Added a “loading animation” when ROMS are being generated so people know things are happening!</li>
        <li>Fixed a bug where Crystals sometimes wouldn’t drop in boss rooms in extremely rare situations</li>
        <li>Updated Pedestal/Tablets texts to reference generic keys in Retro and not specific keys</li>
        <li>Updated ER permalinks to include Quick Swap</li>
        <li>Bomb/Arrow Capacity Upgrades:<ul>
            <li>Hard: now only sells two +5 upgrades and one +10 upgrade at an increased cost of 200 rupees each</li>
            <li>Expert/Insane: removed all capacity upgrades</li>
        </ul></li>
        <li>Updated Old Man so that he still appears if the Purple Chest has been moved but not turned into the Desert Thief</li>
        <li>Added a sprite page to the website detailing more info and crediting the authors</li>
    </ul>
</div>

<h2>v30.2</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Fixed a bug where ROM corruptions were happening in Enemizer/Inverted</li>
        <li>Fixed a bug where exiting to random places on the Overworld were happening in Inverted</li>
        <li>Fixed a bug with Gold Sword showing on the title/credits tracker when Swordless</li>
        <li>Removed bomb and arrow capacity upgrade references on the website</li>
        <li>Removed hammer only logic for Helmasaur (it’s now just ‘Sword or Bow’)</li>
        <li>Updated Enemizer label “Bosses” to “Boss Shuffle” for more clarity</li>
        <li>Reordered Variations: Keysanity, Retro, Timed Race, Timed OHKO, OHKO</li>
        <li>Key-sanity has been relabelled to Keysanity</li>
        <li>Removed the guaranteed small key in pinball room of Skull Woods in No Logic</li>
        <li>Re-enabled vanilla “fake world” behaviour in all Glitched logics</li>
        <li>Fixed a bug where Triforce Pieces were not working properly in Customizer</li>
        <li>Arrow capacity upgrades have been removed from Pond of Happiness in Retro</li>
        <li>Updated hints for keys in Retro to read “a generic key” instead of the specific key names</li>
        <li>Added the missing “Enemy Shuffle” to Entrance Randomizer</li>
        <li>Updated all fake hints to be in green text to be clearer that they’re not actual hints</li>
        <li>Updated Sahasrahla’s item location to “is held by the Kakariko village elder” instead of “held by a sage” to be clearer</li>
        <li>Big Keys are removed from hints in all modes except Keysanity (except for when they’re in a “worst location”)</li>
        <li>FIxed a bug where the second copy of Silver Arrows were reverting to Wooden Arrows in Retro/Easy</li>
        <li>Updated logic for shops access in Inverted to prevent softlocks (!)</li>
        <li>Updated hints for NPC locations to read “held by someone friendly” to be clearer</li>
        <li>Reverted  Ice Palace logic back to V29 due a keylock which was identified</li>
    </ul>
</div>

<h2>v30.1</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Added Standard State/Enemizer initial compatibility</li>
        <li>Added Boots as initial equipment to No Logic</li>
        <li>Removed generic keys from Customizer</li>
        <li>Fixed incorrect text when reading Pedestal Tablet</li>
        <li>Updated Enemizer labels:<ul>
            <li>Boss Shuffle: Off, Simple, Full, Chaos</li>
            <li>Enemy HP: Default, Easy, Normal, Hard, Brick Wall</li>
            <li>Enemy Damage: Default, Shuffled, Chaos</li>
            </ul>
        </li>
        <li>Hints:<ul>
            <li>Removed Big Keys from non-keysanity hints</li>
            <li>Added Progressive Gloves to “unique items” list</li>
            <li>Updated Swords to be called “something sharp”</li>
            <li>Updated Purple Chest to “in a chest requiring a specialist to unlock”</li>
            <li>Lumberjack location no longer has incorrect “requires bombs” instead of “requires boots”</li>
            <li>Swamp map chest no longer has incorrect “requires hammer”</li>
            <li>The following have been added to “is in plain sight”<ul>
                <li>Spectacle Rock Cave</li>
                <li>Spectacle Rock HP</li>
                <li>Floating Island</li>
                <li>Desert Torch</li>
                <li>Ganon’s Tower Torch</li>
                <li>Hera Basement Cage</li>
                </ul>
            </li>
            <li>Desert Torch and Ganon’s Tower Torch now have “requires boots”</li>
            <li>Ganon’s Tower Tile Room now has “requires Cane of Somaria”</li>
            <li>Kakariko Well Bomb Wall Chest now has “requires bombs”</li>
            <li>Sahasrahla’s back 3 chests no longer incorrectly has “requires bombs”</li>
            <li>Back of Escape 3 chests no longer incorrectly has “requires bombs”</li>
            <li>Most Turtle Rock locations now correctly have “requires Cane of Somaria”</li>
            <li>Added Swamp Palace Flooded Room Chests to “are underwater”</li>
            </ul>
        </li>
    </ul>
</div>

<h2>v30</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Front end rewrite into Vue framework... you have no idea how much went into this</li>
        <li>Site translations! De rien! Bitte! ¡De nada!</li>
        <li>Fixed a bug where swords weren’t tracked correctly in the stats in Retro</li>
        <li>Fixed a bug where the freestanding item in Hera did not increment the Compass item tracker (Easy/Keysanity)</li>
        <li>Fixed the keysanity game crashes that happened frequently  in Palace of Darkness in Keysanity</li>
        <li>Fixed the bug in Zora’s Domain where the ledge item would have graphical issues</li>
        <li>Fixed the bug where the 2nd copy of Silver Arrows in Easy didn’t revert back to 10 arrows</li>
        <li>Fixed Uncle accidentally giving 300 rupees along with the Bow in non-retro </li>
        <li>Fixed a bug where maps/compasses didn’t track correctly in Easy/Keysanity if bosses have a progressive sword</li>
        <li>Uncle no longer gives ammo refills unless you’re playing Standard/Randomized or Standard/Swordless</li>
        <li>Uncle now has an equal chance to give Swords in Standard/Randomized</li>
        <li>Disabled stored weak/strong EG when exiting Palace of Darkness (No Glitches logic only)</li>
        <li>Zora will tell you if if you don’t have enough rupees</li>
        <li>Easy difficulty starts with 6 hearts and has 3 extra containers in the pool which revert to rupees once you have 20</li>
        <li>Added logic in Retro to account for the progressive sword in the take-any cave, and keys and arrows</li>
        <li>Added Enemizer</li>
        <li>Hard+ mode no longer has Fairies or Full magic’s available in the prize packs</li>
        <li>The Lake Hylia Great fairy is back from vacation and now sells her upgrades like any shop</li>
        <li>Relatedly, the capacity upgrades have been removed from the item pool</li>
        <li>Added Inverted mode!</li>
        <li>HINTS! go check your telepathic tiles for sometimes helpful hints</li>
        <li>There is the only one save file</li>
        <li>There is a tracker on file select and end screens now</li>
        <li>You now get full refills on purchased upgrades</li>
        <li>Customizer got prize pack editing</li>
        <li>Great fairy bottle refills are completely automated and only have 1 text box now, so faster fills</li>
        <li>Added new player options<br />
            <img src="https://alttpr.s3.us-east-2.amazonaws.com/sprites.30.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
    <div class="card border-info mt-4">
        <div class="card-header bg-info text-white">View updates</div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vdqTpCH1sCM?rel=0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<ins class="adsbygoogle" style="display:inline-block;width:100%;height:90px" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408"></ins>

<h2>VT8.29</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Easy mode now gets 2 chances at silver arrow upgrade</li>
        <li>Triforce hunt lessens the chance of finding triforce pieces in GT</li>
        <li>Removed the GT Junk pre-fill for all glitched modes</li>
        <li>Warning message on generation page when you select anything other than No Glitches logic</li>
        <li>Small keys in spoiler for key-sanity</li>
        <li>Maps/Compasses logically required for completion of dungeon in keysanity</li>
        <li>Mirror warp sound is back in background music disable</li>
        <li>Better placement of maps/compassess in dungeons</li>
        <li>Byrna no longer protects you in hard/expert/insanity, but also uses normal amounts of magic</li>
        <li>Customizer:<ul>
            <li>Added "Test Generation" button, so you don't bloat the DB when just testing ideas</li>
            <li>Removed some unuseful items</li>
            <li>Fixes for better crystal/pendant placement (less broken generations)</li>
            <li>Fairy bottle fix</li>
            <li>Item listing cleanup and normalizing</li>
            <li>Bottles can be set in starting equipment</li>
            <li>Name listed in meta section</li>
            <li>Item list header should be sticky</li>
            <li>Remembers where you were</li>
            <li>Save/Restore settings!</li>
            <li>Names matter (well, more than they used to)</li>
            <li>Add notes to your custom games</li>
            <li>Set the hard mode adjustments (e.g. bottle refill)</li>
            <li>You can allow dark room navigation</li>
            <li>Pendants/Crystals can not be set for more than one dungeon</li>
            <li>Pendants/Crystals should be more helpful when selecting them</li>
            <li>You can set Link's starting health</li>
        </ul></li>
        <li>Key-sanity logic fixes</li>
        <li>Sahasrahla and Bomb Shop dude will mark your map after you talk to them</li>
        <li>Stored water walking glitch is back</li>
        <li>Triforce Hunt is now always 20/30 for all difficulties</li>
        <li>All Lamps in Easy are before dark rooms</li>
        <li>Extra Lamps in Easy are really rupees now</li>
        <li>Flute time in credits fixed</li>
        <li>Better boss logic for future fun</li>
        <li>Added quick swap functionality</li>
        <li>If you use a headered rom, the site will try to strip that header out before use (thanks Myramong)</li>
        <li>Added new player options<br />
            <img src="https://alttpr.s3.us-east-2.amazonaws.com/sprites.29.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
    <div class="card border-info mt-4">
        <div class="card-header bg-info text-white">View updates</div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xO-ObKYmB2A?rel=0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<h2>VT8.28</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Daily Challenges</li>
        <li>Tweaked the Bees a little</li>
        <li>Glitched modes start Link with Boots</li>
        <li>You can always S&amp;Q from Boss room after collecting the boss item</li>
        <li>Swordless mode now allows the use of Bombos to get through Ice Palace</li>
        <li>Single chests locked behind key doors can contain the keys needed to get to them (1-1 logic)</li>
        <li>Fast Menu is now a select for what speed you want</li>
        <li>Update to use new zspr format for Sprites</li>
        <li>Credits updated</li>
        <li>Updated Entrance Randomizer to v0.5.2.1 (has many more options, thanks KevinCathcart)</li>
        <li>Some Grammar fixes (thanks fatmanspanda)</li>
        <li>Ganon's Tower Big Key logic fix (thanks pancelor)</li>
        <li>Rom checksum fix (thanks qwertymodo)</li>
        <li>Added API endpoints to allow integrations with sprites/settings (thanks roxas232)</li>
        <li>Redesign of the site to be easier to locate information and look nicer (thanks walking_eye)</li>
        <li>Customizer fixes based on feedback<ul>
            <li>Bottles work much better</li>
            <li>Set starting equipment for Link</li>
            <li>Loosened some unnessary logic restrictions</li>
            <li>Better error messages when generation fails</li>
        </ul></li>
        <li>Added new player options<br />
            <img src="https://08b3693090b88cc23068-781cc7889ba8761758717cf14b1800b4.ssl.cf2.rackcdn.com/sprites.28.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
</div>

<h2>VT8.27</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Easy difficulty will always have dungeon counts in HUD enabled</li>
        <li>Added + to golden bee bottle in menu</li>
        <li>Added letter to signify bottle contents for potions in menu</li>
        <li>Added "fast menu" under Rom options, not available in Race Roms</li>
        <li>Hard/Expert/Insane has default magic usage for Blind/Ice Palace spike room/Turtle Rock laser bridge</li>
        <li>Added key-sanity</li>
        <li>Updated ending sequence to allow better tag lines</li>
        <li>Corrected Bow placement issue in Palace of Darkness</li>
        <li>Added insane difficulty</li>
        <li>Added Ganon shuffle to ER Madness and Insanity modes</li>
        <li>Removed standard mode from ER</li>
        <li>Cleaned up the spoiler section of the site to assist in finding things</li>
        <li>Complete overhaul of the custom section, see the new <a href="/customizer">customizer</a></li>
        <li>Added many new player options<br />
            <img src="https://08b3693090b88cc23068-781cc7889ba8761758717cf14b1800b4.ssl.cf2.rackcdn.com/sprites.27.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
    <div class="card border-info mt-4">
        <div class="card-header bg-info text-white">View updates</div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/u8QMJsqMGJw?rel=0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<h2>VT8.26.2</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Turtle Rock small key fix</li>
        <li>Skull Woods small key fix</li>
        <li>Added a few new player options<br />
            <img src="https://08b3693090b88cc23068-781cc7889ba8761758717cf14b1800b4.ssl.cf2.rackcdn.com/sprites.4.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
</div>

<h2>VT8.26</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>updated timed-OHKO for different difficulties</li>
        <li>Boots are no longer guaranteed in Sanctuary for Major Glitches</li>
        <li>Hammer can now activate tablets in swordless</li>
        <li>Numerous rom related bugs fixed</li>
        <li>Added some descriptions to the ER shuffle modes from docs</li>
        <li>Waterfall fairy no longer upgrades shield/boomerang</li>
        <li>Added Triforce Hunt goal/variation</li>
        <li>Bug Net added back to all difficulties (hard/expert cannot catch fairies)</li>
        <li>Cape and Byrna use normal magic in all difficulties in Spike cave and spike room in Misery Mire</li>
        <li>Spike cave does normal damage in all difficulties</li>
        <li>Added easy difficulty</li>
        <li>Split difficulties into difficulty and variation</li>
        <li>¼ magic is no longer in normal/hard/expert</li>
        <li>Turtle Rock laser bridge requires Cape or Cane of Byrna or Mirror Shield</li>
        <li>Byrna (Spike) Cave and Misery Mire spike room now requires Cape or Cane of Byrna</li>
        <li>Logic update for keys</li>
        <li>Tuning to fill algorithm</li>
        <li>Entrance Randomizer integration (thanks LLCoolDave)</li>
        <li>Two new chests have been added to Waterfall fairy</li>
        <li>Added many new player options (and updated a few)<br />
            <img src="https://08b3693090b88cc23068-781cc7889ba8761758717cf14b1800b4.ssl.cf2.rackcdn.com/sprites.3.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
    <div class="card border-info mt-4">
        <div class="card-header bg-info text-white">View updates</div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/L3FdC-f7f38?rel=0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<h2>VT8.25</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Fake Flippers death safey has been readded</li>
        <li>Green Pendant has an asterisk in the map to help with low visual acuity</li>
        <li>Digging game plays sound when prize is dug up</li>
        <li>Fixed save and quit/continue inconsistencies with Ganon's Boss room</li>
        <li>Fixed Cane of Byrna OHKO bug</li>
        <li>Spoilers on site should be easier to navigate</li>
        <li>Unique hash on player select screen is properly named "hash"</li>
        <li>Non-killable Ganon is only not killable in 4th phase</li>
        <li>Ganon is more helpful with his dialog when you can't kill him</li>
        <li>Using book on a tablet when you don't have an upgraded sword will give you a hint like the Pedestal</li>
        <li>Added ability to mute background music</li>
        <li>Added Overworld Glitches Logic</li>
        <li>Removed Minor Glitches (SpeedRunner) Logic</li>
        <li>Uncle's boots hint removed</li>
        <li>Overworld bonk locations are no longer randomized</li>
        <li>Special chest under Ganon removed in all modes</li>
        <li>Added search of spoilers to quickly find items</li>
        <li>Skull Woods spike trap room chest set back to Key all the time</li>
        <li>New Fill algorithm that maximizes item randomization</li>
        <li>Added many new player options<br />
            <img src="https://08b3693090b88cc23068-781cc7889ba8761758717cf14b1800b4.ssl.cf2.rackcdn.com/sprites.2.lg.png"
                alt="Link sprite options" style="width:50%" /></li>
    </ul>
    <div class="card border-info mt-4">
        <div class="card-header bg-info text-white">View updates</div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/n0_SnUraLL8?rel=0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<h2>VT8.24</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Sword Upgrades are dealt with differently by the fill algorithm to be distributed more evenly over the game world.</li>
        <li>New Full Distribution <a href="https://docs.google.com/spreadsheets/d/17-_wlQBC6Fnt6qSoAkao1NAEoBXeDUmrGCNX5y7auNA" target="_blank" rel="noopener noreferrer">here</a></li>
        <li>Crystals 5 and 6 are now colored red in the menu (once collected) to avoid confusion over which crystal is which.</li>
        <li>Fixed the bug where Purple Chest was removed when you s+q to Sanctuary</li>
        <li>Fixed the bug where swords weren’t really removed in Swordless</li>
        <li>Fixed the bug where Link sometimes turned into a black bunny…</li>
        <li>Fixed the bug where you dug up vultures</li>
    </ul>
</div>

<h2>VT8.23</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>The bookcase in the throne room of Hyrule Castle can now be moved without Zelda once she has been rescued</li>
        <li>The logic for the 4 chests in Sewers have had the Gloves requirement removed as you can no longer softlock</li>
        <li>The large rock outside Hyrule Castle which is accessible during the rain state has been blocked with guards</li>
        <li>The logic for Link’s House has had the Gloves requirement removed as it no longer poses any problems</li>
        <li>Sprite palette updates offering more choices (Bunny, Old Man, Zora etc)</li>
        <li>The menu icon for when you found Silver Arrows before bow has been removed</li>
        <li>The Arrows HUD icon is now silver when you have Silver Arrows selected in the menu, or found them before Bow<ul>
            <li>This refers to the icon at the top of the screen, next to hearts, rupees and bombs</li>
        </ul></li>
        <li>Various gameplay elements have had their RNG restored in a way that is consistent for all players<ul>
            <li>The digging game prize is found on a random dig between 1 and 30</li>
            <li>The chest game prize is found in either the 1st chest (12.5% chance) or 2nd chest (100% chance)</li>
            <li>All boss attack patterns (e.g. Helmasaur’s fireballs, Lanmolas’ spawn patterns, etc)</li>
        </ul></li>
        <li>All Goals now make Ganon invincible until the Goal conditions are met (e.g. All Dungeons)</li>
        <li>Fixed the bug where s+q was temporarily disabled after collecting a crystal or pendant</li>
        <li>Fixed a bug in Open mode relating to how the Fat Faerie dealt with Progressive Swords</li>
        <li>Fixed various free-roaming text glitches</li>
        <li>Fixed various music glitches (Hobo, top floor of Hera)</li>
        <li>Fixed a bug with how Ganon’s warps were being handled in the 3rd phase</li>
        <li>Fixed the statistics to correctly track swordless boss kills</li>
        <li>Maps and compasses have been re-added [hard/expert]</li>
        <li>You can s+q/mirror in boss rooms after they’re dead and the heart drop has been collected [glitched]</li>
        <li>Ganon can be hurt by the Hammer [swordless]</li>
        <li>The curtains in Skull Woods and Aghanim's Tower have been pre-opened [swordless]</li>
        <li>You can use medallions swordless outside Misery Mire and Turtle Rock (but nowhere else) [swordless]</li>
        <li>The 4 swords have been removed from the pool and replaced with 20 rupees [swordless]</li>
    </ul>
    <div class="card border-info mt-4">
        <div class="card-header bg-info text-white">View updates</div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/GaUggPXL3M0?rel=0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<h2>VT8.22</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>The free lamp cone has been removed in the Light World (dark rooms are still never required the logic)</li>
        <li>The frog now persists through s+q (and death) as per vanilla</li>
        <li>The frog stays as a frog (spawn in DW) and changes to the smith (spawn in LW) to avoid polarity conflicts</li>
        <li>Aghanim's Tower is no longer locked before Zelda has been rescued</li>
        <li>Re-added blue balls on Agahnim 1+2 and warps on Ganon with equivalent RNG for all players</li>
        <li>Fake flippers death safety fix has been removed from all versions (now acts as per vanilla)</li>
        <li>Added functionality to choose from a set of custom sprites for Link</li>
        <li>Goals are now controlled by making Ganon invulnerable until the goal conditions have been achieved<ul>
            <li>For example in Master Sword Pedestal Ganon is invulnerable until you pull the item</li>
        </ul></li>
        <li>Fixed the weird lamp cone graphics caused when a lit torch extinguishes when you do not have the Lamp</li>
        <li>Dwarf no longer has Zelda graphics loaded if you s+q to Sanctuary with him (!)</li>
        <li>Loose bombs (e.g. from enemies/pulls/bonks) now auto-equip if they’re your first item found</li>
        <li>Graphical bugs caused by having access to or beating Agahnim 1 before rescuing Zelda have been fixed</li>
        <li>Updated various text, including pedestal definitions, for more clarity</li>
        <li>Back-end updates, including changing how base ROM is stored in browser<ul>
            <li>This should be the final time you have to select the JP 1.0 ROM</li>
        </ul></li>
        <li>Mirror has been removed from the logic of Blacksmith and Purple Chest (because you can s+q with both)</li>
        <li>Skull Woods guaranteed small key has been randomized to be in any of the left-loop chests</li>
        <li>Light World logic has been updated to account for the removal of the free lamp cone</li>
        <li>Logic fixes for Escape/Sewers for various game modes</li>
        <li>Created Swordless logic to be fully released as a game mode soon™</li>
        <li>After 66% of progression items have been placed the remaining 33% get placed from the end of the list<ul>
            <li>This reduces the bias of situations like Ice Rod being placed in Turtle Rock, etc.</li>
        </ul></li>
        <li>Silvers and non-required Progressives Swords are no longer placed as progression items<ul>
            <li>This removes the bias of these items being placed in late-game locations</li>
        </ul></li>
        <li>Non-progression items (e.g. Bug Net) are now placed completely randomly after progressive items<ul>
            <li>This removes the bias of these items being placed in late-game locations</li>
        </ul></li>
        <li>Beating Agahnim 1 is now tracked in the spoiler playthrough and referred to in the logic</li>
        <li>Statistics of item placements using the new algorithm (100k seeds) can be seen
            <a href="https://docs.google.com/spreadsheets/d/1mAcoPHQM2XRLhrBM2BPeccvhHfoCQNigwlAYASe2Jjs/pubhtml" target="_blank" rel="noopener noreferrer">here</a></li>
        <li>Masochist has been renamed to Expert</li>
        <li>Powdering anti-faeries turns them into single hearts [hard]</li>
        <li>Bottles can be found prefilled with everything except faeries (including from Great Faeries) [hard/expert]</li>
        <li>Rupoors have been removed [hard/expert]</li>
        <li>Updated logic in Mire, Hera and Swamp to correctly account for duping [glitched]</li>
        <li>Map no longer breaks after you’ve beaten Ganon’s Tower [glitched]</li>
        <li>Fake DW no longer corrupts Agahnim 2 [glitched]</li>
    </ul>
    <div class="card border-info mt-4">
        <div class="card-header bg-info text-white">View updates</div>
        <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/YCTbYA_eVNw?rel=0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<h2>V8 Updates</h2>
<div class="card card-body bg-light mb-3">
    <p>Switched to VT web based version</p>

    <div class="card card-body bg-light mb-3">
        <h3>Modes</h3>
        <h4>Open</h4>
        <ul>
            <li>Link’s Uncle is now a regular item location and the Fighter’s Sword is part of the item pool</li>
            <li>You no longer get a free lamp cone in the Sewers or anywhere in the Light World</li>
            <li>Speaking to Uncle/speaking to Zelda in her cell no longer reactivates the rain state</li>
            <li>Hyrule Castle/Sewer small key can be placed anywhere (except Boom chest + Zelda’s cell)</li>
            <li>Casual logic has had lamp updates for all of Light World (Eastern, DM, AT)</li>
            <li>Boss logic has been updated to account for the potential lack of sword</li>
            <li>Updated Fighter’s Sword so collecting it doesn’t downgrade higher level swords</li>
            <li>Link’s House and Sanctuary are default S+Q points which are available from the start</li>
            <li>All interim s+q points have been removed (Uncle, Zelda’s cell, throne room, Old Man in DM caves)</li>
            <li>Hyrule Castle gate is always open</li>
            <li>Zelda is pre-rescued in Sanctuary</li>
            <li>Castle/Sewers mantle door is now pushable without Zelda following you</li>
        </ul>
    </div>

    <div class="card card-body bg-light mb-3">
        <h3>Difficulties</h3>
        <h4>Expert</h4>
        <ul>
            <li>Magic Cape has had its magic consumption rate quadrupled</li>
            <li>Added a single bottle to Casual/Speedrunner and all four bottles to Major Glitches</li>
            <li>Magic Powder no longer turns anti-faeries/bunny-spinner into faeries (bees!)</li>
            <li>Increased the cost of shields to 9999 rupees</li>
            <li>Silver Arrows are not in the pool</li>
            <li>12 Heart Pieces (no Heart Containers)</li>
            <li>Only Master Sword is in the item pool (no Tempered or Gold)</li>
            <li>All shields and mails have been removed from the item pool</li>
            <li>No Cane of Byrna, ½ or ¼ Magic, Capacity Upgrades, Boomerangs or Bug Net</li>
            <li>Cane of Byrna cave has had the spike damage reduced to ¼ heart making the chest accessible</li>
            <li>Potions refill 1 heart (red/blue) and ¼ magic bar (green/blue) and are default cost</li>
        </ul>
            <h4>Hard</h4>
        <ul>
            <li>Magic Cape has had its magic consumption rate doubled</li>
            <li>Added two bottles to Casual/Minor Glitches and all four bottles in Major Glitches</li>
            <li>Increased the cost of shields to 2x rupees</li>
            <li>Only the Master Sword and the Tempered Sword are in the item pool (no Gold)</li>
            <li>A safety chest below Ganon containing Silver Arrows has been added</li>
            <li>Magic Powder no longer turns anti-faeries/bunny-spinner into faeries (bees!)</li>
            <li>24 Heart Pieces (no Heart Containers)</li>
            <li>Blue Mail (no red Mail)</li>
            <li>Fighter’s Shield and Fire Shield (no Mirror Shield)</li>
            <li>No Cane of Byrna, ½ or ¼ Magic, Capacity Upgrades, Boomerangs or Bug Net</li>
            <li>Cane of Byrna cave has had the spike damage reduced to ¼ heart making the chest accessible</li>
            <li>Potions refill 5 hearts (red/blue) and ½ magic (green/blue) and are default cost</li>
        </ul>
    </div>

    <div class="card card-body bg-light mb-3">
        <h3>Logics</h3>
        <h3>Major Glitches</h3>
        <ul>
            <li>Crystals always drop while in the fake DW irrespective of conflicting pendants</li>
            <li>Swamp Palace water levels now work as per vanilla (no safety fix)</li>
            <li>The fake dark world now works as per vanilla</li>
            <li>Removed auto lamp cone everywhere except Sewers</li>
            <li>Agahnim 2 is always in Ganon’s Tower regardless of fake DW</li>
        </ul>
        <h3>Minor Glitches</h3>
        <ul>
            <li>Removed auto lamp cone everywhere except Sewers</li>
        </ul>
        <h3>No Glitches (Casual)</h3>
        <ul>
            <li>Pendants and crystals are now fully randomized between the 3 Light World and 7 Dark World dungeons<ul>
                <li>The map correctly shows where pendants and crystals are located</li>
            </ul></li>
            <li>The arrow and bomb capacity upgrades are split over six +5 upgrades and one +10 upgrade (as per vanilla)<ul>
                <li>You don’t get a bomb/arrow refill in addition to the maximum upgrade</li>
                <li>Bomb upgrades replaced “3 bombs” and Arrow upgrades replaced “10 Arrows”</li>
                <li>The 50 bomb and 70 arrow capacity upgrades have been removed (will feature in later versions)</li>
            </ul></li>
            <li>The Master Sword pedestal, Smithy and Fat Faerie are now regular item locations and the swords are in the pool<ul>
                <li>Master Sword pedestal: This gives you the item without changing your sword</li>
                <li>Smithy: He gives you his item in exchange for 10 rupees and skips the tempering process (switch)</li>
                <li>Fat Faerie: Mechanics have been overhauled as follows:<ul>
                    <li>Added 2 chests as item locations replacing Silver Arrows and Gold Sword</li>
                    <li>Limited what you can throw to her to just bottles.</li>
                </ul></li>
            </ul></li>
            <li>Swords, shields and mails are progressive (e.g. Master → Tempered → Gold)</li>
            <li>Bosses can drop dungeon items (map, compasses, small keys and big keys) where the logic allows</li>
            <li>The bonk keys in Desert Palace and Ganon’s Tower are now regular item locations</li>
            <li>The freestanding small key in Tower of Hera is now a regular item location</li>
            <li>Re-added the key doors in Misery Mire and Ganon’s Tower</li>
            <li>Silver Arrows are part of the regular prize pool as an upgrade only (not a second copy of the bow)</li>
            <li>Pull prize packs (3 prizes)  and enemy prize packs (56 prizes) have been merged into one larger pool</li>
            <li>The drop pool also includes the rupee crab (2 prizes), stunned enemies (1 prize) and saved fish (1 prize)</li>
            <li>Overworld bonk prizes (62 prizes) are randomized between themselves</li>
            <li>Enemy prize packs now randomizes both the enemies and the prizes<ul>
                <li>The Book of Mudora translates the Hylian text at the Master Sword pedestal to tell you what the item is</li>
            </ul></li>
            <li>It is not guaranteed to be found before the need to get the Master Sword pedestal item</li>
            <li>The zoom function of the map has been restored back to default behaviour</li>
            <li>The s+q menu is now in English!</li>
            <li>Lots and lots of text updates, translation to English and removal, including the opening credits sequence!</li>
            <li>Link’s House can now contain the Fire Shield and Mirror Shield</li>
            <li>Link’s Uncle no longer gives you the Fighter’s Shield (also removed from his sprite) and it is part of the item pool</li>
            <li>There is a 5% chance Link’s Uncle will tell you which part of the world contains the Pegasus Boots</li>
            <li>Master Sword icon has been removed from the map</li>
            <li>Chest game 2nd chest is no longer guaranteed 100 rupees</li>
            <li>Crystal dungeons always play DW dungeon music; pendant dungeons always play LW dungeon music</li>
            <li>The fake flippers safety fix has been removed from all versions</li>
            <li>The phantom lamp cone has been fixed (when you light a torch with Fire Rod without Lamp)</li>
            <li>The Smithy no longer has Mirror as a forced requirement as he will persist through s+q as per vanilla</li>
        </ul>
    </div>
</div>

<h2>V7 Updates</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Boss hearts and the ½ magic bat statue have been added as new item locations</li>
        <li>Bomb and arrow capacity upgrades have been added to the item pool (70 arrows and 50 bombs)</li>
        <li>Magic capacity upgrades have been added to the the item pool (⅔ chance for ½ and ⅓ chance for ¼)</li>
        <li>Pendants are randomized between the 3 LW dungeons (excluding Aghanim's Tower)</li>
        <li>Crystals are randomized between the 7 DW dungeons (excluding Ganon’s Tower)</li>
        <li>The Master Sword, Tempered Sword and Gold Sword are randomized between themselves</li>
        <li>The Fat Faerie now accepts the Fighter’s Sword and Master Sword in addition to the Tempered Sword</li>
        <li>The Smithy and Fat Faerie will always give you their swords (but it won’t downgrade if it’s worse)</li>
        <li>Swords can no longer be downgraded at the Master Sword pedestal or by the Smithy</li>
        <li>The Smithy no longer needs to be rescued to spawn the Super Bomb (only crystals 5 and 6 are required)</li>
        <li>Mothula now takes damage from the Gold Sword (tempered sword damage values)</li>
        <li>The door to Aghanim's Tower is now locked until Zelda has been rescued (prevents issues with game states)</li>
        <li>The purple chest now returns to its initial location if left on the overworld when you enter a dungeon</li>
        <li>You will always respawn on the Pyramid if you die to Ganon (even if Agahnim has not been defeated)</li>
        <li>The light world flute boy has been removed (fixed issues with crashes and music playing elsewhere)</li>
        <li>Removed all unnecessary Ganon warps in his third phase</li>
        <li>The old man on Death Mountain and the Sanctuary priest no longer refill your magic</li>
        <li>The 3 pots in Link’s house have been changed back to hearts</li>
        <li>The menu now lets you toggle between Bow/Silver Arrows (press Y) and pendants/crystals (press Select)</li>
        <li>The map accounts for pendant/crystal randomization and the zoom functionality has been removed</li>
        <li>The map now horizontally flips the green pendant to address colorblindness accessibility concerns</li>
        <li>Removed more useless dialogue and text (including Japanese item text in the menu)</li>
        <li>The credits have been completely overhauled to show various statistics</li>
        <li>Added randomized text to Link’s uncle</li>
    </ul>
</div>

<h2>V6 Updates</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>The Chest Game is limited to 2 chests per session to prevent crashes (error with v5.2)</li>
        <li>The cursed dwarf is removed when you die or s+q with him following you (error with v5.11)</li>
        <li>The third phase of Ganon has no additional warps (error with v5.13)</li>
        <li>The bat statue now has a ⅔ chance for ½ magic and ⅓ chance for ¼ magic</li>
        <li>The sanctuary priest is now immortal and also refills your magic</li>
        <li>The old man on Death Mountain also refills your magic</li>
        <li>The 3 pots in Link’s house have been changed from hearts to a full magic jar and 2 faeries</li>
        <li>Defeating Agahnim removes followers and keeps the doors to Hyrule Castle open</li>
        <li>Removed a key door in Ganon’s Tower (1F) and Misery Mire (B2) for better key randomization</li>
        <li>Removed the opening psychic message and invisible follower</li>
        <li>Removed all Pyramid text after defeating Agahnim</li>
        <li>Bug fixes (shadow pendant, big key icons, wide sprites, faerie fountains, toggle items, arrow HUD icon)</li>
        <li>Logic fixes and improvements, including always restricting Boots to be accessible without Mitts</li>
    </ul>
</div>

<h2>V5 Updates</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Bottles are randomly filled upon collection with an equal chance for each bottle prize, including empty</li>
        <li>Throwing bottles into Faerie fountains now yields an equal chance for each bottle prize, including empty</li>
        <li>Big Faeries heal your magic in addition to your health</li>
        <li>Digging Game is randomized and guaranteed on first attempt (15th dig)</li>
        <li>Chest Game is randomized and guaranteed on first attempt (2nd chest); you can open all chests in one go</li>
        <li>The medallions required to open Misery Mire and Turtle Rock are randomized</li>
        <li>Mushroom, Magic Powder and Flute are all randomized</li>
        <li>Boomerangs, Mushroom/Powder and Shovel/Flute slots can contain both items, toggling between them with Y</li>
        <li>Bottles do not auto-open when selected in the menu; instead you open with X and toggle between them with Y</li>
        <li>Dying/s+q from a non-dungeon underworld room in the DW now correctly takes you back to LW (error with v3.5)</li>
        <li>The Frog follower is removed if you return to the LW when you s+q or die whilst he is following you</li>
        <li>You can dig up items (hearts, rupees, bombs, arrows, chickens, mines, etc.)</li>
        <li>Ganon will not warp more than twice between hits during his third phase</li>
        <li>Logic improvements (rewritten algorithms to improve item distribution, removal of Hammer/Mitts restrictions)</li>
        <li>NPCs which contain a downgrade of an item you already own will now (harmlessly) give you their items</li>
        <li>Crystal dialogue, Master Sword dialogue, all item text and some Agahnim dialogue removed</li>
        <li>Credits updated to reflect what King Zora sold you</li>
        <li>Bug fixes (bottles not showing in inventory if gotten early, HUD not updating for Silver Arrows)</li>
    </ul>
</div>

<h2>V4 Updates</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>NPCs are no longer guaranteed to give unique items</li>
        <li>Catfish throws a bomb if his item is a downgrade of an item you already have</li>
        <li>Non-chest heart pieces are now randomized</li>
        <li>Bombos and Ether tablets are now randomized</li>
        <li>Book of Mudora is now randomized</li>
        <li>Both 300 rupee NPCs are randomized</li>
        <li>Link no longer needs the Lamp to move the bookshelf during Escape</li>
        <li>Lamp placement is no longer basic to Escape</li>
        <li>Playing flute for flute boy will not cause him to disappear (although he disappears after receiving his item)</li>
        <li>Link does not need the Lamp to see in the dark in the LW</li>
        <li>LW menu now always shows pendants and DW menu now always shows crystals</li>
        <li>Maximum rupee cap has been increased to 9999</li>
        <li>Silver Arrows can no longer be downgraded to regular Bow</li>
        <li>Invisible follower fix (s+q/flute after Master Sword before getting the log text now removes the invisible follower)</li>
        <li>Logic improvements (Lamp, Book, Ether and Bombos placement; overall item placement is more balanced)</li>
        <li>Small key algorithm has been improved, including preventing them from being in Big Chests</li>
        <li>Five 100 rupee prizes were added to the prize pool (replaced three red rupees and the two duplicate Lamps)</li>
        <li>Swamp’s first room correctly empties when leaving the LW and DW overworld screens (error with v1.2)</li>
        <li>Link instantly dies and all faeries are removed if damage is taken during fake flippers after transitioning screens</li>
    </ul>
</div>

<h2>V3 Updates</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Fire Shield is now an NPC/chest item (replaced a 20 rupee chest)</li>
        <li>Mirror Shield and Red Mail are basic to the DW</li>
        <li>Can no longer downgrade the Magic Boomerang and Mirror Shield</li>
        <li>Fire Shield and Mirror Shield cannot be found in Link’s house (to prevent downgrade)</li>
        <li>S+Q from DW after killing Agahnim in absence of Mirror now returns you to LW</li>
        <li>Cannot enter the fake LW if you s+q in a DW dungeon (error with v1.3)</li>
        <li>Small keys are now more generously placed within D1, D4 and D7</li>
        <li>0bb patch fixed (error with v1.4)</li>
        <li>Mitts/Gloves patch fixed (error with v1.5)</li>
        <li>Functionality added to generate a ‘random spoiler’ log file</li>
        <li>Bug fixes (crashes)</li>
        <li>Logic improvements (Sanctuary, Swamp Palace, Turtle Rock, Book of Mudora)</li>
        <li>Output font changed to fixed-width</li>
        <li>ROM size has been increased to 2MB to allow for further changes</li>
    </ul>
</div>

<h2>V2 Updates</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>Bug fixes (seed creation error)</li>
        <li>Logic improvements (accounting for access to lower DW with Hookshot)</li>
    </ul>
</div>

<h2>V1 Updates</h2>
<div class="card card-body bg-light mb-3">
    <ul>
        <li>All unique chests and NPC rewards are randomized; NPCs always give unique items</li>
        <li>Swamp Palace water levels reset upon leaving the overworld screen</li>
        <li>Can no longer enter the fake DW after dying in a DW dungeon before killing Agahnim</li>
        <li>Agahnim 1 and 2 will no longer attack with blue balls</li>
        <li>Can no longer downgrade Titan’s Mitts to Power Gloves</li>
    </ul>
</div>
@overwrite

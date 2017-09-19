@extends('layouts.default')

@section('content')
<h2>VT8.27</h2>
<div class="well">
	<ul>
		<li>Added Ganon shuffle to ER Maddness and Insanity modes</li>
		<li>Cleaned up the spoiler section of the site to assist in finding things</li>
		<li>Complete overhaul of the custom section, see the new customizer</li>
	</ul>
</div>

<h2>VT8.26</h2>
<div class="well">
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
			<img src="http://a4482918739889ddcb78-781cc7889ba8761758717cf14b1800b4.r32.cf2.rackcdn.com/sprites.3.lg.png"
				alt="Link sprite options" style="width:50%" /></li>
	</ul>
	<div class="panel panel-info">
		<div class="panel-heading">View updates</div>
		<div class="panel-body">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/L3FdC-f7f38?rel=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>

<h2>VT8.25</h2>
<div class="well">
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
		<li>New Fill algorithm that maximizes item randimization</li>
		<li>Added many new player options<br />
			<img src="http://a4482918739889ddcb78-781cc7889ba8761758717cf14b1800b4.r32.cf2.rackcdn.com/sprites.2.lg.png"
				alt="Link sprite options" style="width:50%" /></li>
	</ul>
	<div class="panel panel-info">
		<div class="panel-heading">View updates</div>
		<div class="panel-body">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/n0_SnUraLL8?rel=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>

<h2>VT8.24</h2>
<div class="well">
	<ul>
		<li>Sword Upgrades are dealt with differently by the fill algorithm to be distributed more evenly over the game world.</li>
		<li>New Full Distribution <a href="https://docs.google.com/spreadsheets/d/17-_wlQBC6Fnt6qSoAkao1NAEoBXeDUmrGCNX5y7auNA" target="_blank">here</a></li>
		<li>Crystals 5 and 6 are now colored red in the menu (once collected) to avoid confusion over which crystal is which.</li>
		<li>Fixed the bug where Purple Chest was removed when you s+q to Sanctuary</li>
		<li>Fixed the bug where swords weren’t really removed in Swordless</li>
		<li>Fixed the bug where Link sometimes turned into a black bunny…</li>
		<li>Fixed the bug where you dug up vultures</li>
	</ul>
</div>

<h2>VT8.23</h2>
<div class="well">
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
	<div class="panel panel-info">
		<div class="panel-heading">View updates</div>
		<div class="panel-body">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/GaUggPXL3M0?rel=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>

<h2>VT8.22</h2>
<div class="well">
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
			<a href="https://docs.google.com/spreadsheets/d/1mAcoPHQM2XRLhrBM2BPeccvhHfoCQNigwlAYASe2Jjs/pubhtml" target="_blank">here</a></li>
		<li>Masochist has been renamed to Expert</li>
		<li>Powdering anti-faeries turns them into single hearts [hard]</li>
		<li>Bottles can be found prefilled with everything except faeries (including from Great Faeries) [hard/expert]</li>
		<li>Rupoors have been removed [hard/expert]</li>
		<li>Updated logic in Mire, Hera and Swamp to correctly account for duping [glitched]</li>
		<li>Map no longer breaks after you’ve beaten Ganon’s Tower [glitched]</li>
		<li>Fake DW no longer corrupts Agahnim 2 [glitched]</li>
	</ul>
	<div class="panel panel-info">
		<div class="panel-heading">View updates</div>
		<div class="panel-body">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/YCTbYA_eVNw?rel=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>

<h2>V8 Updates</h2>
<div class="well">
	<p>Switched to VT web based version</p>

	<div class="well">
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

	<div class="well">
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

	<div class="well">
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
		<h3>No Major Glitches (Casual)</h3>
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
			<li>No-SRAM trace is enforced when the tournament flag is set</li>
			<li>Chest game 2nd chest is no longer guaranteed 100 rupees</li>
			<li>Crystal dungeons always play DW dungeon music; pendant dungeons always play LW dungeon music</li>
			<li>The fake flippers safety fix has been removed from all versions</li>
			<li>The phantom lamp cone has been fixed (when you light a torch with Fire Rod without Lamp)</li>
			<li>The Smithy no longer has Mirror as a forced requirement as he will persist through s+q as per vanilla</li>
		</ul>
	</div>
</div>

<h2>V7 Updates</h2>
<div class="well">
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
<div class="well">
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
<div class="well">
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
		<li>Enabled automatic updating of the SRAM into the UI (for Zarby89’s HUD)</li>
		<li>Crystal dialogue, Master Sword dialogue, all item text and some Agahnim dialogue removed</li>
		<li>Credits updated to reflect what King Zora sold you</li>
		<li>Bug fixes (bottles not showing in inventory if gotten early, HUD not updating for Silver Arrows)</li>
	</ul>
</div>

<h2>V4 Updates</h2>
<div class="well">
	<ul>
		<li>NPCs are no longer guaranteed to give unique items</li>
		<li>Catfish throws a bomb if his item is a downgrade of an item you already have</li>
		<li>Non-chest heart pieces are now randomized</li>
		<li>Bombos and Ether tablets are now randomized</li>
		<li>Book of Mudora is now randomized</li>
		<li>Both 300 rupee NPCs are randomized</li>
		<li>Link no longer needs the Lamp to move the bookshelf during Escape</li>
		<li>Lamp placement is no longer restricted to Escape</li>
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
		<li>Added functionality to save current item state to SRAM every 4.267 seconds, in support of Zarby89’s HUD tool</li>
	</ul>
</div>

<h2>V3 Updates</h2>
<div class="well">
	<ul>
		<li>Fire Shield is now an NPC/chest item (replaced a 20 rupee chest)</li>
		<li>Mirror Shield and Red Mail are restricted to the DW</li>
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
<div class="well">
	<ul>
		<li>Bug fixes (seed creation error)</li>
		<li>Logic improvements (accounting for access to lower DW with Hookshot)</li>
	</ul>
</div>

<h2>V1 Updates</h2>
<div class="well">
	<ul>
		<li>All unique chests and NPC rewards are randomized; NPCs always give unique items</li>
		<li>Swamp Palace water levels reset upon leaving the overworld screen</li>
		<li>Can no longer enter the fake DW after dying in a DW dungeon before killing Agahnim</li>
		<li>Agahnim 1 and 2 will no longer attack with blue balls</li>
		<li>Can no longer downgrade Titan’s Mitts to Power Gloves</li>
	</ul>
</div>
@overwrite

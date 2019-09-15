<?php
return [
    'header' => 'Randomizer Options',
    'subheader' => 'There are many ways to play ALttP:Randomizer!',
    'cards' => [
        'glitches_required' => [
            'header' => __('randomizer.glitches_required.title'),
            'sections' => [
                [
                    'header' => __('randomizer.glitches_required.options.none'),
                    'content' => [
                        'This setting requires no knowledge of any glitches.',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.overworld_glitches'),
                    'content' => [
                        'This setting requires knowledge of certain major glitches (on the overworld) as well as knowledge of most minor glitches. Specifically:',
                        '<ul>'
                            . '<li>Overworld boots clipping</li>'
                            . '<li>Overworld mirror clips</li>'
                            . '<li>Dungeon bunny revival</li>'
                            . '<li>Super Bunny</li>'
                            . '<li>Surfing Bunny</li>'
                            . '<li>Water Walk</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.major_glitches'),
                    'content' => [
                        'This setting requires knowledge of more advanced major glitches. Specifically:',
                        '<ul>'
                            . '<li>Overworld fake flutes</li>'
                            . '<li>Overworld screenwraps</li>'
                            . '<li>Overworld and Underworld bootless clips (including 1-frame clips requiring buffering)</li>'
                            . '</ul>',
                        'Some additional changes have also been made:',
                        '<ul>'
                            . '<li>Fake worlds exist as per the original game (e.g. dying in a Dark World dungeon without defeating Agahnim will put you in the fake Dark World)</li>'
                            . '<li>Crystals always drop regardless of pendant conflicts (QoL fix from the original)</li>'
                            . '<li>Swamp Palace water levels do not drain when you exit the overworld screen (except for the first room)</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.no_logic'),
                    'content' => [
                        'No logic is applied whatsoever. Items can be anywhere. It may be impossible to get items, although due to the strength of glitches, it is extremely rare for games to be unbeatable. This setting will generally require extensive use of glitches which are excluded from other logics (which include EG, Door Glitches and Overworld Bunny Revival).',
                    ],
                ],
            ],
        ],
        'item_placement' => [
            'header' => __('randomizer.item_placement.title'),
            'sections' => [
                [
                    'header' => __('randomizer.item_placement.options.basic'),
                    'content' => [
                        'This setting is aimed at new players or people looking for a more casual experience. Logical restrictions are in place to prevent items being placed in obscure locations which require niche knowledge to access (e.g. accessing Bumper Cave ledge without the Hookshot). Other logical restrictions also ensure excessively difficult execution is not required in order to progress. For example if you need to beat a late-game Dark World dungeon you will always have access to some sword and defense upgrades somewhere in the world.',
                    ],
                ],
                [
                    'header' => __('randomizer.item_placement.options.advanced'),
                    'content' => [
                        'This setting is aimed at regular players and racers. The intention of this setting is to maximize glitchless item placement reach. However one exception is made to prevent navigation through dark rooms. No other consideration is given to the obscurity of item placements or the level of execution required to access locations. The expectation is a player choosing this setting is decently familiar and practiced with the original game.',
                    ],
                ],
            ],
        ],
        'dungeon_items' => [
            'header' => __('randomizer.dungeon_items.title'),
            'sections' => [
                [
                    'header' => '',
                    'content' => [
                        'When maps are shuffled outside dungeons the Overworld map will not display dungeon prizes without dungeon maps. However, maps are always logically required for dungeon completion in both Basic and Advanced item placements. Note that a dungeon’s boss can contain that dungeon’s map.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.standard'),
                    'content' => [
                        'All dungeons items are locked to their respective dungeons but are randomized within each dungeon.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mc'),
                    'content' => [
                        'Maps and compasses are no longer locked to their respective dungeons (although may still end up there). All keys remain locked to their respective dungeons.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mcs'),
                    'content' => [
                        'Maps, compasses and small keys are no longer locked to their respective dungeons (although may still end up there). All big keys remain locked to their respective dungeons.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.full'),
                    'content' => [
                        'Maps, compasses, small keys and big keys are no longer locked to their respective dungeons (although may still end up there).',
                    ],
                ],
            ],
        ],
        'accessibility' => [
            'header' => __('randomizer.accessibility.title'),
            'sections' => [
                [
                    'header' => __('randomizer.accessibility.options.items'),
                    'content' => [
                        'This setting ensures all inventory items can be obtained but retains the possibility for certain keys to be unobtainable. For example non-required big keys may be in big chests and certain small keys may be locked behind key doors (which you could lock yourself out of depending on how you use small keys). In practice you will be able to reach almost every location with this setting.',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.locations'),
                    'content' => [
                        'This setting ensures all 216 locations can always be reached regardless of how inefficiently keys are used within dungeons. Specifically, big keys cannot be in big chests and certain chests behind key doors cannot contain small keys.',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.none'),
                    'content' => [
                        'This setting only ensures the game can be beaten. You may be locked out of non-required items (e.g. Fire Rod if it is not needed to complete the goal) and even non-required dungeons.',
                    ],
                ],
            ],
        ],
        'goal' => [
            'header' => __('randomizer.goal.title'),
            'sections' => [
                [
                    'header' => __('randomizer.goal.options.ganon'),
                    'content' => [
                        'This setting requires full completion of Ganon’s Tower in addition to defeating Ganon. The number of required crystals for each depends on the requirements chosen.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.fast_ganon'),
                    'content' => [
                        'This setting only requires defeating Ganon and does not require completion of Ganon’s Tower. For this to work the hole leading to Ganon has been made permanently accessible (except if entrances are randomized). The number of required crystal depends on the requirements chosen.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.dungeons'),
                    'content' => [
                        'This setting requires full completion of all dungeons. This includes the 3 Light World pendant dungeons, the 7 Dark World crystal dungeons, Agahnim’s Tower and Ganon’s Tower.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.pedestal'),
                    'content' => [
                        'This setting requires collection of the 3 pendants in order to pull the Triforce from the pedestal in the Lost Woods. ',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.triforce-hunt'),
                    'content' => [
                        'The Triforce has been shattered into 30 pieces and scattered throughout Hyrule! You must collect 20 of the 30 pieces and take them to Murahdahla to receive the Triforce. Who is Murahdahla I hear you ask? Why, he is obviously the younger brother of Sahasrahla and Aginah! Back from his vacation in Lorule you can find him hanging out around Hyrule Castle courtyard.',
                    ],
                ],
            ],
        ],
        'tower_open' => [
            'header' => __('randomizer.tower_open.title'),
            'content' => [
                'This settings lets you choose the number of crystals required to open Ganon’s Tower. If 0 is chosen then the dungeon is freely accessible. If Random is chosen there will be a sign outside Ganon’s Tower informing you of how many crystals are required. In Inverted this sign will be outside Hyrule Castle accordingly.',
            ],
        ],
        'ganon_open' => [
            'header' => __('randomizer.ganon_open.title'),
            'content' => [
                'This settings lets you choose the number of crystals required to make Ganon vulnerable to your attacks. If 0 is chosen then he can be beaten as soon as you can reach him! If Random is chosen then there will be a sign on the Pyramid informing you of how many crystals are required. In Inverted this sign will be outside Hyrule Castle accordingly.',
            ],
        ],
        'world_state' => [
            'header' => __('randomizer.world_state.title'),
            'sections' => [
                [
                    'header' => __('randomizer.world_state.options.standard'),
                    'content' => [
                        'This setting is the closest to the original game. It retains the initial prologue of rescuing Zelda in Hyrule Castle and delivering her to the Sanctuary. This must be completed before you are free to explore Hyrule. Your uncle is guaranteed to give you an item which lets you clear the prologue (although not necessarily a sword). You are given a light cone for navigating the dark rooms of the Sewers even without the Lamp (although any future visits to dark rooms, including the Sewers, will be in total darkness until you find the Lamp).',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.open'),
                    'content' => [
                        'This setting starts as if the initial prologue has already been beaten. Zelda has already been rescued and you are free to start in either Link’s House or at the Sanctuary. All the chests in Hyrule Castle have not been opened so you must decide when and whether to visit.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.inverted'),
                    'content' => [
                        'In this setting Link starts in the Dark World and must navigate his way to the Light World in order to defeat Ganon! There are several major changes for this to work:',
                        '<ul>'
                            . '<li>Ganon’s Tower and Agahnim’s Tower have traded places.</li>'
                            . '<li>Ganon has abandoned the Pyramid and is hiding underneath Hyrule Castle.</li>'
                            . '<li>All portals now take you from the Dark World to the Light World.</li>'
                            . '<li>Link will be a bunny in the Light World without the Moon Pearl.</li>'
                            . '<li>The Magic Mirror now transports you from the Light World to the Dark World.</li>'
                            . '<li>The crystals now unlock the door to Hyrule Castle Tower (not Ganon’s Tower).</li>'
                            . '</ul>',
                        'However there are other modifications to the game world which were required in order to ensure this concept worked properly:',
                        '<ul>'
                            . '<li>Link’s House and the Bomb Shop have traded places.</li>'
                            . '<li>The flute only works in the Dark World and must still be activated in Kakariko.</li>'
                            . '<li>Lots of terrain in the Light World has been modified in order to retain accessibility without being able to mirror from the Dark World.</li>'
                            . '<li>The Death Mountain cave system has changed considerably. It is now possible to access Dark World Death Mountain from the Dark World mainland. </li>'
                            . '<li>The Old Man on Death Mountain is now lost wandering in the Dark World and you will have to return him to his home in the Light World.</li>'
                            . '<li>Dark World Death Mountain now has some stairs allowing access to Ganon’s Tower and East Dark World Death Mountain.</li>'
                            . '<li>Ice Palace is now accessible directly from the Dark World.</li>'
                            . '<li>Turtle Rock is now accessible by jumping from its tail!</li>'
                            . '</ul>',
                        'Remember that bunny Link can use the Book of Mudora, as well as talk to NPC’s and collection freestanding items. Inverted games can be <strong>really difficult</strong> so we recommend starting with some of the other world states.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.retro'),
                    'content' => [
                        'This setting is a throwback to the original The Legend of Zelda. The main concept includes:',
                        [
                            'header' => 'Rupee Bow',
                            'content' => [
                                '<ul>'
                                    . '<li>They no longer use arrows for ammo and instead uses rupees!</li>'
                                    . '<li>The first Progressive Bow only shoots Wooden Arrows.</li>'
                                    . '<li>The second Progressive Bow can shoot Wooden Arrows and Silver Arrows.</li>'
                                    . '<li>However neither Bow can be used until a Rupee Quiver has been purchased.</li>'
                                    . '<li>The Rupee Quiver costs 80 rupees and only appears in one randomly chosen shop!</li>'
                                    . '<li>Each Wooden Arrow costs 10 rupee sand each Silver Arrow costs 50 rupees.</li>'
                                    . '</ul>',
                            ],
                        ],
                        [
                            'header' => 'Shops',
                            'content' => [
                                'Five shops out of a possible nine will be randomly chosen to contain new stock. This does not include the Bomb Shop or the Potion Shop. One of these shops will contain the Rupee Quiver at a price of 80 rupees. Additionally, small keys will be available in multiple shops for a price of 100 rupees and there is no limit on how many may be purchased.',
                            ],
                        ],
                        [
                            'header' => 'Small Keys',
                            'content' => [
                                'Small keys are no longer dungeon-specific and can be used to open key doors in any dungeon. They are no longer locked to their respective dungeons and may be found anywhere (e.g. in the overworld). Keys under pots and keys dropped by enemies remain unchanged. Ten keys have been removed from the item pool (fifteen on harder difficulties). Big keys, maps and compasses remain dungeon-specific and have not been randomized outside of their respective dungeons.',
                            ],
                        ],
                        [
                            'header' => 'Take-Any Caves',
                            'content' => [
                                'Five randomly chosen single-entrance caves/houses (which do not ordinarily lead to an item location) now lead to take-any caves. Four of these caves offer players the choice between a Heart Container and a Blue Potion refill, and the fifth leads to a sword upgrade (which has been taken from the item pool). This means there are only 3 swords to be found in the regular item pool. The Heart Containers are bonus ones in addition to the ones existing in the item pool. However it is not possible to have more than a total of 20 hearts. The Blue Potion refills require you to already have an empty bottle.',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'entrance_shuffle' => [
            'header' => __('randomizer.entrance_shuffle.title'),
            'subheader' => [
                'This setting randomizes where entrances lead. For example walking into Kakariko shop might take you to a fairy fountain, and so on. Different entrance types are grouped together and then each group is randomized. How entrances are grouped depends on which shuffle you choose. Overworld transitions are never randomized.',
                'Multi-entrance caves/dungeons exhibit some specific behaviours, unless noted otherwise:',
                '<ul>'
                    . '<li>All entrances remain coupled. This means exiting one of these caves/dungeons will take you back to the entrance from which it was entered.</li>'
                    . '<li>All entrances for a given multi-entrance cave/dungeon are confined to appear within the same world (i.e. they do not connect the Light World and the Dark World).</li>'
                    . '</ul>',
                'Link’s House and the south-facing entrance leading to the back of Kakariko bar are not randomized. However on ' . __('randomizer.world_state.options.inverted') . ' ' . __('randomizer.world_state.title') . ' note that Link’s House (in the Dark World) and the Bomb Shop (in the Light World) are both randomized.',
            ],
            'sections' => [
                'none' => [
                    'header' => __('randomizer.entrance_shuffle.options.none'),
                    'content' => [
                        'No entrances are randomized. All entrances lead to their original locations.',
                    ],
                ],
                'simple' => [
                    'header' => __('randomizer.entrance_shuffle.options.simple'),
                    'content' => [
                        'This setting uses the highest number of entrance type groupings. This restricts how thoroughly different entrances are randomized with the intention of keeping things simple.',
                        [
                            'header' => 'Single-Entrance Dungeons',
                            'content' => [
                                'All entrances are grouped and randomized with each other. This includes the final section of Skull Woods (leading to the boss) but does not include any other Skull Woods entrances.',
                            ],
                        ],
                        [
                            'header' => 'Multi-Entrance Dungeons (excluding Skull Woods)',
                            'content' => [
                                'Each of the 4 entrances of Hyrule Castle, Desert Palace and Turtle Rock remain grouped together. Each group of 4 are randomized with each other using a static mapping. For example if Hyrule Castle and Desert Palace are randomized with each other, the main entrance of Desert Palace will lead to the main entrance of Hyrule Castle, the left entrance of Desert Palace will lead to the left entrance of Hyrule Castle, and so on. However Hyrule Castle is not randomized on ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . '.',
                            ],
                        ],
                        [
                            'header' => 'Skull Woods (excluding final dungeon entrance)',
                            'content' => [
                                'All entrances (including all of the holes) remain confined to the Skull Woods overworld region and are randomized with each other. Skull-entrances are randomized with skull-entrances; and holes are randomized with holes.',
                            ],
                        ],
                        [
                            'header' => 'Single-Entrance Caves',
                            'content' => [
                                'All entrances are grouped and randomized with each other. This does not include any of Light World Death Mountain. Example: houses.',
                            ],
                        ],
                        [
                            'header' => 'Multi-Entrance Caves',
                            'content' => [
                                'All entrances are grouped and randomized with each other. Locations that are originally spanned by two-entrance caves (e.g. Kakariko Elder’s House) will remain connected to each other via a two-entrance cave. This does not include any of Light World Death Mountain.',
                            ],
                        ],
                        [
                            'header' => 'Light World Death Mountain',
                            'content' => [
                                'All entrances remain confined to the Light World Death Mountain overworld region and are randomized with each other. Note that the entrance to Death Mountain (via the cave where the Old Man is lost) is also not randomized.',
                            ],
                        ],
                        [
                            'header' => 'Overworld Holes (excluding those in Skull Woods)',
                            'content' => [
                                'All holes are grouped and randomized with each other. Holes and their associated cave entrance remain paired together. For example falling in a hole and exiting will take you to the overworld cave associated with that hole, regardless of which interior rooms the hole led to. ',
                            ],
                        ],
                    ],
                ],
                'restricted' => [
                    'header' => __('randomizer.entrance_shuffle.options.restricted'),
                    'content' => [
                        'As in ' . __('randomizer.entrance_shuffle.options.simple') . ' except all non-dungeon entrances (including all single-entrance caves, all multi-entrance caves, and all of Light World Death Mountain) are grouped together and randomized with each other. This includes the entrance to Death Mountain.',
                    ],
                ],
                'full' => [
                    'header' => __('randomizer.entrance_shuffle.options.full'),
                    'content' => [
                        'As in ' . __('randomizer.entrance_shuffle.options.restricted') . ' except all dungeons (including single-entrance and multi-entrance) are also grouped together with all non-dungeon entrances and randomized with each other.',
                    ],
                ],
                'crossed' => [
                    'header' => __('randomizer.entrance_shuffle.options.crossed'),
                    'content' => [
                        'As in ' . __('randomizer.entrance_shuffle.options.full') . ' except caves and dungeons with multiple entrances are no longer confined to all appear within the same world. This means they can link the Light World to the Dark World.',
                    ],
                ],
                'insanity' => [
                    'header' => __('randomizer.entrance_shuffle.options.insanity'),
                    'content' => [
                        'As in ' . __('randomizer.entrance_shuffle.options.crossed') . ' except all entrances and holes are decoupled from each other (excluding single-entrance caves and the Skull Woods overworld region). This means exiting the way you entered will take you somewhere entirely different. However all single-entrance caves can still only exit to the same location from which they were entered. All overworld holes are no longer paired. All Skull Woods entrances remain confined to the Skull Woods overworld region (excluding the final dungeon entrance).',
                    ],
                ],
            ],
        ],
        'bosses' => [
            'header' => __('randomizer.boss_shuffle.title'),
            'sections' => [
                [
                    'header' => __('randomizer.boss_shuffle.options.none'),
                    'content' => [
                        'Bosses are not randomized. All bosses remain in their original dungeons.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.simple'),
                    'content' => [
                        'All original bosses (except both Agahnim’s and Ganon) are randomized including the 3 Ganon’s Tower refights. Therefore the shuffle includes two sets of Armos Knights, Lanmolas’ and Moldorm. This means Ganon’s Tower can contain 3 random bosses!',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.full'),
                    'content' => [
                        'Same as ' . __('randomizer.boss_shuffle.options.simple') . ' except the 3 bosses which appear twice are chosen randomly.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.random'),
                    'content' => [
                        'All bosses are chosen entirely at random. You may see one boss multiple times and some bosses may not feature at all.',
                    ],
                ],
            ],
        ],
        'enemy_shuffle' => [
            'header' => __('randomizer.enemy_shuffle.title'),
            'sections' => [
                [
                    'header' => __('randomizer.enemy_shuffle.options.none'),
                    'content' => [
                        'Enemies are not randomized. All enemies remain in their original locations.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.shuffled'),
                    'content' => [
                        'All enemies are randomized but there are some caveats to note:',
                        '<ul>'
                            . '<li>Not all enemies can appear everywhere due to game limitations.</li>'
                            . '<li>Rooms where killing all enemies is required will never include enemies which need specific weapons to kill (e.g. Mimics requiring Bow, etc)</li>'
                            . '<li>Thieves’ can now be killed.</li>'
                            . '<li>Tile rooms are not randomized.</li>'
                            . '<li>Enemies under bushes are not randomized.</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.random'),
                    'content' => [
                        'Same as ' . __('randomizer.enemy_shuffle.options.shuffled') . '  except enemies under bushes, as well as the percentage chance that they spawn an enemy, are also randomized. This may not seem like much of a difference but in practice it affects playability drastically. In addition tile rooms spawn tiles in random patterns and Thieves’ have a 50% chance for being killable or invincible.',
                    ],
                ],
            ],
        ],
        'hints' => [
            'header' => __('randomizer.hints.title'),
            'content' => [
                'Enable or disable hints which can be found on the telepathic throughout the world.',
            ],
        ],
        'difficulty' => [
            'header' => __('randomizer.difficulty.title'),
            'item_pool' => __('randomizer.item_pool.title'),
            'item_functionality' => __('randomizer.item_functionality.title'),
            'comparison' => [
                'header' => 'Difficulty Comparison',
                'maximum_health' => 'Maximum Health',
                'heart_containers' => 'Heart Containers',
                'heart_pieces' => 'Heart Pieces',
                'maximum_mail' => 'Maximum Mail',
                'number_in_pool' => '# in Pool',
                'maximum_sword' => 'Maximum Sword',
                'maximum_shield' => 'Maximum Shield',
                'shields_store' => 'Shields Purchasable',
                'maximum_magic' => 'Maximum Magic Capacity',
                'number_silvers' => 'Maximum Bow',
                'number_silvers_swordless' => 'Maximum Bow (Swordless)',
                'number_bottles' => '# of Bottles',
                'number_lamps' => '# of Lamps',
                'potion_magic' => 'Potion Magic Refill',
                'potion_health' => 'Potion Hearts Refill',
                'bug_net_fairy' => 'Bug Net Catches Faeries',
                'powder_bubble' => 'Magic Powder on Bubbles',
                'cape_consumption' => 'Cape Magic Consumption Rate',
                'byrna_invincible' => 'Byrna Grants Invincibility',
                'stun_boomerang' => 'Boomerangs Stun Enemies',
                'stun_hookshot' => 'Hookshot Stuns Enemies',
                'capacity_upgrade' => 'Arrow / Bomb Capacity Upgrades',
                'drop_rates' => 'Enemy Drop Rates',
                'quarter' => 'Quarter',
                'half' => 'Half',
                'normal' => 'Normal',
                'silver' => 'Silver',
                'shield_3' => 'Mirror',
                'shield_2' => 'Fire',
                'shield_1' => 'Fighter’s',
                'none' => 'None',
                'sword_4' => 'Gold',
                'sword_3' => 'Tempered',
                'sword_2' => 'Master',
                'mail_3' => 'Red',
                'mail_2' => 'Blue',
                'mail_1' => 'Green',
                'fairy' => 'Faerie',
                'heart' => 'Heart',
                'bee' => 'Bees',
                'yes' => 'Yes',
                'no' => 'No',
                'tooltip' => [
                    'silvers' => 'Swordless retains Silver Arrows but they only function in Ganon’s room.',
                    'bottles' => 'Once 4 Bottles have been collected, the remaining Bottles will revert to rupees.',
                    'potion_magic' => 'Potions will fill 100% magic in Spike Cave.',
                    'potion_health' => 'Potions will fill 20 hearts in Spike Cave.',
                ],
            ],
        ],
        'weapons' => [
            'header' => __('randomizer.weapons.title'),
            'sections' => [
                [
                    'header' => __('randomizer.weapons.options.randomized'),
                    'content' => [
                        'All four Progressive Swords are randomly shuffled into the game. If this setting is combined with ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . ' then your Uncle will always have one of the following:',
                        '<ul>'
                            . '<li>Sword</li>'
                            . '<li>Hammer</li>'
                            . '<li>Bow + Full Arrow Refill</li>'
                            . '<li>10 Bombs</li>'
                            . '<li>Fire Rod + Full Magic Refill</li>'
                            . '<li>Cane of Somaria + Full Magic Refill</li>'
                            . '<li>Cane of Byrna + Full Magic Refill</li>'
                            . '</ul>',
                        'If you run out of ammo or magic then a save and quit will partially refill you so that you may progress.',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.assured'),
                    'content' => [
                        'Link starts with a sword already equipped! Perhaps he hid it under his pillow?',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.vanilla'),
                    'content' => [
                        'All four swords are in their original game locations. These are:',
                        '<ul>'
                            . '<li>Link’s Uncle</li>'
                            . '<li>Master Sword Pedestal</li>'
                            . '<li>Rescuing Blacksmith</li>'
                            . '<li>Pyramid Faerie</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.swordless'),
                    'content' => [
                        'All swords are removed from the game and replaced with 20 rupees. Multiple changes have been made for this to work:',
                        '<ul>'
                            . '<li>Ganon can be damaged with the Hammer.</li>'
                            . '<li>Both Progressive Bows are always in the item pool.</li>'
                            . '<li>The bat barrier outside Aghanim’s Tower can now be broken with the Hammer.</li>'
                            . '<li>The curtains/vines inside Skull Woods and Agahnim’s Tower are already open.</li>'
                            . '<li>Ether and Bombos tablets require the Hammer and the Book of Mudora.</li>'
                            . '<li>Medallions can only be used to open Misery Mire and Turtle Rock, or to progress through Ice Palace. They only work where their emblems indicate.</li>'
                            . '<li>Swords have been replaced with copies of 20 rupees</li>'
                            . '</ul>',
                    ],
                ],
            ],
        ],
        'enemy_health' => [
            'header' => __('randomizer.enemy_health.title'),
            'sections' => [
                [
                    'header' => __('randomizer.enemy_health.options.default'),
                    'content' => [
                        'The health of enemies are not randomized.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.easy'),
                    'content' => [
                        'All enemy health will be in the 1hp-4hp range (1-2 Fighter’s Sword slashes).',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.hard'),
                    'content' => [
                        'All enemy health will be in the 2hp-15hp range (1-8 Fighter’s Sword slashes). Note that on average enemies will have more health than in the original.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.expert'),
                    'content' => [
                        'All enemy health will be in the 2hp-30hp range (1-15 Fighter’s Sword slashes). Almost all enemies will have considerably more health than in the original.',
                    ],
                ],
            ],
        ],
        'enemy_damage' => [
            'header' => __('randomizer.enemy_damage.title'),
            'sections' => [
                [
                    'header' => __('randomizer.enemy_damage.options.default'),
                    'content' => [
                        'The damage dealt by enemies are not randomized.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.shuffled'),
                    'content' => [
                        'The damage dealt by enemies are randomized between enemy types. For example the damage dealt by Octoroks and Ganon might be shuffled, meaning all Octoroks deal 8 hearts and Ganon only deals just 1 heart! Mail Upgrades still work as expected to reduce damage.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.random'),
                    'content' => [
                        'The damage dealt by enemies are entirely random. A value is chosen for each Mail Upgrade so they therefore do not work to reduce damage. No mapping exists between different enemy types. All enemies could deal massive damage.',
                    ],
                ],
            ],
        ],
        'post_generation' => [
            'header' => 'Cosmetic Settings (post generation)',
            'cards' => [
                'heart_speed' => [
                    'header' => __('rom.settings.heart_speed'),
                    'content' => [
                        'Change the speed of the beep when Link is low on health.',
                    ],
                ],
                'play_as' => [
                    'header' => __('rom.settings.play_as'),
                    'content' => [
                        'Change the sprite you play as (e.g. play as a tea cup instead of Link).',
                    ],
                ],
                'menu_speed' => [
                    'header' => __('rom.settings.menu_speed'),
                    'content' => [
                        'Change the speed of opening and closing the item menu. This is not available for race ROMS.',
                    ],
                ],
                'heart_color' => [
                    'header' => __('rom.settings.heart_color'),
                    'content' => [
                        'Change the color of your hearts. Choices are restricted due to game limitations.',
                    ],
                ],
                'music' => [
                    'header' => __('rom.settings.music'),
                    'content' => [
                        'Enable or disable the original background music. You do not have to disable this if you wish to use MSU-1 packs. If left enabled and using an MSU-1 pack then the original music will act as an SPC fallback and will only play should an MSU-1 track fail (i.e. instead of silence).',
                    ],
                ],
                'quickswap' => [
                    'header' => __('rom.settings.quickswap'),
                    'content' => [
                        'Allow items to be changed with the L and R buttons without opening the menu. This is not available for race ROMS (except when entrances are randomized).',
                    ],
                ],
                'palette_shuffle' => [
                    'header' => __('rom.settings.palette_shuffle'),
                    'content' => [
                        'Randomizes the colour palettes within the game. This means everything can look extremely bizarre. Enable with caution!',
                    ],
                ],
            ],
        ],
        'item_pool' => 'Item Pool',
    ],
];

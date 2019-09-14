<?php
return [
    'header' => 'Optionen',
    'subheader' => 'Es gibt viele Wege um ALttP:Randomizer zu spielen!',
    'cards' => [
        'glitches_required' => [
            'header' => __('randomizer.glitches_required.title'),
            'sections' => [
                [
                    'header' => __('randomizer.glitches_required.options.none'),
                    'content' => [
                        'Dieser Modus setzt kein fortschrittliches Wissen über das Spiel vorraus. Es wurde so entworfen als würdest du das Spiel zum ersten Mal spielen.',
                        'In diesem Modus wurde vorgebeugt das du nirgends feststecken kannst, egal wie du deine kleine Schlüsseln in Dungeons verwendest.',
                        'Es könnte sein das vorrausgesetzt wird, das du in bestimmten Situation "Save and Quit" benutzt, um zum Beispiel wieder zurück in die Lichtwelt zu kommen wenn du in der Schattenwelt bist ohne magischen Spiegel.',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.overworld_glitches'),
                    'content' => [
                        'Dieser Modus <span class="running-now">verlangt</span> einige der einfachen Overworld Glitches. Es ist schwieriger als nur die Fake Flippers zum Hobo! Nur diese zwei Arten von Major Glitches werden vorausgesetzt:',
                        '<ul>'
                            . '<li>Overworld boots clipping</li>'
                            . '<li>Mirror clipping (DMD, TR Middle Clip, und Fluteless Mire)</li>'
                        . '</ul>',
                        'Die meisten Minor Glitches werden berücksichtigt für:',
                        '<ul>'
                            . '<li>Fake Flippers (erlaubt Zugang zum Eispalast, König Zora, Herzteil vom Hylia-See, und Hobo ohne Schwimmflossen)</li>'
                            . '<li>Dungeon Bunny Revival (erlaubt Zugang zum Eispalast ohne die Mondperle)</li>'
                            . '<li>Overworld Bunny Revival (erlaubt Zugang zum Wüstenseepalast und dem Schuppe außerhalb des Wüstenseepalast ohne die Mondperle und ohne DMD machen zu müssen)</li>'
                            . '<li>Super Bunny (erlaubt Zugang zu zwei Kisten auf dem Todesberg in der Schattenwelt ohne die Mondperle)</li>'
                            . '<li>Surfing Bunny (erlaubt Zugang zum Herzteil vom Hylia-See ohne die Mondperle)</li>'
                            . '<li>Walk on Water (erlaubt Zugang zum Vorsprung im Reich der Zoras ohne die Schwimmflossen)</li>'
                        . '</ul>',
                        'Die folgenden werden NICHT berücksichtigt in der Logik, du wirst also nie gezwungen sein sie zu machen:',
                        '<ul>'
                            . '<li>Bootless Clips</li>'
                            . '<li>Overworld YBAs</li>'
                            . '<li>Underworld Clips</li>'
                            . '<li>Dark Room Navigation</li>'
                            . '<li>Hovering</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.major_glitches'),
                    'content' => [
                        'Dieser Modus verlangt alles bis auf EG und semi-EG. Dieser Modus ist extrem schwert und setzt sehr gute Kenntnisse über Glitches vorraus, einschließlich:',
                        '<ul>'
                            . '<li>Overworld YBA</li>'
                            . '<li>Clipping out of bounds</li>'
                            . '<li>Screenwraps</li>'
                        . '</ul>',
                        'Einige zusätzliche Veränderungen wurden unternommen damit das Spiel korrekt funktioniert mit dieser Logik:',
                        '<ul>'
                            . '<li>Die falsche Schattenwelt ist nicht mehr rausgepatcht. Kristalle werden immer fallen, unabhänging von Konflikten mit Amuletten.</li>'
                            . '<li>Der Wasserpegel im Sumpfpalast wird nicht sinken wenn du das Gebiet auf der Oberwelt verlässt, ausgenommen ist der erste Raum.</li>'
                            . '<li>Wenn du speicherst und beendest in der Schattenwelt, wirst du immer auf der Pyramide landen wenn du Agahnim besiegt hast.</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.logic.options.None'),
                    'content' => [
                        'Es gibt überhaupt keine Überprüfung wo ein Gegenstand landen wird, so viel Glück wenn du diese Option versuchst.',
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
                        'This is mostly aimed at newer players.',
                    ],
                ],
                [
                    'header' => __('randomizer.item_placement.options.advanced'),
                    'content' => [
                        'The intention of this setting is to maximise glitchless item placement reach. An exception is made to prevent navigation through dark rooms. No other consideration is given to the difficulty of execution or obscurity of item placements. The expectation is a player choosing this setting is decently familiar and practiced with the original game and/or No Major Glitches speedrun.',
                    ],
                ],
            ],
        ],
        'dungeon_items' => [
            'header' => __('randomizer.dungeon_items.title'),
            'sections' => [
                [
                    'header' => __('randomizer.dungeon_items.options.standard'),
                    'content' => [
                        'All dungeons items are locked to their respective dungeons.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mc'),
                    'content' => [
                        'Maps and compasses are randomized freely into the world.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mcs'),
                    'content' => [
                        'Maps, compasses and small keys are randomized freely into the world.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.full'),
                    'content' => [
                        'Maps, compasses, small keys and big keys are randomized freely in to the world.',
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
                        '<ul>'
                            . '<li>It is <strong>not</strong> guaranteed that you can reach every item location</li>'
                            . '<li>It is guaranteed that you can obtain every unique inventory item</li>'
                            . '<li>It is <strong>not</strong> guaranteed that you can obtain all small/big keys</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.locations'),
                    'content' => [
                        '<ul>'
                            . '<li>It is guaranteed that you can reach every item location</li>'
                            . '<li>It is guaranteed that you can obtain every unique inventory item</li>'
                            . '<li>It is guaranteed that you can obtain all small/big keys</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.none'),
                    'content' => [
                        '<ul>'
                            . '<li>It is <strong>not</strong> guaranteed that you can reach every item location</li>'
                            . '<li>It is <strong>not</strong> guaranteed that you can obtain every unique inventory item</li>'
                            . '<li>It is <strong>not</strong> guaranteed that you can obtain all small/big keys</li>'
                            . '</ul>',
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
                        'Wie im Original, ist dein Ziel alle sieben Kristalle zu sammeln, dich durch Ganons Turm durchzuschlagen, um dann Ganon zu besiegen.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.fast_ganon'),
                    'content' => [
                        'Similar to ' . __('randomizer.goal.options.ganon') . ', your goal will be to collect all required crystals and defeat Ganon, however defeating Agahnihm at the top of Ganon’s Tower is not necessarily required. Thus, if entrance shuffle is not enabled, the entrance to Ganon will already be open.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.dungeons'),
                    'content' => [
                        'Du musst alle Bosse in Hyrule besiegen, einschließlich beide Verkörperungen von Agahnim. Nur wenn alle besiegt sind, kannst du Ganon besiegen.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.pedestal'),
                    'content' => [
                        'Sammle das Amulett des Mutes, der Weisheit, der Stärke und ziehe dann das Triforce aus dem Sockel! Aber Vorsicht, du wirst villeicht über ganz Hyrule reisen müssen, einschließlich Ganon’s Turm, um dein Abenteuer abschließen zu können.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.triforce-hunt'),
                    'content' => [
                        'The Triforce has been shattered and scattered into 30 pieces throughout Hyrule! Collect 20 pieces and take them to <del>Sahasrahla</del> to win!',
                        'Wait? Who do we take these silly pieces to? Well Murahdahla of course!',
                        'Who’s Murahdahla? I hear you ask. Murahdahla is the younger brother of Sahasrahla and Aginah. Back from vacation in Lorule. He has some mystic powers so be sure to have a chat with him in the Castle Courtyard.',
                    ],
                ],
            ],
        ],
        'tower_open' => [
            'header' => __('randomizer.tower_open.title'),
            'sections' => [
                [
                    'header' => '0 - 7',
                    'content' => [
                        'Pick the number of Crystals required to open the way to Ganon’s Tower.',
                    ],
                ],
                [
                    'header' => __('randomizer.tower_open.options.random'),
                    'content' => [
                        'This will pick a random value from above for entry into Ganon’s Tower.',
                    ],
                ],
            ],
        ],
        'ganon_open' => [
            'header' => __('randomizer.ganon_open.title'),
            'sections' => [
                [
                    'header' => '0 - 7',
                    'content' => [
                        'Pick the number of Crystals required to defeat to Ganon.',
                    ],
                ],
                [
                    'header' => __('randomizer.ganon_open.options.random'),
                    'content' => [
                        'This will pick a random value from above to defeat Ganon.',
                    ],
                ],
            ],
        ],
        'world_state' => [
            'header' => __('randomizer.world_state.title'),
            'sections' => [
                [
                    'header' => __('randomizer.world_state.options.standard'),
                    'content' => [
                        'Dieser Modus hält sich am meisten an das Original. Du startes in Link´s Bett, kriegst eine Waffe von deinem Onkel (hängt zusammen mit den Schwert Optionen, siehe unten), und rettest Zelda bevor du mit dem Rest des Spiels fortschreiten kannst.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.open'),
                    'content' => [
                        'Dieser Modus startet mit der Option ob du in deinem Haus oder in der Kathedrale startest und du kannst sofort die Welt erkunden. Es gibt einige Punkte zu erwähnen in diesem Modus:',
                        '<ul>'
                            . '<li>Der Onkel ist schon in der Kanalisation und hat einen Gegenstand.</li>'
                            . '<li>Dunkle Räume bekommen keinen freien Lichtpegel, nichtmal in der Kanalisation.</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.inverted'),
                    'content' => [
                        'Tired of starting in the Light World and working your way to Ganon on top of Death Mountain? Well have we got the mode for you!',
                        'Introducing inverted, the game state where we flip the game on its head just to really mess with things.',
                        'This mode is really hard in the beginning so we really don’t suggest it for your first playthrough. Enemies in the Dark World hit like a truck, well a bunch of trucks really, and starting with 3 hearts is enough to get gone in a single hit or two',
                        'But what does this all mean? Well we had to make some serious modifications to the game to have Link start in the Dark World and get to the light world to complete the game:',
                        '<ul>'
                            . '<li>Link’s house is now located in the place that the Bomb shop used to reside</li>'
                            . '<li>The Bomb shop has been transported to the light world where Link’s house used to be</li>'
                            . '<li>The ' . __('item.MagicMirror') . ' works in the Light World to take you back to the Dark World</li>'
                            . '<li>The ' . __('item.OcarinaInactive') . ' only works in the Dark World, but you still have to find a way to activate it in the Light world</li>'
                            . '<li>Lots of terrain in the Light World has been modified to allow you to get to those pesky ' . __('item.MagicMirror') . ' locations</li>'
                            . '<li>The old man has decided to “get lost” in the Dark World. You’ll still have to return him to his cave in the Light World</li>'
                            . '<li>Portals? All the ones you used to see in the Light World will be in the Dark World with the same requirements to use them</li>'
                            . '<li>Agahnim has really gotten tired of his place in Hyrule Castle and decided to move on up to the Tower formally known as Ganon’s on Dark Death Mountain. No silly bat barrier to get in, oh and he added some stairs so you can get to East Dark Death Mountain or his place pretty quickly</li>'
                            . '<li>Since Agahnim decided to move on up, that means Ganon’s Tower came on down to Hyrule Castle, that center door being in the entrance, you’ll still need the required crystals to enter though</li>'
                            . '<li>Ice Palace tore down the wall so you can swim there pretty early now</li>'
                            . '<li>Remember a bunny can use the ' . __('item.BookOfMudora') . ' as well as talk to people, and collect items it sees lying on the ground</li>'
                            . '<li>The top of Turtle Rock can be accessed by walking on it’s tail</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.retro'),
                    'content' => [
                        'Eine Erinnerung an den ersten Teil von der Legend of Zelda Serie, ' . __('randomizer.variation.options.retro') . ' ' . __('randomizer.variation.title') . ' verbindet uns sogar mehr zu der Vergangenheit.',
                        [
                            'header' => 'Rubinen betriebener Bogen',
                            'content' => [
                                'Der Bogen nutzt nicht länger Pfeile. Es nutzt nun Rubine. Jeder Holzpfeil nutzt 10 Rubine zum feuern, während jeder Silberpfeil 50 Rubine kostet.',
                                'Holzpfeile sind nun getrennt vom Bogen, genau wie Silberpfeile; du musst den Bogen und entweder Holzpfeile oder Silberpfeile finden um den Bogen zu benutzen zu können.',
                                'Holzpfeile sind nun ein Gegenstand den man beschaffen muss, und zwar durch einen einmaligen Einkauf in einem Geschäft. Man kann sie NICHT in regulären Kisten finden oder andersweitig sonst wo außerhalb eines Geschäfts.',
                                'Falls du die Silberpfeile findest ohne die Holzpfeile gekauft zu haben, wirst du nur in der Lage sein Silberpfeile zu verschießen.',
                            ],
                        ],
                        [
                            'header' => 'Geschäfte auf der Oberwelt',
                            'content' => [
                                'Fünf Geschäfte von möglichen neun werden zufällig ausgewählt und werden neue Ware haben. Dies schließt NICHT das Geschäft der großen Bombe und das Geschäft der Hexe mit ein. Die Holzpfeile werden erhältlich sein für 80 Rubine und kleine Schlüssel für 100 Rubine pro Stück. Kleine Schlüssel sind mehrfach kaufbar.',
                            ],
                        ],
                        [
                            'header' => 'Kleine Schlüssel',
                            'content' => [
                                'Kleine Schlüssel sind nicht mehr Dungeon gebunden. Sie wurden in den generellen Gegenstandspool gemischt und sind außerhalb Dungeons auffindbar. Schlüssel von Gegner und Töpfe wurden nicht verändert.',
                                'Im einfachen und normalen Schwierigkeitsgrad wurden zehn Schlüssel aus dem Gegenstandspool entfernt ; fünfzehn in Schwer, Experte und Wahnsinnig. Denke nach wie du deine Schlüssel nutzt, und falls du feststeckst, kannst du welche im Geschäft kaufen!',
                                'Große Schlüssel, Karten und Kompasse sind an ihre jeweiligen Dungeons gebunden und wurden nicht zufällig verteilt außerhalb ihrer Dungeon.',
                            ],
                        ],
                        [
                            'header' => 'Wähle-Eins Höhlen',
                            'content' => [
                                'Vier zufällig ausgewählte Höhlen mit nur einem Eingang werden dich nicht zur einem Ort mit einem Gegenstand führen, sondern zu einer Wähle-Eins Höhle wo du die Auswahl zwischen einem Herzcontainer und einem blauen Elixier hast. Die Herzcontainer sind nicht aus dem Gegenstandspool, sondern sind Extra. Aber du wirst nicht mehr als 20 Herzcontainer aufeinmal haben können.',
                                'Eine zufällig ausgewählte Höhle mit nur einem Eingang wird dich zu einem mysteriösen, aber dennoch bekannten alten Mann führen der ein Schwert Upgrade besitzt. Dieses Schwert Upgrade ist aus dem generellen Gegenstandspool.',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'entrance_shuffle' => [
            'header' => __('randomizer.entrance_shuffle.title'),
            'subheader' => 'Der Entrance Randomizer erlaubt dir die Welt auf den Kopf zu stellen und das Spiel dennoch zu spielen.',
            'sections' => [
                'none' => [
                    'header' => __('randomizer.entrance_shuffle.options.none'),
                    'content' => [
                        'No entrance shuffling is applied.',
                    ],
                ],
                'simple' => [
                    'header' => __('randomizer.entrance_shuffle.options.simple'),
                    'content' => [
                        'Mischt die Dungeon Eingänge untereinander und behällt alle Dungeons mit 4 Eingängen an einem Platz so dass die Dungeons eins zu eins untereinander getauscht werden.',
                        'Anders als auf dem Todesberg in der Lichtwelt, wo die Innenräume gemischt werden, aber immer noch zum dem gleichen Punkt auf der Oberwelt verbunden sind. Auf dem Todesberg sind die Eingänge freier miteinander verbunden.',
                    ],
                ],
                'basic' => [
                    'header' => __('randomizer.entrance_shuffle.options.restricted'),
                    'content' => [
                        'Nutz die gleiche Mischung für Dungeons wie Simpel, aber die restlichen Eingänge sind freier miteinander verbunden. Höhlen und Dungeon mit mehreren Eingängen sind auf eine Welt beschränkt.',
                    ],
                ],
                'full' => [
                    'header' => __('randomizer.entrance_shuffle.options.full'),
                    'content' => [
                        'Mischt Höhlen und Dungeon Eingänge uneingeschränkt. Höhlen und Dungeon mit mehreren Eingängen sind auf eine Welt beschränkt.',
                    ],
                ],
                'crossed' => [
                    'header' => __('randomizer.entrance_shuffle.options.crossed'),
                    'content' => [
                        'Mischt Höhlen und Dungeon Eingänge uneingeschränkt, aber Verbindungshöhlen und Dungeons können nun die Lichtwelt und Schattenwelt miteinander verbinden.',
                    ],
                ],
                'insanity' => [
                    'header' => __('randomizer.entrance_shuffle.options.insanity'),
                    'content' => [
                        'Entkoppelt Eingänge und Ausgänge und mischt sie uneingeschränkt. Höhlen die im Original Spiel nur einen Eingang haben, können nur an der selben Stelle verlassen werden wo man sie betreten hat.',
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
                        'Bosses will not be randomized in any way.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.simple'),
                    'content' => [
                        'The normal number of each boss shuffled in their different locations, so expect to see armos knights, lanmolas, and moldorm twice.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.full'),
                    'content' => [
                        'Similar to ' . __('randomizer.boss_shuffle.options.simple') . ', except that 3 bosses are chosen at random to be seen twice.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.random'),
                    'content' => [
                        'All bosses chosen at random, you may see any boss multiple times as well as not see a boss at all.',
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
                        'Enemies will not be randomized in any way.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.shuffled'),
                    'content' => [
                        'Enemies are shuffled, Thieves are killable, Tile rooms are not random, Enemies are not random under bushes.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.random'),
                    'content' => [
                        'Anything goes with enemies.',
                    ],
                ],
            ],
        ],
        'hints' => [
            'header' => __('randomizer.hints.title'),
            'content' => [
                'Enable or disable the hints found on telepathic tiles throughout the world.',
            ],
        ],
        'difficulty' => [
            'header' => __('randomizer.difficulty.title'),
            'item_pool' => __('randomizer.item_pool.title'),
            'item_functionality' => __('randomizer.item_functionality.title'),
            'comparison' => [
                'header' => 'Schwierigkeitsgrade Vergleichs',
                'maximum_health' => 'Maximales Leben',
                'heart_containers' => 'Herzcontainer',
                'heart_pieces' => 'Herzteile',
                'maximum_mail' => 'Höchste Rüstung',
                'number_in_pool' => '# im Pool',
                'maximum_sword' => 'Höchstes Schwert',
                'maximum_shield' => 'Höchstes Schild',
                'shields_store' => 'Kaufbares Schild',
                'maximum_magic' => 'Maximale Magie Kapazität',
                'number_silvers' => '# der Silberpfeile',
                'number_silvers_swordless' => '# der Silberpfeile (Schwertlos)',
                'number_bottles' => '# der Flaschen',
                'number_lamps' => '# der Lampe',
                'potion_magic' => 'Fülling der Magie eines Elixiers',
                'potion_health' => 'Fülling der Herzen eine Elixiers ',
                'bug_net_fairy' => 'Fängt Schmetterlingsnetzt Feen',
                'powder_bubble' => 'Magisches Pulver auf Anti-Feen',
                'cape_consumption' => 'Magieverbrauchsrate des Umhangs',
                'byrna_invincible' => 'Byrna verleiht Unverwundbarkeit',
                'stun_boomerang' => 'Bumerang lähmt Gegner',
                'stun_hookshot' => 'Enterharken lähmt Gegner',
                'capacity_upgrade' => 'Pfeile / Bomben Kapazität Upgrades',
                'drop_rates' => 'Gegner Drop Raten',
                'quarter' => 'Viertel',
                'half' => 'Halb',
                'normal' => 'Normal',
                'shield_3' => 'Spiegel',
                'shield_2' => 'Rot',
                'shield_1' => 'Onkel’s',
                'none' => 'Keine',
                'sword_4' => 'Gold',
                'sword_3' => 'Gehärtetes',
                'sword_2' => 'Master',
                'mail_3' => 'Rot',
                'mail_2' => 'Blau',
                'mail_1' => 'Grün',
                'fairy' => 'Feen',
                'heart' => 'Herz',
                'bee' => 'Bienen',
                'yes' => 'Ja',
                'no' => 'Nein',
                'tooltip' => [
                    'silvers' => 'Silberpfeile funktionieren nur im Raum von Ganon.',
                    'bottles' => 'Wenn 4 Flaschen gesammelt wurden, werden die restlichen in Rubine umgewandelt.',
                    'potion_magic' => 'Elixiere werden 100% der Magie auffüllen in der Stachelhöhle.',
                    'potion_health' => 'Elixiere werden 20 Herzen auffüllen in der Stachelhöhle.',
                ],
            ],
        ],
        'weapons' => [
            'header' => __('randomizer.weapons.title'),
            'sections' => [
                [
                    'header' => __('randomizer.weapons.options.randomized'),
                    'content' => [
                        'Alle Schwert Upgrades sind zufällig verteilt. Du startest nicht mit einem Schwert und wirst wahrscheinlich eine Weile brauchen eins zu finden. Bomben sind eine gute Waffe für den Anfang, genauso wie Büsche und Schilder! Nutze jeden Gegenstand denn du findest um dich zu verteidigen.',
                        'Wenn diese Option mit dem Standard Modus kombiniert ist (siehe oben), wird dein Onkel so gnädig sein dir einer der folgenden Gegenstände zu geben, damit du die Flucht Sequenz abschließen kannst:',
                        '<ul>'
                            . '<li>Schwert Upgrade (ja, es ist immer noch möglich)</li>'
                            . '<li>Hammer</li>'
                            . '<li>Bogen + Volle Auffüllung deiner Pfeile</li>'
                            . '<li>Volle Auffüllung der Bomben</li>'
                            . '<li>Feuerstab + Volle Auffüllung der Magie</li>'
                            . '<li>Somaria Stab + Volle Auffüllung der Magie</li>'
                            . '<li>Byrna Stab + Volle Auffüllung der Magie</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.assured'),
                    'content' => [
                        'Link starts with a sword in his hands, prepared to take on the world.',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.vanilla'),
                    'content' => [
                        'Link will be able to find the four swords in their regular locations.',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.swordless'),
                    'content' => [
                        'Alle Schwerter wurden aus dem Spiel entfernt. Weil das Spiel aber vorraussetzt das du ein Schwert hast, sind folgende Änderungen nur im Schwertlos Modus enthalten:',
                        '<ul>'
                            . '<li>Schwerter wurden ersetzt durch 4 Kopien von 20 Rubine (ein grüner Rubin sprite mit “20” drauf).</li>'
                            . '<li>Die Barriere die den Eingang von Agahnim’s Turm blockiert kann mit dem Hammer zerstört werden.</li>'
                            . '<li>Die Vorhänge die den Fortschritt in Agahnim’s Turm blockieren sind schon vorher geöffnet, so wie die Ranken im Skelettwald.</li>'
                            . '<li>Medaillone können nur genutzt werden um den Schildkrötenfelsen oder den Wüstenseepalast zu öffnen, oder um im Eispalast fortzuschreiten. Normalerweise wird ein Schwert gebraucht um sie zu nutzen.</li>'
                            . '<li>Ganon kann nun Schaden vom Hammer nehmen.</li>'
                            . '<li>Die Silberpfeile sind in allen Schwierigkeitsgraden erhältlich.</li>'
                            . '<li>Der Hammer und das Buch Mudora werden gebraucht um die Tafeln von Quake und Bombos zu lesen.</li>'
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
                        'Enemy Health will not be randomized in any way.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.easy'),
                    'content' => [
                        'All enemy health will be in the 1-4 hp range.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.hard'),
                    'content' => [
                        'All enemy health will be in the 2-15 hp range.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.expert'),
                    'content' => [
                        'All enemy health will be in the 2-30 hp range.',
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
                        'Enemy damage will not be randomized in any way.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.shuffled'),
                    'content' => [
                        'The damage enemies do will be shuffled.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.random'),
                    'content' => [
                        'The damage enemies do will be completely randomized.',
                    ],
                ],
            ],
        ],
        'post_generation' => [
            'header' => 'Post Generation (cosmetic)',
            'cards' => [
                'heart_speed' => [
                    'header' => __('rom.settings.heart_speed'),
                    'content' => [
                        'Change the heart beep speed when Link is low on health.',
                    ],
                ],
                'play_as' => [
                    'header' => __('rom.settings.play_as'),
                    'content' => [
                        'You may choose a new sprite for Link and enjoy Hyrule as this character.',
                    ],
                ],
                'menu_speed' => [
                    'header' => __('rom.settings.menu_speed'),
                    'content' => [
                        'Only allowed in some configurations, When available this will allow you to set the speed of the menu opening and closing.',
                    ],
                ],
                'heart_color' => [
                    'header' => __('rom.settings.heart_color'),
                    'content' => [
                        'For players with color-blindness, we have a few options so they know how much health they have.',
                    ],
                ],
                'music' => [
                    'header' => __('rom.settings.music'),
                    'content' => [
                        'Enable or disable the background music so you can listen to your our sweet tracks.',
                    ],
                ],
                'quickswap' => [
                    'header' => __('rom.settings.quickswap'),
                    'content' => [
                        'Only allowed in some configurations, When available this will allow you to use L and R buttons to change items without opening the menu.',
                    ],
                ],
                'palette_shuffle' => [
                    'header' => __('rom.settings.palette_shuffle'),
                    'content' => [
                        'Shuffles the colors of the game around, an Enemizer staple.',
                    ],
                ],
            ],
        ],
        'item_pool' => 'Item Pool',
    ],
];

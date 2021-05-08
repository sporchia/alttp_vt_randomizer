<?php
return [
    'header' => 'Randomizer Options',
    'subheader' => 'Es gibt viele Wege um ALttP:Randomizer zu spielen!',
    'cards' => [
        'glitches_required' => [
            'header' => __('randomizer.glitches_required.title'),
            'sections' => [
                [
                    'header' => __('randomizer.glitches_required.options.none'),
                    'content' => [
                        'Hierfür wird kein Wissen über Glitches benötigt.',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.overworld_glitches'),
                    'content' => [
                        'Für Overworld Gitches wird Wissen über Major Glitches vorausgesetzt sowie das Wissen über fast alle Minor Glitches. Folgende Glitches die du beherrschen solltest:',
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
                        'Für Major Glitches wird Wissen über Major Glitches vorrausgesetzt die ein bisschen fortgeschrittener sind. Folgende Glitches die du beherrschen solltest:',
                        '<ul>'
                            . '<li>Overworld fake flutes</li>'
                            . '<li>Overworld screenwraps</li>'
                            . '<li>Overworld and Underworld bootless clips (including 1-frame clips requiring buffering)</li>'
                            . '</ul>',
                        'Es wurden zusätzliche Änderungen hier gemacht:',
                        '<ul>'
                            . '<li>Fake Worlds existieren wie im Originalspiel (z.B. sterben in einem Schattenwelt Palast ohne Aghanim besiegt zu haben setzt dich auf eine Fake Schattenwelt)</li>'
                            . '<li>Kristalle fallen immer (QoL Fix von dem Original)</li>'
                            . '<li>Das Wasser im Sumpfpalast fließt nicht ab wenn man auf der Overworld sich auf einen anderen Bildschirm bewegt (außer für den ersten Raum)</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.no_logic'),
                    'content' => [
                        'Keine Logik wird angewendet. Gegenstände können überall sein. Es könnte unmöglich sein Gegenstände normal zu bekommen, aber dank der Effektivität einiger Glitches, würde es nur in sehr seltenen Falle vorkommen das ein Spiel nicht schaffbar ist. Diese Einstellung setzt ein häufiges nutzen von Glitches voraus, die nicht in anderen Logikeinstellungen vorkommen (dazu zählt EG, Door Glitches und Overworld Bunny Revival).',
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
                        'Diese Einstellung ist gezielt für Anfänger gemacht oder für Leute die eine mehr entspannte Erfahrung suchen. Es wurden Einschränkungen in der Logik gemacht damit Gegenstände nicht in merkwürdigen Orte platziert werden die gewisses Fachwissen benötigen (z.B. um an den Vorsprung über Bumper Cave zu gelangen ohne Enterhaken). Andere Einschränkungen in der Logik stellen also sicher das man nicht gewisse Sachen machen muss die einfach zu schwierig im Moment wären. Zum Beispiel: falls es vorausgesetzt wird das man einen Palast machen muss den man eigentlich erst im Late-Game machen müsste, werden aufjedenfall Schwert- und Rüstungupgrades in der Welt platziert.',
                    ],
                ],
                [
                    'header' => __('randomizer.item_placement.options.advanced'),
                    'content' => [
                        'Diese Einstellung ist für Spieler die regulär spielen oder an Rennen teilnehmen gedacht. Das Ziel dieser Einstellung ist die Reichweiter der Platzierung der Gegenstände zu maximieren die man ohne Glitches erreichen kann. Es wird jedoch eine Ausnahme gemacht, um die Navigation durch dunkle Räume zu verhindern . Es wird nichts anderes berücksichtigt in Bezug auf die Platzierung der Gegendstände oder auf die Schwierigkeit die vorrausgesetzt wird um gewisse Orte zu erreichen. Die Erwartung ist, dass ein Spieler, der diese Einstellung wählt, mit dem Originalspiel vertraut ist und damit trainiert hat.',
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
                        'Wenn Karten außerhalb ihres Palastes gemischt werden, wird die Overworld Karte nicht anzeigen ob der Palast ein Kristall oder ein Amulett ist. Karten werden nach der Logik immer vorausgesetzt für das beenden eines Palastes, das gilt für beide Einstellungen der Platzierung der Gegenstände. Der Boss eines Palastes könnte die Karte des Palastes haben.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.standard'),
                    'content' => [
                        'Alle Form von Gegenstände eines Palast sind an ihren Palast gebunden, könnten aber innerhalb des Palast gemischt werden.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mc'),
                    'content' => [
                        'Karten und Kompasse sind nicht mehr an ihrem Palast gebunden (könnten trotzdem noch drin landen). Alle Schlüssel bleiben an ihren Palast gebunden.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mcs'),
                    'content' => [
                        'Karten, Kompasse und kleine Schlüssel sind nicht mehr an ihrem Palast gebunden (könnten trotzdem noch drin landen). Alle großen Schlüssel bleiben an ihren Palast gebunden.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.full'),
                    'content' => [
                        'Karten, Kompasse, kleine Schlüssel und große Schlüssel sind nicht mehr an ihren Palast gebunden (könnten trotzdem noch drin landen).',
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
                        'Diese Einstellung geht sicher das man ein volles Inventar erhalten kann, aber es besteht die Möglichkeit das man manche Schlüssel nicht erhalten kann. Zum Beispiel könnten alle nicht benötigten großen Schlüssel in der Großen Truhe sein und manche kleine Schlüssel hinter verschlossener Tür (wo man sich selbst aussperren könnte, je nachdem wie man seine kleine Schlüssel benutzt. Aber in der Praxis solltest du fast jeden Ort mit dieser Einstellung erreichen können.',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.locations'),
                    'content' => [
                        'Diese Einstellung geht sicher das alle 216 Gegenstände erreichbar sind, egal wie ineffizient man seine Schlüssel nutzt. Das heißt: große Schlüssel können nicht in großen Truhen sein und kleine Schlüssel die man braucht können nicht hinter verschlossenen Türen sein.',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.none'),
                    'content' => [
                        'Diese Einstellung geht nur sicher das man das Spiel schaffen kann. Du könntest von manchen Gegenstände ausgesperrt werden, falls sie nicht gebraucht werden (z. B. Der Feuerstab wenn er nicht gebraucht wird um das Ziel zu erreichen). Das gleiche kann für Paläste passieren.',
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
                        'Diese Einstellung setzt voraus das man durch Ganon’s Turm geht um Ganon besiegen zu können. Die Nummer der Kristalle hängt von der gewählten Einstellung ab.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.fast_ganon'),
                    'content' => [
                        'TDiese Einstellung setzt nur das besiegen von Ganon voraus. Ganon`s Turm wird nicht benötigt. Um dies zu ermöglichen wurde das Loch in der Pyramide permanent geöffnet (außer in Entrance Randomizer). Die Nummer der Kristalle hängt von der gewählten Einstellung ab.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.dungeons'),
                    'content' => [
                        'Diese Einstellung setzt nur die Vollendung aller Paläste voraus. Dies beinhaltet die 3 Paläste in der Lichtwelt, die 7 in der Schattenwelt, Agahnim´s Turm und Ganon´s Turm.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.pedestal'),
                    'content' => [
                        'Diese Einstellung setzt voraus das man alle 3 Amulette sammelt damit man das Triforce aus dem Sockel des Master-Swords ziehen kann.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.triforce-hunt'),
                    'content' => [
                        'Das Triforce wurde in 30 Teile zerschlagen und in ganz Hyrule verteilt! Du musst 20 von den 30 Teilen sammeln und sie zu Murahdahla bringen um das Triforce zu erhalten. Wer Murahdahla ist fragst du? Wieso? Er ist doch ganz klar der jüngere Bruder von Sahasrahla und Aginah! Er ist zurück aus seine Urlaub in Lorule und hängt jetzt im Hof von Schloss Hyrule ab.',
                    ],
                ],
            ],
        ],
        'tower_open' => [
            'header' => __('randomizer.tower_open.title'),
            'content' => [
                'Diese Einstellung lässt dich auswählen wie viele Kristalle benötigt werden um Ganon´s Turm zu öffnen. Falls 0 gewählt wird, ist der Turm immer offen. Bei Zufällig wird ein Schild vor dem Turm platziert der die Anzahl der benötigten Kristalle verrät. In Invertiert steht das Schild vor dem Schloss von Hyrule.',
            ],
        ],
        'ganon_open' => [
            'header' => __('randomizer.ganon_open.title'),
            'content' => [
                'Diese Einstellung lässt dich wählen wie viele Kristalle benötigt wird um Ganon verwundbar zu machen. Falls 0 gewählt wird, kann er jederzeit verletzt werden. Bei zufällig wird ein Schild vor die Pyramide gestellt die die Anzahl der benötigten Kristalle verrät. Bei Invertiert steht dieses Schild vor dem Schloss von Hyrule.',
            ],
        ],
        'world_state' => [
            'header' => __('randomizer.world_state.title'),
            'sections' => [
                [
                    'header' => __('randomizer.world_state.options.standard'),
                    'content' => [
                        'Diese Einstellung hält sich nahe an das Originalspiel. Es enthält den Prologe wo man Zelda retten und sie zum Heiligtum eskortieren muss. Dies muss getan werden bevor man die Welt frei erkunden kann. Dein Onkel wird dir immer ein Gegenstand geben damit den Prologe schaffen kannst (muss aber nicht immer ein Schwert sein). Dir wird ein Lichtpegel gegeben damit man ohne Probleme durch die dunklen Räume in der Kanalisation kommt. Dies gilt aber nur im Prolog, alle anderen Besuche der Kanalisation werden komplett in der Dunkelheit sein wenn man die Lampe nicht besitzt.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.open'),
                    'content' => [
                        'Diese Einstellung startet so, als hätte man den Prolog schon geschafft. Zelda wurde schon gerettet und du kann wählen ob du in deinem Haus oder im Heiligtum starten möchtest. Alle Truhen im Schloss von Hyrule sind ungeöffnet, du musst also entscheiden ob du hingehst und sie öffnest oder nicht.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.inverted'),
                    'content' => [
                        'Diese Einstellung startet in der Schattenwelt und man muss seinen Weg in die Lichtwelt finden um Ganon zu besiegen. Es wurden diese großen Änderung unternommen um dies zu ermöglichen:',
                        '<ul>'
                            . '<li>Ganon´s Turm und Agahnim´s Turm haben die Plätze getauscht.</li>'
                            . '<li>Ganon hat die Pyramide hinter sich gelassen und versteckt sich nun unter dem Schloss von Hyrule.</li>'
                            . '<li>Alle Portale bringen dich nun von der Schattenwelt in die Lichtwelt.</li>'
                            . '<li>Link wechselt ohne Mondperle in die Hasenform in der Lichtwelt.</li>'
                            . '<li>Der magische Spiegel transpotiert dich nun von der Lichtwelt in die Schattenwelt.</li>'
                            . '<li>Die Kristalle entsperren nun den Turm auf Schloss Hyurle, und nicht Ganon´s Turm.</li>'
                            . '</ul>',
                        'Aber es wurden noch einige andere Änderungen im Spiel unternommen damit dieses Konzept aufgeht:',
                        '<ul>'
                            . '<li>Link´s Haus und der Bombenladen haben die Plätze getauscht.</li>'
                            . '<li>Die Flöte funktioniert nur in der Schattenwelt, muss aber trotzdem noch an der Statue in Kakariko aktiviert werden.</li>'
                            . '<li>Einige Gegende wurden in der Lichtwelt so abgeändert das man den Spiegel dafür nicht mehr dafür braucht.</li>'
                            . '<li>Das Höhlensystem vom Todesberg hat sich stark geändert. In der Schattenwelt kommst du nun auf den dunklen Todesberg wo man normalerweise auf den normalen Todesberg geht. </li>'
                            . '<li>Der alte Mann auf dem Todesberg hat es irgendwie geschafft sich in die Schattenwelt zu verirren und möchte zurück zu seinem Zuhause in der Lichtwelt.</li>'
                            . '<li>Der Todesberg in der Schattenwelt hat nun Treppen damit Ganon´s Turm und der östliche Teil des Todesberg erreichbar sind.</li>'
                            . '<li>Der Eispalast kann nun direkt von der Schattenwelt aus betreten werden.</li>'
                            . '<li>Du kannst den Schwanz der Schildkröte besteigen um auf die Plattform auf dem Schildkrötenfelsen zu gelangen!</li>'
                            . '</ul>',
                        'Man sollte sich dran erinnern das man als Hase das Buch von Mudora nutzen und das man mit NPC´s reden kann. Invertierte Spiele können <strong>sehr schwierig</strong> sein, wir empfehlen als erstmal mit anderen Modi zu beginnen.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.retro'),
                    'content' => [
                        'Diese Einstellung soll an das originale Legend of Zelda erinnern. Das Hauptkonzept enthält:',
                        [
                            'header' => 'Rubine um Bogen zu nutzen',
                            'content' => [
                                '<ul>'
                                    . '<li>Es werden nicht länger Pfeile genutzt, sondern Rubine um den Bogen abzufeuern!</li>'
                                    . '<li>Der erste Progressive Bogen schiesst nur Holfpfeile ab.</li>'
                                    . '<li>Der zweite Progressive Bogen kann Hold- und Silberpfeile abschiessen.</li>'
                                    . '<li>Aber... man kann keiner der Bögen nutzen ohne einen Rubinenköcher.</li>'
                                    . '<li>Der Rubinenköcher kostet 80 Rubine und wird zufällig in einem Laden platziert!</li>'
                                    . '<li>Holzpfeile kosten 10 Rubine und Silberpfeile 50 Rubine.</li>'
                                    . '</ul>',
                            ],
                        ],
                        [
                            'header' => 'Läden',
                            'content' => [
                                'Fünf Läden der 9 möglichen werden zufällig ausgewählt und werden neue Ware erhalten. Der Bombenladen und Hexenschuppen zählen nicht dazu. Einer der ausgewählten Läden wird den Rubinenköcher für 80 Rubinen haben. Zusätzlich werden kleine Schlüssel in mehreren Läden kaufbar sein für 100 Rubine und es gibt Limit wie vielen man insgesamt kaufen kann.',
                            ],
                        ],
                        [
                            'header' => 'Kleine Schlüssel',
                            'content' => [
                                'Kleine Schlüssel sind nicht mehr an ihren Palast gebunden und können nun für jeden benutzt werden. Ebenfalls müssen diese Schlüssel nicht mehr in ihrem Palast sein und können nun auch auf der Overworld gefunden werden. Schlüssel unter Töpfe und die von Gegner fallen gelassen werden, wurden nicht geändert. 10 Schlüssel wurden vom Gegenstandspool entfernt (15 in härteren Schwierigkeitsgraden). Große Schlüssel, Karten und Kompasse sind weiterhin an ihren Palast gebunden und können nur innerhalb ihres Palast gefunden werden..',
                            ],
                        ],
                        [
                            'header' => 'Take-Any Höhlen',
                            'content' => [
                                'Fünf zufällig ausgewählte Eingänge (welche normalerweise nicht zu einem Gegenstand führen) werden dich nun zu einer Take-Any Höhle bringen. Vier dieser Höhlen bieten die Auswahl zwischen einem Herzcontainer und einem Blauen Trank, der fünfte zu einem Schwertupgrade (das aus dem Gegenstandspool genommen wurde). Man kann also nur 3 Schwerter auf normalen Weg finden und das vierte in einer dieser Höhlen. Die Herzcontainer wurden nicht aus Gegenstandspool genommen, sondern als Bonus hinzugefügt. Das heißt aber nicht das man mehr als 20 Herzen damit erhalten kann. Die Auswahl des blauen Tranks setzt voraus das man eine leere Flasche mit sich führt.',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'entrance_shuffle' => [
            'header' => __('randomizer.entrance_shuffle.title'),
            'subheader' => [
                'Diese Einstellung mischt den Ausgang eines Einganges. Wenn man zum Beispiel in den Laden in Kakariko geht, könnte er zu einem Feen Brunnen führen oder wo anders hin. Die verschiedene Arten der Eingänge werden zu einer Gruppe hinzugefügt und dann vermischt. Wie die Eingänge gruppiert werden hängt an der Einstellung der Mischung ab. Overworld Übergange werden nicht gemischt.',
                'Höhlen/Paläste mit mehreren Eingängen weisen bestimmte Verhaltensweisen auf, sofern nicht anders angegeben:',
                '<ul>'
                    . '<li>Alle Eingänge sind mit einander verbunden, das heißt man kommt wieder an den selben Eingang raus, wenn man die Höhle wieder verlässt</li>'
                    . '<li>Alle Eingänge für ein spezifischen Höhlensystem/Palast sind an die selbe Welt gebunden (d.H. Eine Höhle/Palast kann nicht einen Eingang in der Lichtwelt und der Schattenwelt haben.</li>'
                    . '</ul>',
                'Die Eingänge von Link´s Haus und der Hintereingang von der Bar in Kakriko werden nicht gemischt. Aber in ' . __('randomizer.world_state.options.inverted') . ' ' . __('randomizer.world_state.title') . ' werden die Eingänge von Link´s Haus (in der Schattenwelt) und dem Bombenladen (in der Lichtwelt) gemischt',
            ],
            'sections' => [
                'none' => [
                    'header' => __('randomizer.entrance_shuffle.options.none'),
                    'content' => [
                        'Keiner der Eingänge wird gemischt. Alle führen zu ihrem originalen Platz.',
                    ],
                ],
                'simple' => [
                    'header' => __('randomizer.entrance_shuffle.options.simple'),
                    'content' => [
                        'Diese Einstellung nutzt die meiste Anzahl an Gruppen. Dies schränkt ein wie gründlich die verschiedenen Eingangstypen vermischt werden um es Simpel zu halten.',
                        [
                            'header' => 'Paläste mit nur einem Eingang',
                            'content' => [
                                'Alle Eingänge gehören zu einer Gruppe und werden untereinander vermischt. Dazu zählt der letzte Eingang vom Skelettwald (der zum Boss führt), aber nicht die anderen Eingänge.',
                            ],
                        ],
                        [
                            'header' => 'Paläste mit mehreren Eingänge (außer dem Skelettwald)',
                            'content' => [
                                'Jeder der 4 Eingänge vom Schloss Hyrule, Wüstenpalast und dem Schildkrötenfelsen werden zu einer Gruppe hinzugefügt. Jede der 4er Gruppen werden untereinander vermischt mit einer statischen Zuordnung. Um ein Beispiel zu geben: Schloss Hyrule und der Wüstenpalast wurden untereinander vermischt, aber der Haupteingang vom Wüstenpalast wird immer zum Haupteingang von Schloss Hyrule führen, der linke Eingang vom Wüstenpalast immer zum linken Eingang von Schloss Hyrule. Das passiert mit jedem der Eingänge. Die Ausnahme ist Schloss Hyrule in ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . '.',
                            ],
                        ],
                        [
                            'header' => 'Skelettwald (außer der letzte Eingang)',
                            'content' => [
                                'All Eingänge (auch die Löcher) bleiben in der Region des Skelettwaldes und werden untereinander vermischt. Die normalen Eingänge sind mit den normalen Eingängen vermischt und die Löcher mit den anderen Löcher.',
                            ],
                        ],
                        [
                            'header' => 'Höhlen mit nur einem Eingang',
                            'content' => [
                                'Alle Eingänge werden zu einer Gruppe hinzugefügt und untereinander vermischt. Dazu zählen aber nicht die Eingänge vom Todesberg in der Lichtwelt. Beispiel: Häuser',
                            ],
                        ],
                        [
                            'header' => 'Höhlen mit mehreren Eingänge',
                            'content' => [
                                'Alle Eingänge werden zu einer Gruppe hinzugefügt und untereinander vermischt. Orte mit zwei Eingänge werden nur mit anderen Orten mit zwei Eingänge gemischt (z.B. das Haus der älteren Paar in Kakariko). Dazu zählt keiner der Eingänge vom Todesberg in der Lichtwelt.',
                            ],
                        ],
                        [
                            'header' => 'Todesberg in der Lichtwelt',
                            'content' => [
                                'Alle Eingänge bleiben an den Todesberg in der Lichtwelt gebunden und werden untereinander vermischt. Die Höhle wodurch man den Todesberg betritt wird nicht vermischt (die Höhle wo man den alten Mann auffindet der sich verirrt hat).',
                            ],
                        ],
                        [
                            'header' => 'Löcher in der Overworld (außer die vom Skelettwald)',
                            'content' => [
                                'Alle Löcher werden zu einer Gruppe hinzugefügt und untereinander vermischt. Löcher und deren zugehörigen Höhleneingang bleiben miteinander gepaart. Wenn man in ein Loch fällt und die Höhle verlässt, wird man immer zu dem Eingang gebracht zu dem das Loch gehört, egal in welchen Raum man fällt. ',
                            ],
                        ],
                    ],
                ],
                'restricted' => [
                    'header' => __('randomizer.entrance_shuffle.options.restricted'),
                    'content' => [
                        'Wie in ' . __('randomizer.entrance_shuffle.options.simple') . ' , außer das alle Eingänge die nicht zu einem Palast gehören (alle Höhlen mit einem Eingang, alle Höhlen mit mehreren Eingänge und alle Eingänge vom Todesberg in der Lichtwelt) werden zu einer Gruppe hinzugefügt und untereinander vermischt. Dazu gehört auch der Eingang zur Höhle wo man normalerweise den Todesberg besteigt.',
                    ],
                ],
                'full' => [
                    'header' => __('randomizer.entrance_shuffle.options.full'),
                    'content' => [
                        'Wie in ' . __('randomizer.entrance_shuffle.options.restricted') . ' , außer das alle Eingänge von Palästen  (alle mit einem Eingang und alle mit mehreren Eingänge) zu der Gruppe der Eingänge von Höhlen hinzugefügt und untereinander vermischt  werden.',
                    ],
                ],
                'crossed' => [
                    'header' => __('randomizer.entrance_shuffle.options.crossed'),
                    'content' => [
                        'Wie in ' . __('randomizer.entrance_shuffle.options.full') . ' , außer das Höhlen/Paläste mit mehreren Eingänge nicht mehr an eine Welt gebunden sind. Die Eingänge können also in der Lichtwelt und Schattenwelt sein.',
                    ],
                ],
                'insanity' => [
                    'header' => __('randomizer.entrance_shuffle.options.insanity'),
                    'content' => [
                        'Wie in ' . __('randomizer.entrance_shuffle.options.crossed') . ' ,außer das alle Eingänge und Löcher nicht mehr miteinander verbunden sind (außer Höhlen mit nur einem Eingang und die Region des Skelettwaldes). Das heißt, der Ausgang einer Höhle wird dich nicht zu dem selben Eingang bringen, sondern wo ganz anders hin. Nur die Höhlen mit nur einem Eingang führen noch zu dem selben Eingang. Alle Löcher in der Overworld werden nicht mehr mit dem selben Eingang gepaart. Alle Eingänge vom Skelettwald bleiben an die Region des Skelettwaldes gebunden (außer der letzte Palasteingang)..',
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
                        'Bosse werden nicht gemischt. Alle Bosse bleiben in ihrem originalen Palast.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.simple'),
                    'content' => [
                        'Alle originale Bosse (außer beide Formen von Agahnim und Ganong) werden untereinander vermischt, dazu zählen auch die 3 Bosse die man erneut bekämpft in Ganon´s Turm. Somit hat der Bosspool jeweils zwei Armos Knights, Lanmolas und Moldorms. Ganon´s Turm kann also 3 zufällige Bosse haben!',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.full'),
                    'content' => [
                        'Das selbe wie in ' . __('randomizer.boss_shuffle.options.simple') . ' , außer das die drei Bosse die zweimal auftauchen zufällig gewählt werden.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.random'),
                    'content' => [
                        'Alle Bosse werden komplett zufällig gewählt. Du kannst also besimmte Bosse mehrmals antreffen und anderen wiederum überhaupt gar nicht.',
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
                        'Gegner werden nicht gemischt. Alle Gegner bleiben in ihrem ursprünglichen Platz.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.shuffled'),
                    'content' => [
                        'Alle Gegner werden zufällig ausgewählt, es sind jedoch einige Einschränkungen zu beachten:',
                        '<ul>'
                            . '<li>Nicht alle Gegner können überall auftauchen aufgrund Limitierungen des Spiels.</li>'
                            . '<li>Räume wo man alle Gegner töten muss werden nie bestimmte Waffen erfordern (z.B. Mimics erfordern den Bogen, usw)</li>'
                            . '<li>Diebe können nun getötet werden.</li>'
                            . '<li>Räume mit fliegen Platten werden nicht gemischt.</li>'
                            . '<li>Gegner die unter Büschen auftauchen werden nicht gemischt.</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.random'),
                    'content' => [
                        'Das selbe wie ' . __('randomizer.enemy_shuffle.options.shuffled') . '  , außer das Gegner unter Büschen nun gemischt werden und die Chance das sie auftauchen ebenfalls zufällig sein kann. Die Änderung sieht zwar nach nicht viel aus, kann aber die Spielbarkeit stark beeinflussen. Zusätzlich werden die fliegende Platten in ihren Räumen nun zufällige Muster haben und die Chance das Diebe verwundbar sein werden liegt nur noch bei 50%.',
                    ],
                ],
            ],
        ],
        'hints' => [
            'header' => __('randomizer.hints.title'),
            'content' => [
                'Aktiviere oder deaktiviere Hinweise auf den telepatischen Platten in der Welt.',
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
                'number_silvers' => 'Höchster Bogen',
                'number_silvers_swordless' => 'Höchster Bogen (Schwertlos)',
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
                'silver' => 'Silver',
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
                    'silvers' => 'Schwertlos hat weiterhin Silberpfeile, aber sind nur im Kampf gegen Ganon nutzbar.',
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
                        'Alle vier der progessiven Schwert sind in der Welt verteilt. Falls diese Einstellung mit ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . ' verwendet wird, wird dir dein Onkel jeweils folgendes geben können:',
                        '<ul>'
                            . '<li>Schwert Upgrade (ja, es ist immer noch möglich)</li>'
                            . '<li>Hammer</li>'
                            . '<li>Bogen + Volle Auffüllung deiner Pfeile</li>'
                            . '<li>Volle Auffüllung der Bomben</li>'
                            . '<li>Feuerstab + Volle Auffüllung der Magie</li>'
                            . '<li>Somaria Stab + Volle Auffüllung der Magie</li>'
                            . '<li>Byrna Stab + Volle Auffüllung der Magie</li>'
                        . '</ul>',
                        'Falls du keine Pfeile oder Magie mehr haben solltest, kannst du die Funktion "Save and Quit" nutzen um sie wieder teilweise aufzufüllen damit du fortfahren kannst.',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.assured'),
                    'content' => [
                        'Link startet mit einem Schwert bereits in seinem Besitz! Vielleicht hatte er es unter seinem Kissen versteckt?',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.vanilla'),
                    'content' => [
                        'Alle vier Schwerter sind auffindbar an ihrem originalen Ort. Dies sind:',
                        '<ul>'
                            . '<li>Link’s Onkel</li>'
                            . '<li>Master-Sword Sockel</li>'
                            . '<li>In der Zwergenschmiede</li>'
                            . '<li>Fee in der Pyramide</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.swordless'),
                    'content' => [
                        'Alle Schwerter werden aus dem Spiel entfernt und mit 20 Rubine ersetzt. Verschiedene Änderungen wurden unternommen damit dies möglich ist:',
                        '<ul>'
                            . '<li>Ganon kann durch den Hammer verletzt werden.</li>'
                            . '<li>Beide progessive Bögen sind immer im Gegendstandspool.</li>'
                            . '<li>Die magische Barriere außerhalb Agahnim´s Turm kann durch den Hammer zerstört werden.</li>'
                            . '<li>Der Vorhang/Ranken in Agahnim´s Turm und Skelettwald sind bereits zerstört.</li>'
                            . '<li>Ether und Bombos Tafel fordern den Hammer und das Buch von Mudora voraus.</li>'
                            . '<li>Medallions können nur benutzt werden um den Wüstenseepalast und den Schildkrötenfelsen zu öffnen, oder um im Eispalast weiterzukommen. Sie funktionieren auf ihrem Zeichen auf dem Boden.</li>'
                            . '<li>Schwerter wurden durch 20 Rubine ersetzt</li>'
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
                        'Die Lebensanzahl von Gegner sind nicht zufällig.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.easy'),
                    'content' => [
                        'Das Leben der Gegner wird im Bereich von 1-4hp bleiben (1-2 Schwerthiebe mit dem Schwert vom Onkel).',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.hard'),
                    'content' => [
                        'Das Leben der Gegner wird im Bereich von 2-15hp sein (1-8 Schwerthiebe mit dem Schwert vom Onkel). Im durchschnitt werden die Gegner mehr Leben haben als im Original.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.expert'),
                    'content' => [
                        'Das Leben der Gegner wird im Bereich von 2-30hp sein (1-15 Schwerthiebe mit dem Schwert vom Onkel). Fast jeder Gegner wird um einiges mehr an Leben haben als im Original.',
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
                        'Der Schaden von Gegner wird nicht zufällig sein.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.shuffled'),
                    'content' => [
                        'Der Schaden der Gegner wird mit den Gegnertypen gemischt. Als Beispiel könnte der Schaden von Octoroks und Ganon gemischt werden, das heißt das alle Octoroks 8 Herzen an Schaden verursachen und Ganon nur 1 Herz! Rüstungupgrades verringern wie vorgesehen den Schaden.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.random'),
                    'content' => [
                        'Der Schaden der Gegner wird komplett zufällig sein. Für jedes Rüstungupgrade wird ein Wert ausgewählt, sie verringern also nicht den Schaden. Alle Gegner könnten massiven Schaden austeilen.',
                    ],
                ],
            ],
        ],
        'post_generation' => [
            'header' => 'Kosmetische Einstellungen (nach der Erstellung des Seeds)',
            'cards' => [
                'heart_speed' => [
                    'header' => __('rom.settings.heart_speed'),
                    'content' => [
                        'Ändere die Geschwindigkeit des Warntons wenn Link wenig Leben hat.',
                    ],
                ],
                'play_as' => [
                    'header' => __('rom.settings.play_as'),
                    'content' => [
                        'Ändere das Aussehen vom Helden (spiele z.B. als Tetra anstatt Link).',
                    ],
                ],
                'menu_speed' => [
                    'header' => __('rom.settings.menu_speed'),
                    'content' => [
                        'Ändere die Geschwindigkeit wie schnell sich das Menü öffnet und schließt. Dies ist nicht für Rennen verfügbar.',
                    ],
                ],
                'heart_color' => [
                    'header' => __('rom.settings.heart_color'),
                    'content' => [
                        'Ändere die Farbe deiner Herzen. Auswahl ist eingeschränkt aufgrund Limitierungen des Spiels.',
                    ],
                ],
                'music' => [
                    'header' => __('rom.settings.music'),
                    'content' => [
                        'Aktiviere oder deaktiviere die originale Hintergrundmusik. Du musst es nicht deaktivieren um  MSU-1 Packs zu nutzen. Falls es aktiviert bleibt während man einen MSU-1 Pack nutzt, dient es als SPC-Fallback und spielt nur Hintergrundmusik ab, falls ein Fehler in der MSU-1 Spur vorliegt (anstatt kompletter Stille)..',
                    ],
                ],
                'quickswap' => [
                    'header' => __('rom.settings.quickswap'),
                    'content' => [
                        'Erlaubt es den Gegendstand mit L und R zu wechseln ohne das Menü zu öffnen. Dies ist nicht für Rennen verfügbar (außer für Entrance Randomizer).',
                    ],
                ],
                'palette_shuffle' => [
                    'header' => __('rom.settings.palette_shuffle'),
                    'content' => [
                        'Die Farbpalleten werden zufällig ausgewählt im Spiel. Dadurch könnte alles sehr bizarr aussehen. Mit Vorsicht aktivieren!',
                    ],
                ],
                'reduce_flashing' => [
                    'header' => __('rom.settings.reduce_flashing'),
                    'content' => [
                        'Die Intensität von Blitzeffekten im Spiel wird deutlich reduziert oder sie werden ganz ausgeschaltet.  Vorsicht: Deine Lichtempfindlichkeit kann möglicherweise dennoch auf manche Effekte reagieren.',
                    ],
                ],
            ],
        ],
        'item_pool' => 'Gegendstandspool',
    ],
];

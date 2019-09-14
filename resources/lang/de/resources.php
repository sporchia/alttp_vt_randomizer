<?php
return [
    'header' => 'Ressourcen',
    'cards' => [
        'discord' => [
            'header' => 'Discord',
            'content' => [
                '<div class="center"><a class="btn btn-primary btn-lg btn-xl" href="https://discord.gg/alttprandomizer" rel="noopener noreferrer" role="button" target="_blank">' . __('navigation.discord') . '</a></div>',
                'Trete unserer Discord Community bei! Wir haben freundliche und hilfsbereite Leute, Neuigkeiten über Community Events, ALttP: Randomizer Updates, hilfreiche Handbücher, Tipps und Tricks, und vieles mehr! Komm sag Hallo und schau dir einfach mal den #resources Kanal an!',
            ],
        ],
        'learn' => [
            'header' => 'Lern-zu-spielen Videos',
            'content' => [
                '<div class="center"><a class="btn btn-secondary btn-lg btn-xl" href="https://www.youtube.com/channel/UCBMMk0WJAeldNv4fI9juovA" role="button">ALttP:R Youtube Channel</a></div>',
                'Schau dir die Guides an wie man seine Route plannt, Glitch Gutorials, Update Ankündigungen, Turnier Highlights, und vieles mehr! Gut für beide, neue Spieler die alles erlernen wollen, und erfahrene Spieler die ihr Können perfektionieren wollen!',
            ],
        ],
        'external' => [
            'header' => 'Externe Ressourcen',
            'content' => [
                '<ul>'
                    . '<li><a href="https://alttprlinks.page.link/QxvY" target="_blank" rel="noopener noreferrer">Häufige Dinge die einem Neuling Kopfschmerzen bereiten können</a> (Sehr hilfreich fürs erste Mal)</li>'
                    . '<li><a href="https://alttprlinks.page.link/3vXm" target="_blank" rel="noopener noreferrer">Glossar für hilfreiche Sachen</a></li>'
                    . '<li><a href="https://alttprlinks.page.link/HVFx" target="_blank" rel="noopener noreferrer">Glitch Ressourcen</a></li>'
                    . '<li><a href="https://alttprlinks.page.link/on1o" target="_blank" rel="noopener noreferrer">Trackers / HUDs</a></li>'
                    . '<li><a href="http://alttp.mymm1.com/srl/" target="_blank" rel="noopener noreferrer">Wie man durchstartet auf SRL</a></li>'
                . '</ul>',
            ],
        ],
        'pitfalls' => [
            'header' => 'Häufige Irrtümer',
            'content' => [
                '<ul>'
                    . '<li>Du kannst den Y Knopf benutzen um zwischen Silber und Normalen Pfeilen zu wechseln, dem Roten und Blauen Bumerang, dem Pilz und dem magischen Pulver, der Schaufel und der Flöte.</li>'
                    . '<li>In der Schattenwelt kannst du nördlich der Pyramide den Enterharken benutzen um über den Fluss zu kommen. Halte ausschau nach dem Pfeil aus Gras!</li>'
                    . '<li>Falls du dich im Bumper Cave befindest und den Enterhaken nicht besitzt, versuche am oberen Rand des Loches entlangen zu gehen - Enterhaken wird nicht benötigt!</li>'
                    . '<li>Mit dem magischen Umhang kannst du einfach durch Agahnim’s Barrerie gehen, oder du kannst sie einfach mit einem verbesserten Schwert zerstören.</li>'
                    . '<li>Falls du den magischen Spiegel hast, kannst du den Wüstenpalast einfach vom Areal des Wüstenseepalast erreichen ohne das Buch Mudora zu haben.</li>'
                    . '<li>Bombos-Medaillon schmilzt Sachen genauso wie der Feuerstab, sehr nützlich im Eispalast.</li>'
                    . '<li>Du kannst kleine Öffnungen überwinden indem du gegen eine Wand oder ein Objekt rennst. Der Rückstoß befördert dich einfach rüber.</li>'
                    . '<li>Sahasrahla gibt dir einen Gegendstand falls du das Amulett des Mutes im Besitz hast.</li>'
                    . '<li>Die Superbombe ist erhältlich im Bombenladen wenn du Kristall 5 und 6 besitzt.</li>'
                    . '<li>Der Schmied und die lilaene Kiste bleiben bei dir wenn du speicherst und beendest.</li>'
                    . '<li>Es wird niemals verlangt das du dich durch Dunkle Räume navigierst; die Lampe wird deinen Weg erhellen, du musst sie nur finden!</li>'
                    . '<li>Manche Schlüssel sind nicht erhältlich, wenn sie nicht von der Logik vorrausgesetzt werden um einen Dungeon abzuschließen. Als Beispiel: Im Skelettwald könnte der große Schlüssel in der großen Truhe sein.</li>'
                . '</ul>',
            ],
        ],
        'changes' => [
            'header' => 'Unterschiede',
            'sections' => [
                [
                    'header' => 'Was ist zufällig?',
                    'content' => [
                        '<ul>'
                            . '<li>Beinahe alle Orte von einzigartigen Gegendstände</li>'
                            . '<li>Amulette und Kristalle (Überprüfe deine Karte!)</li>'
                            . '<li>Die Medaillone die benötigt werden um den Wüstenseepalast und Schildkrötenfelsen zu öffnen.</li>'
                            . '<li>Gegner drops und Ziehpreise (z.B. von Bäumen)</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => 'Was ist gleich geblieben?',
                    'content' => [
                        '<ul>'
                            . '<li>Alle Läden in Hyrule</li>'
                            . '<li>Der Schießstand und Rubinkistenspiele</li>'
                            . '<li>Kleine Schlüssel unter Töpfe und von Gegnern</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => 'Was änderte sich vom originalen Spiel?',
                    'content' => [
                        'Es gibt einige Änderungen vom originalen Spiel um das Spielerlebniss zu verbessern und um zu verhindet das man feststeckt. Die Japanische 1.0 Rom wird benutzt da es einige Glitches mehr erlaubt die für fortgeschrittene Spielmodi benutzt werden.',
                        '<ul>'
                            . '<li>Du brauchst nicht länger die Lampe im Prolog um das Bücherregal zu verschieben.</li>'
                            . '<li>Du kannst nun in dunklen Räumen sehen ohne die Lampe (außer im Offen Modus).</li>'
                            . '<li>Du kannst mit Y zwischen Gegendstände wechseln die den selben Platz im Inventar belegen. Als Beispiel, du kannst nun Schaufel und Flöte besitzen und zwischen ihnen wechseln.</li>'
                            . '<li>Das Untermenü für die Flaschen öffnet sich nicht länger automatisch. Du kannst es mit X öffnen oder einfach mit Y zwischen den Flaschen herwechseln.</li>'
                            . '<li>Die Wasserlevel im Sumpfpalast kehren automatisch zu ihrem Ursprungzustand zurück, wenn du denn Bereich auf der Oberwelt verlässt. Dies verhindert das du ausversehen den kleinen Schlüssel unter Wasser setzt und somit feststeckst!</li>'
                            . '<li>Das Menü wo du deine Speicherstände auswählt hat eine Reihe von Symbolen oben. Die sind für jeden Seed anders und versichert das jeder den selben Seed hat für Rennen. Ansonsten haben sie keine andere Relevanz.</li>'
                            . '<li>Die Feen (Pyramide und Wasserfall der Wünsche) verbessern nicht länger deine Gegendstände. Stattdessen enthalten ihre Höhlen jeweils zwei Truhen, die für die üblichen Upgrades stehen, die in den Mix gemischt wurden.</li>'
                            . '<li>Es ist garantiert das du den Gegendstand beim Schaufelspiel bei der dreizigsten Grabung hast.</li>'
                            . '<li>Es ist garantiert das du den Gegenstand beim Truhenspiel beim ersten Versuch erhälst (entweder in der ersten oder zweiten Kiste).</li>'
                        . '</ul>',
                    ],
                ],
            ],

        ],
    ],
];

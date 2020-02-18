<?php
return [
    'header' => 'Beginne dein Abenteuer!',
    'subheader' => 'Willst du deine Fähigkeiten testen in einem durchgemischten Hyrule? Hier bist du am richtigen Platz!',
    'cards' => [
        'discord' => [
            'header' => '1. Trete unsere Discord Community bei',
            'content' => [
                '<div class="center"><a class="btn btn-primary btn-lg btn-xl" href="https://discord.gg/alttprandomizer" rel="noopener noreferrer"role="button" target="_blank">' . __('navigation.discord') . '</a></div>',
                'Trete unserer Discord Community bei! Wir haben freundliches hilfreiche Leute, News über Community Events, ALttP:Randomizer Updates, hilfreiches Guides, Tipps und Tricks, und vieles mehr! Komm sag Hallo!',
            ]
        ],
        'rom' => [
            'header' => '2. Bekomme die ROM',
            'content' => [
                'Du brauchst die basis ROM. Es sollte eine <span class="font-weight-bold">Zelda no Densetsu: Kamigami no Triforce v1.0</span> ROM sein. Mach dir keine Sorgen wenn du kein Japanisch kannst; der Patch liefert englische Texte und behält die einzigartigen Glitches in Takt die es nur bei der originalen Version gibt.',
                'Falls du Probleme hast, frage im <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord nach</a>!',
            ]
        ],
        'randomize' => [
            'header' => '3. Wähle deine Spieloptionen',
            'content' => [
                'Gehe zu <a href="/randomizer" target="_blank" rel="noopener noreferrer">' . __('navigation.randomizer') . '</a> und lade deine ROM. Der nächste Bildschirm zeigt dir verschiedene Spieloptionen. Für die ersten Male empfehlen wir “' . __('randomizer.difficulty.title') . '” zu “' . __('randomizer.difficulty.options.easy') . '” wechseln und die restlichen Optionen einfach so zulassen. Dann klicke “' . __('randomizer.generate.spoiler_race') . '” und du bekommst einen nagelneues, zufälliges Spiel!',
                'Einen mehr detaillierten Guide findet ihr <a href="/options">hier</a>.',
            ]
        ],
        'emulator' => [
            'header' => '4. Finde einen Weg zum spielen',
            'content' => [
                'Als erstes braucht ihr etwas, worauf ihr euer Spiel spielen könnt. Wir empfehlen einen Emulator. Ein Emulator ist ein Programm, das die SNES Hardware nachstellt, das euch erlaubt SNES Spiele auf dem Computer zu spielen. Der empfohlende Emulator, SNES9x, findet ihr auf ihrer Webseite <a href="http://www.snes9x.com/" target="_blank" rel="noopener noreferrer">hier</a>.',
                'Auch wenn ihr komplett nur mit eine Tastatur spielen könnt, sorgt ein Kontroller dennoch für eine bessere Erfahrung. Während die meisten USB Kontroller ihr Arbeit tun, empfehlen wir einen <a href="https://www.amazon.com/dp/B002B9XB0E" target="_blank" rel="noopener noreferrer">iBuffalo Classic USB Gamepad</a> oder einen <a href="https://www.amazon.com/dp/B074HBQ78V" target="_blank" rel="noopener noreferrer">8Bitdo SF30 Wireless Bluetooth Controller</a>.',
                'Es gibt auch andere Wege zu spielen, einschließlich auf originaler SNES Hardware. Aber es gibt auch Emulatoren, wie der Zsnes, die nicht richtig mit dem Randomizer funktionieren. Trete uns auf <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a> bei um mehr zu lernen!',
                'NOTIZ FÜR SNESMINI SPIELER: Nenne deine ROM Datei auf 61 Buchstaben oder weniger um, denn der SNESMini kommt nicht mit langen Dateinamen klar.',
            ]
        ],
        'play' => [
            'header' => '5. Spiel spielen!',
            'content' => [
                'Du bist nun endlich bereit! Der beste weg zum lernen ist, die ROM Datei zu laden und anfangen zu spielen. Falls du das Gefühl hast das du feststeckst, schaue auf der Liste für häufige Irrtümer nach, oder frage im <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a> nach Hilfe.',
                '<ul>'
                    . '<li>Du kannst den Y Knopf benutzen um zwischen Silber und Normalen Pfeilen zu wechseln, dem Roten und Blauen Bumerang, dem Pilz und dem magischen Pulver, der Schaufen und der Flöte.</li>'
                    . '<li>Der Schmied und die lilaene Kiste bleiben bei dir wenn du speicherst und beendest, so kannst du sie sie zurück bringen ohne den magischen Spiegel zu besitzen.</li>'
                    . '<li>In der Schattenwelt kannst du nördlich der Pyramide den Enterharken benutzen um über den Fluss zu kommen. Halte ausschau nach dem Pfeil aus Gras!</li>'
                    . '<li>Du kannst kleine Öffnungen überwinden indem du gegen eine Wand oder ein Objekt rennst. Der Rückstoß befördert dich einfach rüber.</li>'
                    . '<li>Falls du dich im Bumper Cave befindest und den Enterhaken nicht besitzt, versuche am oberen Rand des Loches entlangen zu gehen - Enterhaken wird nicht benötigt!</li>'
                    . '<li>Manche Schlüssel sind nicht erhältlich, wenn sie nicht von der Logik vorrausgesetzt werden um einen Dungeon abzuschließen. Als Beispiel: Im Skelettwald könnte der große Schlüssel in der großen Truhe sein.</li>'
                    . '</ul>',
                'Vergesse nicht im umfassenden <a href="/resources">' . __('navigation.resources') . '</a> nachzuschauen für Tutorials und mehr Tipps!',
            ]
        ],
    ],
];

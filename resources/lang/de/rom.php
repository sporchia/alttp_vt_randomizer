<?php
return [
    'loader' => [
        'title' => 'Anfangen',
        'file_select' => 'ROM Datei auswählen',
        'content' => '<ol>'
            . '<li>Wähle die ROM Datei und lade sie ihn den Browser (Bitte nutze die <strong>Zelda no Densetsu: Kamigami no Triforce v1.0</strong> ROM mit einer .smc oder .sfc Endung)</li>'
            . '<li>Wähle die <a href="/de/options">' . __('navigation.options') . '</a> um auszuwählen wie Zufällig dein Spiel sein soll</li>'
            . '<li>Klicke ' . __('randomizer.generate.race') . '</li>'
            . '<li>Dann speichere deine ROM und fang an zu spielen</li>'
            . '</ol>',
    ],
    'info' => [
        'spoilerwarning' => 'WARNUNG: Der Ersteller dieses Spiel hat den Spoiler Log angesehen.',
        'mystery' => 'Dies ist ein geheimnissvolles Spiel. Die Einstellungen sind unbekannt und müssen beim Spielen herausgefunden werden!',
        'logic' => __('randomizer.glitches_required.title'),
        'accessibility' => __('randomizer.accessibility.title'),
        'build' => 'ROM build',
        'difficulty' => __('randomizer.difficulty.title'),
        'variation' => __('randomizer.variation.title'),
        'shuffle' => __('randomizer.entrance_shuffle.title'),
        'mode' => __('randomizer.world_state.title'),
        'weapons' => __('randomizer.weapons.title'),
        'goal' => __('randomizer.goal.title'),
        'permalink' => 'Permalink',
        'special' => 'Spezial',
        'notes' => 'Notizen',
        'generated' => 'Erstellt',
    ],
    'settings' => [
        'heart_speed' => 'Geschwindigkeit des Warnungston bei wenig Leben',
        'heart_speeds' => [
            'off' => 'Aus',
            'double' => 'Doppelte Geschwindigkeit',
            'normal' => 'Normale Geschwindigkeit',
            'half' => 'Halbe Geschwindigkeit',
            'quarter' => 'Viertel Geschwindigkeit',
        ],
        'menu_speed' => 'Menü Geschwindigkeit',
        'menu_speeds' => [
            'instant' => 'Instant',
            'fast' => 'Schnell',
            'normal' => 'Normal',
            'slow' => 'Langsam',
        ],
        'heart_color' => 'Farbe der Herzen',
        'heart_colors' => [
            'blue' => 'Blau',
            'green' => 'Grün',
            'red' => 'Rot',
            'yellow' => 'Gelb',
            'random' => 'Zufällig',
        ],
        'play_as' => 'Spiele als',
        'sprite_file_select' => '.zspr Datei auswählen',
        'msu1resume' => 'MSU-1 Resume',
        'shuffle_sfx' => 'SFX Shuffle',
        'music' => 'Hintergrundmusik',
        'music_info' => '(setze zu "Keine" für <a href="https://alttprlinks.page.link/SjiP" target="_blank" rel="noopener noreferrer">MSU-1 Support</a>)',
        'quickswap' => 'Gegenstand Schnellwechsel',
        'palette_shuffle' => 'Palette Shuffle',
        'race_warning' => 'Funktioniert nicht in einer ROM für Rennen',
        "reduce_flashing" => "Blitzeffekte reduzieren",
        "reduce_flashing_warning" => "Diese Option reduziert die Intensität von Blitzeffekten. Individuelle Lichtempfindlichkeitsreaktionen sind nicht ganz ausgeschlossen."
    ],
];

<?php
return [
    'header' => 'Start Your Adventure!',
    'subheader' => 'Want to test your skills in a shuffled Hyrule? You’ve come to the right place!',
    'cards' => [
        'discord' => [
            'header' => '1. Join our Discord Community',
            'content' => [
                '<div class="center"><a class="btn btn-primary btn-lg btn-xl" href="https://discord.gg/alttprandomizer" rel="noopener noreferrer"role="button" target="_blank">' . __('navigation.discord') . '</a></div>',
                'Join our Discord community! We’ve got friendly and helpful people, community event news, ALttP: Randomizer updates, helpful guides, tips and tricks, and more! Come say hello!',
            ]
        ],
        'rom' => [
            'header' => '2. Get the ROM',
            'content' => [
                'You’ll need the base ROM. This should be a <span class="font-weight-bold">Zelda no Densetsu: Kamigami no Triforce v1.0</span> ROM. Don’t worry if you can’t read Japanese; the patching process provides English text while keeping the glitches unique to the original version intact.',
                'One can verify they have the correct rom on this <a href="http://alttp.mymm1.com/game/checkcrc/" target="_blank" rel="noopener noreferrer">site</a>.',
                'If you run into trouble, ask in <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a>!',
            ]
        ],
        'randomize' => [
            'header' => '3. Choose Your Game Options',
            'content' => [
                'Head on over to <a href="/randomizer" target="_blank" rel="noopener noreferrer">' . __('navigation.randomizer') . '</a> and provide your ROM. The next screen will show a variety of game options. For your first few runs, we recommend using “' . __('randomizer.preset.options.beginner') . '” in the “' . __('randomizer.preset.title') . '” and leaving the rest of the settings as is. Then click “' . __('randomizer.generate.race') . '” and you’ll be given a newly minted randomized game!',
                'A more in-depth guide to all the available options can be found <a href="/options">here</a>.',
            ]
        ],
        'emulator' => [
            'header' => '4. Get a Way to Play',
            'content' => [
                'First, you’ll need something to run your newly minted game on. We recommend using an emulator. An emulator is a program that closely replicates SNES hardware, allowing you to run SNES games on your computer. You can get the recommended emulator, SNES9x, at their website <a href="http://www.snes9x.com/" target="_blank" rel="noopener noreferrer">here</a>.',
                'While you can play using only your keyboard, a controller makes for a better experience. While most USB controllers will work, we recommend an <a href="https://www.amazon.com/dp/B002B9XB0E" target="_blank" rel="noopener noreferrer">iBuffalo Classic USB Gamepad</a> or an <a href="https://www.amazon.com/dp/B074HBQ78V" target="_blank" rel="noopener noreferrer">8Bitdo SF30 Wireless Bluetooth Controller</a>.',
                'There are other supported ways to play, including on original SNES hardware. There are also certain emulators, such as zsnes, that won’t work correctly with the randomizer. Join us on <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a> to learn more!',
                'NOTE FOR SNESMINI PLAYERS: Rename your ROM file to have 61 characters or fewer as the SNESMini can’t handle long file names.',
            ]
        ],
        'play' => [
            'header' => '5. Get Playing!',
            'content' => [
                'You’re finally ready to go! The best way to learn is to load up your new ROM and start playing. If you feel like you’re stuck, check out this list of common pitfalls, or ask on <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a>.',
                '<ul>'
                    . '<li>You can use the Y button to swap between Silver Arrows and Normal Arrows, the Red and Blue Boomerangs, the Mushroom and the Magic Powder, and the Shovel and the Flute.</li>'
                    . '<li>You can save and quit with either the Frog or Purple Chest following you to bring it back to the light world without the Mirror.</li>'
                    . '<li>In the dark world, you can hookshot over the river north of the pyramid. Look for the arrow made out of grass!</li>'
                    . '<li>You can use the boots to dash into walls, blocks, and pots, knocking you backwards, in order to cross a gap.</li>'
                    . '<li>If you find yourself at bumper cave with the Cape but without the Hookshot, try walking over the top left of the gap—no Hookshot needed!</li>'
                    . '<li>Keys might not be accessible if they are not required to finish the game. For instance, the Skull Woods big key might be in the big chest.</li>'
                    . '</ul>',
                'Don’t forget to check out the comprehensive <a href="/resources">' . __('navigation.resources') . '</a> with tutorials and more tips!',
            ]
        ],
    ],
];

<?php
return [
    'header' => 'Options',
    'subheader' => 'Les nombreuses manières de jouer',
    'cards' => [
        'glitches_required' => [
            'header' => __('randomizer.glitches_required.title'),
            'sections' => [
                [
                    'header' => __('randomizer.glitches_required.options.none'),
                    'content' => [
                        'Ce mode ne nécessite aucune connaissance particulière.',
                        'Vous ne pourrez jamais vous retrouver bloqués, qu’importe la manière dont vous utilisez vos petites clés dans les donjons.',
                        'Vous aurez peut-être besoin de sauvegarder et de quitter à certains moments, comme pour revenir dans le monde de lumière si vous n’avez pas trouvé le miroir.',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.overworld_glitches'),
                    'content' => [
                        'Ce mode de jeu vous demandera de connaître la plupart des glitchs, à l’exception des plus compliqués. Précisément, cette logique de jeu prévoit que le joueur est capable d’exécuter les glitchs suivants :',
                        '<ul>'
                            . '<li>Boot Clipping (sortir des limites grâce aux bottes)</li>'
                            . '<li>Mirror Clipping (sortir des limites grâce au miroir)</li>'
                            . '<li>Fake Flippers (nager sans les palmes)</li>'
                            . '<li>Bunny Revival (annuler l’état de lapin pour redevenir Link)</li>'
                            . '<li>Super Bunny (récupérer certaines capacités lorsque Link est en lapin)</li>'
                            . '<li>Surfing Bunny (marcher sur l’eau profonde en lapin)</li>'
                            . '<li>Walk on Water (marcher sur l’eau, tout court)</li>'
                            . '</ul>',
                        'Ce mode de jeu ne prend PAS en compte les choses suivantes :',
                        '<ul>'
                            . '<li>Bootless Clipping (sortir des limites sans les bottes, notamment en intérieur)</li>'
                            . '<li>YBA (utiliser une potion pour déclencher la flûte ou faire défiler l’écran)</li>'
                            . '<li>Hovering (flotter à l’aide des bottes)</li>'
                            . '<li>Naviguer les salles obscures sans lanterne</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.major_glitches'),
                    'content' => [
                        'Dans cette logique, nous supposons que vous maîtrisez tous les glitchs du jeu, à l’exception de l’Exploration Glitch. Ce mode de jeu est très difficile et présente également les modifications suivantes :',
                        '<ul>'
                            . '<li>Le faux monde des ténèbres n’est plus corrigé. Les cristaux apparaîtront toujours, ce qui peut entrer en conflit avec les pendentifs.</li>'
                            . '<li>Le niveau de l’eau dans Swamp Palace ne redescend pas si vous sortez du donjon, sauf si vous le faites depuis la première salle.</li>'
                            . '<li>Sauvegarder dans le monde des ténèbres vous renverra systématiquement à la pyramide si Agahnim a été battu.</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.no_logic'),
                    'content' => [
                        'Les items peuvent être véritablement n’importe où et aucune sécurité n’est en place, bonne chance.',
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
                        'Comme dans le jeu de base, votre objectif est d’obtenir les 7 cristaux pour aller affronter Ganon.',
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
                        'Vous devrez battre les boss de chaque donjon, y compris les deux apparitions d’Agahnim, avant de pouvoir vous confronter à Ganon.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.pedestal'),
                    'content' => [
                        'Rassemblez les trois pendentifs et récupérez la Triforce au piédestal des bois perdus ! Vous aurez sans doute besoin de parcourir tout Hyrule pour y parvenir, et peut-être même de visiter la tour de Ganon.',
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
                        'Calqué sur le jeu de base : Link commence l’aventure dans son lit, reçoit une arme de son oncle (selon le paramétrage des épées, voir ci-dessous) et doit secourir la princesse Zelda avant de pouvoir continuer.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.open'),
                    'content' => [
                        'Dans ce mode de jeu vous débutez de la maison de Link ou au sanctuaire (au choix) et vous n’êtes pas obligés de compléter la séquence d’introduction avant de parcourir le monde d’Hyrule. Quelques points à noter :',
                        '<ul>'
                            . '<li>L’oncle de Link est déjà dans les égouts et possède un item.</li>'
                            . '<li>Aucune salle obscure n’est éclairée, pas même les égouts.</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.inverted'),
                    'content' => [
                        'Fatigué de la progression classique ? Nous avons le mode de jeu idéal pour vous !',
                        'En inversé, Link débutera dans le monde des ténèbres pour terminer dans le monde de lumière.',
                        'C’est un mode de jeu assez difficile que nous ne recommandons pas aux nouveaux joueurs : les ennemis du monde des ténèbres font très mal, surtout quand on a que 3 cœurs ...',
                        'Dans les faits, ce mode de jeu apporte de nombreuses modifications :',
                        '<ul>'
                            . '<li>La maison de Link remplace le magasin de bombes du monde des ténèbres, et réciproquement.</li>'
                            . '<li>Le ' . __('item.MagicMirror') . ' vous transporte du monde de la lumière vers celui des ténèbres.</li>'
                            . '<li>La ' . __('item.OcarinaInactive') . ' ne fonctionne que dans le monde des ténèbres, mais devra quand même s’activer dans le monde de lumière.</li>'
                            . '<li>Des modifications ont été apportées au terrain pour vous permettre d’atteindre certains endroits du monde de lumière qui nécessitaient le ' . __('item.MagicMirror') . '</li>'
                            . '<li>Le vieil homme est maintenant perdu dans le monde des ténèbres, mais vous devrez le reconduire chez lui, dans le monde de lumière.</li>'
                            . '<li>Les portails qui menaient au monde des ténèbres n’ont pas bougés, mais sont maintenant dans le monde des ténèbres et nécessitent les mêmes items pour les atteindre.</li>'
                            . '<li>Agahnim a quitté le château d’Hyrule pour s’installer sur la montagne de la mort et a “oublié” d’en protéger l’accès. Oh, nous avons également ajouté des escaliers pour atteindre la montagne de la mort facilement dans le monde des ténèbres.</li>'
                            . '<li>Suite à ce déménagement, la tour de Ganon a maintenant pris la place du château d’Hyrule, mais il vous faudra toujours 7 cristaux pour y pénétrer.</li>'
                            . '<li>Le mur de Ice Palace est tombé, vous pourrez simplement y accéder à la nage.</li>'
                            . '<li>Le sommet de Turtle Rock peut être atteint en escaladant simplement la queue de la tortue.</li>'
                            . '<li>N’oubliez pas qu’un lapin est parfaitement capable de lire le ' . __('item.BookOfMudora') . ', ou d’interagir avec le monde qui l’entoure...</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.retro'),
                    'content' => [
                        'Basé sur le premier Legend of Zelda sur NES, cette variante implique de nombreux changements.',
                        [
                            'header' => 'Un Arc Coûteux',
                            'content' => [
                                'L’arc n’utilise plus des flèches mais des rupees !',
                                'Tirer une flèche en bois vous coûte 10 rupees, tandis qu’une flèche d’argent vous en coûte 50.',
                                'De plus, l’arc n’est fourni avec aucune munition : vous devrez trouver les flèches d’argent, ou acquérir les flèches de bois auprès d’un marchand pour pouvoir l’utiliser.',
                            ],
                        ],
                        [
                            'header' => 'Magasins',
                            'content' => [
                                'Cinq magasins sur un total de neuf posséderont un inventaire différent du jeu de base (le magasin de bombe et celui de la sorcière ne seront jamais modifiés). Ces nouveaux magasins proposeront les flèches de bois pour 80 rupees ainsi que des petites clés pour 100 rupees l’unité. Vous pourrez acheter autant de petite clé que vous le souhaitez.',
                            ],
                        ],
                        [
                            'header' => 'Petites clés',
                            'content' => [
                                'Les petites clés ne sont plus liées à leur donjon respectif et peuvent être trouvées partout dans le monde d’Hyrule. Les clés disponibles sous les pots ou qui apparaissent à la mort d’ennemis n’ont en revanche pas bougées.',
                                '10 petites clés ont été retirées en difficulté Facile et Normale ; 15 en Difficile, Expert et Infernal. Vous devrez réfléchir avant d’utiliser vos clés, mais n’oubliez pas que vous pourrez en acheter en cas de besoin.',
                            ],
                        ],
                        [
                            'header' => 'Cavernes à Choix',
                            'content' => [
                                'Quatre maisons et cavernes qui ne mènent d’ordinaire à aucun item sont sélectionnées aléatoirement pour être remplacées par des cavernes à choix. À l’intérieur de celles-ci, le joueur aura le choix entre un réceptacle de cœur ou une potion bleue à boire immédiatement. Cela signifie qu’il y a plus de réceptacle de cœur que d’ordinaire, mais vous ne pourrez jamais avoir plus de 20 cœurs au total malgré tout.',
                                'Une caverne ou maison supplémentaire vous mènera à un vieil homme mystérieux qui vous confiera une épée, mais le nombre d’épées dans le pool ne change pas.',
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
                        'Mélange les entrées des donjons entre elles. Si un donjon possède plusieurs entrées elles sont mélangées de telle sorte qu’elles restent toute dans la même zone.',
                        'À l’exception de la montagne de la mort côté monde de lumière ou le mélange est plus permissif, les intérieurs sont également mélangés mais sont reliés au même endroit extérieur.',
                    ],
                ],
                'restricted' => [
                    'header' => __('randomizer.entrance_shuffle.options.restricted'),
                    'content' => [
                        'Les entrées de donjons sont mélangées comme dans le mélange simple, mais les autres entrées sont connectées plus librement. Si une zone possède plusieurs entrées, elles sont toutes dans le même monde.',
                    ],
                ],
                'full' => [
                    'header' => __('randomizer.entrance_shuffle.options.full'),
                    'content' => [
                        'Mélange les entrées de cavernes et de donjons entre elles. Si une zone possède plusieurs entrées, elles sont toutes dans le même monde.',
                    ],
                ],
                'crossed' => [
                    'header' => __('randomizer.entrance_shuffle.options.crossed'),
                    'content' => [
                        'Mélange les entrées de cavernes et de donjons entre elles, mais les zones peuvent maintenant se croiser entre monde des ténèbres et monde de lumière.',
                    ],
                ],
                'insanity' => [
                    'header' => __('randomizer.entrance_shuffle.options.insanity'),
                    'content' => [
                        'Sépare les entrées et les sorties des zones et mélange le tout. Les cavernes qui ne possèdent qu’une seule entrée dans le jeu de base ressortent quand même au même endroit.',
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
                'header' => 'Comparaison de difficulté',
                'maximum_health' => 'Santé maximale',
                'heart_containers' => 'Réceptacles de coeur',
                'heart_pieces' => 'Quarts de coeur',
                'maximum_mail' => 'Meilleure Tunique',
                'number_in_pool' => '# disponibles',
                'maximum_sword' => 'Meilleure Épée',
                'maximum_shield' => 'Meilleur Bouclier',
                'shields_store' => 'Boucliers achetables ?',
                'maximum_magic' => 'Magie maximale',
                'number_silvers' => 'Flèches d’Argent',
                'number_silvers_swordless' => 'Flèches d’Argent (sans épée)',
                'number_bottles' => 'Flacons',
                'number_lamps' => 'Lanternes',
                'potion_magic' => 'Soin des potions de magie',
                'potion_health' => 'Soin des potions de santé',
                'bug_net_fairy' => 'Fées Capturables ?',
                'powder_bubble' => 'Poudre sur les Antifées',
                'cape_consumption' => 'Consommation de la Cape',
                'byrna_invincible' => 'Byrna rend invincible ?',
                'stun_boomerang' => 'Les Boomerangs étourdissent ?',
                'stun_hookshot' => 'Le Grappin étourdit ?',
                'capacity_upgrade' => 'Extensions de Carquois & de Sac de Bombes',
                'drop_rates' => 'Chance de drop des ennemis',
                'quarter' => 'Quart',
                'half' => 'Moitié',
                'normal' => 'Normal',
                'shield_3' => 'Miroir',
                'shield_2' => 'Feu',
                'shield_1' => 'Simple',
                'none' => 'Aucun',
                'sword_4' => 'Or',
                'sword_3' => 'Trempée',
                'sword_2' => 'Master Sword',
                'mail_3' => 'Rouge',
                'mail_2' => 'Bleue',
                'mail_1' => 'Verte',
                'fairy' => 'Fée',
                'heart' => 'Cœur',
                'bee' => 'Abeilles',
                'yes' => 'Oui',
                'no' => 'Non',
                'tooltip' => [
                    'silvers' => 'Les flèches d’argent ne fonctionnent que dans la pyramide de Ganon.',
                    'bottles' => 'Une fois que 4 bouteilles ont été collectées, les bouteilles restantes deviendront des rubis.',
                    'potion_magic' => 'Les potions rempliront 100% de magie dans Spike Cave.',
                    'potion_health' => 'Les potions rempliront 20 coeurs à Spike Cave.',
                ],
            ],
        ],
        'weapons' => [
            'header' => __('randomizer.weapons.title'),
            'sections' => [
                [
                    'header' => __('randomizer.weapons.options.randomized'),
                    'content' => [
                        'Toutes les améliorations d’épées sont aléatoires. Vous commencerez sans épée et il peut se passer du temps avant que vous en trouviez une. Utilisez des bombes, des buissons ou mêmes des panneaux pour vous défendre jusqu’à tomber sur une arme plus efficace.',
                        'Si cette option est combinée au mode ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . ' (voir ci-dessus), votre oncle vous offrira un des items suivants pour vous permettre de finir la séquence d’introduction :',
                        '<ul>'
                            . '<li>Épée (oui, c’est possible !)</li>'
                            . '<li>Marteau</li>'
                            . '<li>Arc, avec un plein de flèches</li>'
                            . '<li>Un plein de Bombes</li>'
                            . '<li>Baguette de Feu, avec un plein de magie</li>'
                            . '<li>Canne de Somaria, avec un plein de magie</li>'
                            . '<li>Canne de Byrna,  avec un plein de magie</li>'
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
                        'Il n’y a aucune épée dans le jeu ! Cela implique quelques changements :',
                        '<ul>'
                            . '<li>Les épées ont été remplacées par des 20 rupees (verts).</li>'
                            . '<li>La barrière de la tour d’Agahnim peut être détruite avec le marteau.</li>'
                            . '<li>Le rideau à la fin de la tour d’Agahnim est déjà ouvert, tout comme les lierres de Skull Woods.</li>'
                            . '<li>Les médaillons ne sont utilisables que pour ouvrir Misery Mire et Turtle Rock, ou pour progresser à l’intérieur de Ice Palace. En temps normal, ils nécessitent une épée.</li>'
                            . '<li>Ganon prend maintenant des dégâts du marteau.</li>'
                            . '<li>Les flèches d’argent sont disponibles dans tous les modes de difficultés.</li>'
                            . '<li>Les stèles d’Ether et de Bombos nécessitent le livre de Mudora et le marteau.</li>'
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
        'item_pool' => 'Groupe d’objets',
    ],
];

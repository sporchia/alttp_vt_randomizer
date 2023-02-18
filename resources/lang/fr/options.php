<?php
return [
    'header' => 'Options du Randomiseur',
    'subheader' => 'Il y a beaucoup de façons de jouer à ALttP:Randomizer!',
    'cards' => [
        'glitches_required' => [
            'header' => __('randomizer.glitches_required.title'),
            'sections' => [
                [
                    'header' => __('randomizer.glitches_required.options.none'),
                    'content' => [
                        'Ce paramètre ne demande la connaissance d’aucun glitch ou technique.',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.overworld_glitches'),
                    'content' => [
                        'Ce paramètre demande la connaissance de certains glitchs majeurs (dans le mond extérieur) ainsi que la connaissance de la plupart des glitchs mineurs. Plus spécifiquement:',
                        '<ul>'
                            . '<li>Clip aux Bottes (Monde extérieur)</li>'
                            . '<li>Clip au Miroir (Monde extérieur)</li>'
                            . '<li>Résurrection du Lapin en donjon</li>'
                            . '<li>Super Lapin</li>'
                            . '<li>Lapin Surfeur</li>'
                            . '<li>Marche sur l’Eau</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.hybrid_major_glitches'),
                    'content' => [
                        'Ce paramètre requiert la connaissance de tous les glitchs du monde extérieur, ainsi que des glitchs dans le monde inférieur qui peuvent clipper dans d’autres donjons, plus particulièrement:',
                        '<ul>'
                            . '<li>les clips d’Underworld sans les bottes (y compris les clips d’1 frame qui demandent du buffering)</li>'
                            . '</ul>',
                        'Quelques changements additionnels ont été faits:',
                        '<ul>'
                            . '<li>Les "faux mondes" existent à nouveau, comme dans le jeu original (Exemple : Mourir dans un donjon du monde des Ténèbres sans avoir défait Aganhim vous mettra dans le Faux Monde des Ténèbres)</li>'
                            . '<li>Les Cristaux vont toujours apparaître, malgré les conflits de pendentifs (correction du jeu original pour la qualité de vie)</li>'
                            . '<li>Les niveaux d’eau de Swamp Palace ne se re-drainent plus quand vous quittez l’écran du Monde Extérieur (sauf la première pièce)</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.major_glitches'),
                    'content' => [
                        'Ce paramètre requiert la connaissance de glitchs plus avancés. Spécifiquement:',
                        '<ul>'
                            . '<li>Fausses flûtes (Monde Extérieur) (voir YBA)</li>'
                            . '<li>Wraps d’écrans (Monde Extérieur)</li>'
                            . '<li>Clips sans Bottes (inclut Clip d’Une Image) (Monde Extérieur et Inférieur)</li>'
                            . '</ul>',
                        'Quelques changements additionnels ont été faits:',
                        '<ul>'
                            . '<li>Les "faux mondes" existent à nouveau, comme dans le jeu original (Exemple : Mourir dans un donjon du monde des Ténèbres sans avoir défait Aganhim vous mettra dans le Faux Monde des Ténèbres)</li>'
                            . '<li>Crystals always drop regardless of pendant conflicts (QoL fix from the original)Les Cristaux vont toujours apparaître, malgré les conflits de pendantifs (correction du jeu original pour la qualité de vie)</li>'
                            . '<li>Les niveaux d’eau de Swamp Palace ne se re-drainent plus quand vous quittez l’écran du Monde Extérieur (sauf la première piece)</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.no_logic'),
                    'content' => [
                        'Aucune logique n’est appliquée, rien du tout. Les objets peuvent être n’importe où. Il peut être impossible d’obtenir des objets, mais, grâce à la force des Glitchs Majeurs, il est extrêmement rare qu’un jeu ne puisse être battu. Ce paramètre requiert généralement un usage extensif de glitchs normalement exclus des règles des autres logiques (notamment, l’EG, les Door Glitches et la Résurrection du Lapin en Extérieur).',
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
                        'Ce paramètre est conçu pour des joueurs plus nouveaux, ou recherchant une expérience de détente. Il existe des restrictions de logique supplémentaires afin d’éviter le placement d’objets à des endroits requiérant des connaissances trop spécifiques pour être accédés (Exemple: la Bumper Cave sans le Grappin). Le jeu s’assure également d’éviter une exécution trop compliquée pour progresser. Par exemple, si vous devez finir un donjon du Monde des Ténèbres qui est normalement parmi les derniers, vous aurez toujours accès à des améliorations d’épées ou de défense quelque part dans le monde.',
                    ],
                ],
                [
                    'header' => __('randomizer.item_placement.options.advanced'),
                    'content' => [
                        'Ce paramètre est conçu pour des joueurs plus réguliers, et les coureurs. L’intention de ce paramètre est de maximiser les possibilités d’objets pouvant être atteints sans glitchs. Seule une exception est faite, les pièces noires ne sont pas requises. Aucune autre exception n’est faite regardant la possibilité d’un objet finissant dans un endroit obscur, ou la difficulté à atteindre un emplacement. Il est attendu qu’un joueur qui choisit ce paramètre est suffisamment familiarisé et expérimenté avec le jeu original.',
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
                        'Lorsque les cartes sont déplacées hors des donjons, la carte du Monde ne renseignera plus sur les prix (cristaux/pendantifs) des donjons sans avoir la carte du donjon. Cependant, les cartes sont toujours requises par la logique, que la logique de placement des objets soit Basique ou Avancée. Notez que le boss d’un donjon peut tenir sa propre carte.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.standard'),
                    'content' => [
                        'Les objets propres aux donjons sont randomisés, mais toujours dans leur donjon d’origine.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mc'),
                    'content' => [
                        'Seules les clefs restent randomisées à l’intérieur de leurs donjons spécifiques. Les cartes et boussoles peuvent finir n’importe où, y compris parfois dans leur donjon d’origine.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mcs'),
                    'content' => [
                        'Seules les grandes clefs restent randomisées à l’intérieur de leurs donjons spécifiques. Les petites clefs, cartes et boussoles peuvent finir n’importe où, y compris parfois dans leur donjon d’origine.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.full'),
                    'content' => [
                        'Les cartes, boussoles, petites et grandes clefs peuvent se retrouver n’importe où dans le monde L’aléatoire peut décider malgré tout de placer l’une ou l’autre dans son donjon d’origine.',
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
                        'Ce paramètre s’assure que tous les objets de l’inventaire peuvent être obtenus, mais peut décider d’enfermer l’une ou l’autre clef. Par exemple, des grandes clefs non requises peuvent être dans le grand coffre, ou certaines petites clefs peuvent être derrière des portes à clefs (que vous pourriez accéder, ou pas, selon votre usage personnel). En pratique, quasi l’entièreté du monde devrait être accessible, avec ce paramètre.',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.locations'),
                    'content' => [
                        'Ce paramètre s’assure que vous puissiez toujours atteindre les 216 emplacements du jeu, peu importe si les clefs sont usées de façon non efficace dans les donjons. Plus spécifiquement, les grandes clefs ne seront jamais dans leur propre grand coffre, et certains coffres derrière des portes à clefs ne contiendront pas de petite clef.',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.none'),
                    'content' => [
                        'Ce paramètre s’assure seulement de la complétion du jeu. Vous pouvez ne pas être capable de trouver un objet non requis (par exemple, la Baguette de Feu si elle n’est pas requise) ou d’entrer un donjon non requis.',
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
                        'Ce paramètre requiert la complétion de la Tour de Ganon en plus de défaire Ganon. Le nombre de cristaux requis pour la Tour de Ganon dépend d’un autre paramètre.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.fast_ganon'),
                    'content' => [
                        'Ce paramètre demande seulement de défaire Ganon, sans la complétion de la Tour de Ganon. Pour que cela fonctionne, le trou au sommet de la Pyramide existe toujours (sauf si vous jouez un Randomiseur d’Entrées). Le nombre de cristaux requis pour battre Ganon dépend d’un autre paramètre.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.dungeons'),
                    'content' => [
                        'Ce paramètre requiert la complétion de tous les donjons. Ceci inclut les 3 donjons du Monde de la Lumière, les 7 du Monde des Ténèbres, la Tour d’Aganhim et la Tour de Ganon.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.pedestal'),
                    'content' => [
                        'Ce paramètre requiert la collection des trois pendantifs, afin de tirer la Triforce dans le Piédestal dans les Bois Perdus. ',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.triforce-hunt'),
                    'content' => [
                        'La Triforce a été brisée en 30 morceaux, éparpillés à travers Hyrule! Vous devez retrouver 20 des 30 pièces, et les emmener à Murahdhala pour recevoir la Triforce. Qui est ce Murahdahla, me direz-vous? Mais enfin, il est évidemment le petit frère de Sahasrahla et Aginah! De retour de ses vacances à Lorule, vous le trouverez dans la cour du Château d’Hyrule.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.ganonhunt'),
                    'content' => [
                        'The Triforce has been shattered into 50 pieces and scattered throughout Hyrule! You must first collect 40 of the 50 pieces, and only then will Ganon be vulnerable to your attacks!  Like Fast Ganon, the hole leading to Ganon has been made permanently accessible.  This goal is not available if entrances are randomized.',
                    ],
                ],
            ],
        ],
        'tower_open' => [
            'header' => __('randomizer.tower_open.title'),
            'content' => [
                'Ce paramètre vous laisse choisir le nombre de cristaux requis pour ouvrir la Tour de Ganon. Si vous choisissez 0, alors la Tour est accessible sans rien. Si vous choisissez "Aléatoire", alors il y aura un panneau devant la Tour vous indiquant combien de cristaux sont requis. En mode Inversé, le panneau sera en dehors du Château d’Hyrule, en toute accordance.',
            ],
        ],
        'ganon_open' => [
            'header' => __('randomizer.ganon_open.title'),
            'content' => [
                'Ce paramètre vous laisse choisir le nombre de cristaux requis pour que Ganon soit vulnérable à vos attaques! Si vous choisissez 0, alors il peut être battu dès que vous le trouvez. Si Aléatoire est choisi, alors un panneau vous informera du nombre requis sur la Pyramide. En mode Inversé, ce panneau se trouvera au Château d’Hyrule, en toute accordance.',
            ],
        ],
        'world_state' => [
            'header' => __('randomizer.world_state.title'),
            'sections' => [
                [
                    'header' => __('randomizer.world_state.options.standard'),
                    'content' => [
                        'Ce paramètre est le plus semblable au jeu original. Il maintient le prologue original, le sauvetage de Zelda dans le Château d’Hyrule, et votre parcours avec elle jusqu’au Sanctuaire. Ceci doit être fait afin de gagner votre accès au reste de Hyrule. Votre oncle vous donnera toujours un objet pour vaincre les ennemis du château (mais pas forcément une épée). Les égouts seront éclairés par Zelda jusqu’au sanctuaire, mais toute visite plus tard dans le jeu demandera la Lampe pour voir dans le noir, et ceci inclut les Egouts.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.open'),
                    'content' => [
                        'Ce paramètre démarre le jeu comme si le prologue a déjà été accompli. Zelda est déjà sauvée, et vous pouvez démarrer à la maison de Link ou au Sanctuaire. Aucun coffre de Hyrule n’est ouvert, à vous de décider lesquels visiter, et à quel moment.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.inverted'),
                    'content' => [
                        'Ce paramètre place Link dans le Monde des Ténèbres dès le début, vous devrez trouver Ganon dans le Monde de la Lumière! Plusieurs changements ont été faits pour que ce mode fonctionne mieux:',
                        '<ul>'
                            . '<li>Les Tours de Ganon et d’Aganhim ont échangé de place.</li>'
                            . '<li>Ganon a abandonné la Pyramide, et vit sous le Château d’Hyrule.</li>'
                            . '<li>Les portails vous emmènent désormais, depuis le Monde des Ténèbres, vers le Monde de la Lumière.</li>'
                            . '<li>Link sera un Lapin dans le Monde de la Lumière s’il n’a pas la Perle de Lune.</li>'
                            . '<li>Le Miroir Magique vous emmène désormais, depuis le Monde de la Lumière, vers le Monde des Ténèbres.</li>'
                            . '<li>Les cristaux ouvrent désormais la porte menant à la Tour d’Aganhim. La Tour de Ganon est ouverte.</li>'
                            . '</ul>',
                        'Quelques autres modifications ont été faites afin que le jeu fonctionne proprement:',
                        '<ul>'
                            . '<li>La maison de Link et le marchand de bombes ont échangé de place.</li>'
                            . '<li>La flûte ne fonctionne que dans le Monde des Ténèbres. Elle s’active toujours à son emplacement original.</li>'
                            . '<li>Beaucoup d’emplacements dans le Monde de la Lumière ont été retravaillés afin de leur donner un accès, puisqu’ils ne peuvent plus être accédés avec le Miroir.</li>'
                            . '<li>Les grottes de la Montagne de la Mort ont été changées. Vous pouvez désormais accéder la Montagne de la Mort des Ténèbres depuis le reste du Monde des Ténèbres. </li>'
                            . '<li>Le Vieil Homme de la Montagne de la Mort est dans le Monde des Ténèbres. Vous devrez l’emmener à sa maison dans le Monde de la Lumière.</li>'
                            . '<li>La Montagne de la Mort des Ténèbres a quelques escaliers supplémentaires pour accéder la Tour de Ganon et à sa section est.</li>'
                            . '<li>Les murs de Ice Palace ont fondu, laissant un accès libre depuis le Monde des Ténèbres.</li>'
                            . '<li>Vous pouvez monter sur Turtle Rock en sautant sur sa queue!</li>'
                            . '</ul>',
                        'Gardez à l’esprit que Link le Lapin peut utiliser le Libre de Mudora, parler à des PNJs, et ramasser des objets simplement sur le sol. Les jeux inversés peuvent être <strong>vraiment difficiles</strong>, et ne sont donc pas une recommandation pour une première fois.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.retro'),
                    'content' => [
                        'Ce paramètre renvoie à la nostalgie du premier jeu The Legend of Zelda! Il change notamment:',
                        [
                            'header' => 'Arc à Rubis',
                            'content' => [
                                '<ul>'
                                    . '<li>L’Arc n’use plus de flèches, mais des rubis!!</li>'
                                    . '<li>Le premier Arc progressif ne tire que des flèches en bois.</li>'
                                    . '<li>Le second Arc progressif peut tirer des flèches en bois ou en argent.</li>'
                                    . '<li>Cependant, aucun arc ne peut être utilisé avant d’acheter un Carquois à Rubis.</li>'
                                    . '<li>Le Carquois à Rubis apparaît dans un magasin aléatoire, pour la modique somme de 80 rubis!</li>'
                                    . '<li>Chaque flèche en bois coûte 10 rubis, tandis qu’une flèche d’argent coûte 50 rubis..</li>'
                                    . '</ul>',
                            ],
                        ],
                        [
                            'header' => 'Magasins',
                            'content' => [
                                'Cinq des neufs magasins du jeu sont choisis pour avoir de nouveaux objets. Ceci n’inclut pas le Magasin de Bombes ni celui de Potions. L’un deux contiendra le Carquois à Rubis pour 80 rubis. Additionnellement, plusieurs magasins vendront des petites clefs pour le prix de 100 rubis, sans limite d’achat.',
                            ],
                        ],
                        [
                            'header' => 'Petites Clefs',
                            'content' => [
                                'Les petites clefs deviennent génériques : Elles ne sont plus attachées à un donjon, elles peuvent être utilisées n’importe où. Elles pevent également être trouvées n’importe où (par exemple, dans le monde extérieur). Les clefs sous les pots et tenues par des ennemis sont inchangées. Dix clefs sont retirées, relativement à la quantité normale (15 clefs si vous jouez en Difficile ou plus). Les grandes clefs, cartes, boussoles sont toujours dans leur donjon de base.',
                            ],
                        ],
                        [
                            'header' => 'Grottes à Choix',
                            'content' => [
                                'Cinq grottes ne menant nulle part (une seule entrée et aucun objet à l’intérieur) sont désormais des Grottes à Choix. Quatre de ces grottes proposent un Réceptacle de Cœur ou une potion bleue, et la cinquième possède une amélioration d’épée (qui ne sera pas disponible ailleurs). Cela signifie qu’il n’y aura que trois épées parmi les objets randomisés. Les Réceptacles de Cœur, au contraire, sont ajoutés en bonus, mais vous êtes toujours limité à 20 cœurs maximum. La potion bleue requiert une bouteille vide.',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'entrance_shuffle' => [
            'header' => __('randomizer.entrance_shuffle.title'),
            'subheader' => [
                'Ce paramètre randomise les endroits auxquels les entrées mènent. Par exemple, entrer dans le magasin de Kakariko, peut vous emmener dans une fontaine de fées, ou autre chose. Différents types d’entrées sont groupés ensemble, et chaque groupe est ensuite randomisé. La façon dont ces groupes sont sélectionnées dépend du paramètre choisi. Les transitions dans le monde extérieur ne sont jamais aléatoires.',
                'Les grottes/donjons avec plusieurs entrées ont un comportement spécifique, sauf contre-indication:',
                '<ul>'
                    . '<li>Toutes les entrées restent groupées. Cela signifie que sortir d’une grotte ou un donjon vous ramènera à l’emplacement d’entrée.</li>'
                    . '<li>Toutes les entrées pour une grotte ou un donjon qui a plusieurs entrées apparaîtront dans le même monde. (Une grotte ou un donjon ne reliera pas Monde de la Lumière et Monde des Ténèbres).</li>'
                    . '</ul>',
                'La Maison de Link et l’arrière du bar ne sont pas aléatoires. Notez toutefois que si vous jouez en ' . __('randomizer.world_state.options.inverted') . ' ' . __('randomizer.world_state.title') . ', la Maison de Link (dans le monde des Ténèbres) et le magasin de bombes (dans le monde de la Lumière) seront randomisés.',
            ],
            'sections' => [
                'none' => [
                    'header' => __('randomizer.entrance_shuffle.options.none'),
                    'content' => [
                        'Aucune entrée n’est randomisée. Chaque entrée mènera à l’endroit normal.',
                    ],
                ],
                'simple' => [
                    'header' => __('randomizer.entrance_shuffle.options.simple'),
                    'content' => [
                        'Ce paramètre utilise le plus grand nombre de groupements de types d’entrées. Ceci réduit énormément la randomisation, ce qui permet de garder les choses simples.',
                        [
                            'header' => 'Donjons à Une Entrée',
                            'content' => [
                                'Toutes les entrées sont groupées et randomisées ensemble. Ceci inclut la partie finale de Skull Woods (menant au boss), mais pas les autres entrées de Skull Woods.',
                            ],
                        ],
                        [
                            'header' => 'Donjons à Plusieurs Entrées (sauf Skull Woods)',
                            'content' => [
                                'Chacune des 4 entrées du Château d’Hyrule, de Desert palace et de Turtle Rock restent groupées ensemble. Chaque groupe de 4 est randomisé avec les autres en gardant les mêmes positions. Par exemple, si le Château d’Hyrule et Desert Palace sont inversés, l’entrée principale du Château d’Hyrule sera l’entrée principale de Desert Palace, l’entrée gauche de Desert Palace mènera à l’entrée gauche du Château d’Hyrule, etc. Notez que la Tour d\{Aganhim n’est pas randomisée en ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . '.',
                            ],
                        ],
                        [
                            'header' => 'Skull Woods (sauf la section du boss)',
                            'content' => [
                                'Toutes les entrées (incluant les trous) resteront dans la région de Skull Woods et seront mélangées ensemble. Les entrées sont mélangées entre elles, et les trous entre eux.',
                            ],
                        ],
                        [
                            'header' => 'Grottes à Une Entrée',
                            'content' => [
                                'Toutes les entrées sont groupées et mélangées ensemble. Ceci n’inclut pas la Montagne de la Mort du Monde de la Lumière. (Exemple : Maisons).',
                            ],
                        ],
                        [
                            'header' => 'Grottes à Plusieurs Entrées',
                            'content' => [
                                'Toutes les entrées sont groupées et mélangées ensemble. Les emplacements qui ont normalement 2 entrées resteront connectées ensemble avec une grotte à deux entrées (exemple : la maison de l’Ancien dans Kakariko). Ceci n’inclut pas la Montagne de la Mort du Monde de la Lumière.',
                            ],
                        ],
                        [
                            'header' => 'Montagne de la Mort du Monde de la Lumière',
                            'content' => [
                                'Toutes les entrées restent dans la région de la Montagne de la Mort de la Lumière et sont mélangées ensemble. Veuillez noter que l\{accès à la Montagne (où le vieil homme est perdu) n’est pas randomisée non plus.',
                            ],
                        ],
                        [
                            'header' => 'Trous dans le monde Extérieur (sauf Skull Woods)',
                            'content' => [
                                'Tous les trous sont groupés et mélangés ensemble. Leur sortie associée reste attachée à proximité. Par exemple, tomber dans un trou vous mènera à la porte à proximité de ce trou, peu importe les pièces que vous aurez traversées dans ce trou.',
                            ],
                        ],
                    ],
                ],
                'restricted' => [
                    'header' => __('randomizer.entrance_shuffle.options.restricted'),
                    'content' => [
                        'Similaire à ' . __('randomizer.entrance_shuffle.options.simple') . ', sauf que toutes les entrées qui ne sont pas des donjons (grottes à une ou plusieurs entrées, et la Montagne de la Mort de la Lumière) sont groupées et mélangées ensemble. Ceci inclut l’accès à la Montagne de la Mort.',
                    ],
                ],
                'full' => [
                    'header' => __('randomizer.entrance_shuffle.options.full'),
                    'content' => [
                        'Similaire à ' . __('randomizer.entrance_shuffle.options.restricted') . ', sauf que les donjons (à un ou plusieurs entrées) sont désormais aussi groupés avec les entrées qui ne sont pas des donjons et mélangées ensemble.',
                    ],
                ],
                'crossed' => [
                    'header' => __('randomizer.entrance_shuffle.options.crossed'),
                    'content' => [
                        'Smilaire à  ' . __('randomizer.entrance_shuffle.options.full') . ', sauf que les grottes et donjons avec plusieurs entrées ne sont plus limitées à un seul monde. Cela signifie que ceux-ci peuvent servir d’accès entre les Mondes de la Lumière et des Ténèbres.',
                    ],
                ],
                'insanity' => [
                    'header' => __('randomizer.entrance_shuffle.options.insanity'),
                    'content' => [
                        'Similaire à ' . __('randomizer.entrance_shuffle.options.crossed') . ', sauf que toutes les entrées et trous sont découplés (incluant les grottes à une entrée et la zone de Skull Woods). Ceci signifie que sortir de là où vous êtes entré peut mener ailleurs. Cependant, les grottes à une seule entrée vont toujours mener au même endroit en sortant et entrant à nouveau. Les entrées de Skull Woods restent dans la zone de Skull Woods (sauf le donjon final), et les trous ne sont plus couplés avec leur sortie.',
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
                        'Les boss ne sont pas mélangés. Chaque boss sera dans son donjon de base.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.simple'),
                    'content' => [
                        'Tous les boss originaux sont mélangés, incluant les trois revanches de la Tour de Ganon, sauf Aganhim, sa revanche, et Ganon. Cela signifie que vous trouverez deux Armos Knights, Lanmolas et Moldorm, et un de chaque autre boss. La Tour de Ganon peut donc avoir 3 boss aléatoires!',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.full'),
                    'content' => [
                        'Similaire à ' . __('randomizer.boss_shuffle.options.simple') . ', sauf que les 3 boss apparaissant deux fois seront choisis aléatoirement.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.random'),
                    'content' => [
                        'Tous les boss sont aléatoires. Vous pouvez voir le même plusieurs fois, ou ne jamais voir un boss spécifique.',
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
                        'Les ennemis ne sont pas aléatoires. Tous les ennemis restent à leur emplacement original.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.shuffled'),
                    'content' => [
                        'Tous les ennemis sont aléatoires, mais il faut noter quelques points:',
                        '<ul>'
                            . '<li>N’importe quel ennemi ne peut pas apparaître n’importe où, à cause des limitations du jeu.</li>'
                            . '<li>Les pièces où il est requis de tuer des ennemis ne vont jamais demander une arme spécifique (par exemple des Mimiques requérant l’Arc n’apparaîtront pas dans ces pièces.</li>'
                            . '<li>Les Voleurs peuvent maintenant être tués.</li>'
                            . '<li>Les pièces à Tuiles Volantes ne sont pas aléatoires.</li>'
                            . '<li>Les ennemis sous des buissons ne sont pas aléatoires.</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.random'),
                    'content' => [
                        'Similaire à ' . __('randomizer.enemy_shuffle.options.shuffled') . ', sauf que les ennemis sous les buissons, ainsi que leur chance d’apparaître, sont désormais aléatoires. Ceci n’a pas l’air de grand chose, mais peut drastiquement changer l’expérience. En addition, les pièces à Tuiles Volantes ont un dessin aléatoire, et les Voleurs ont 50% de chance d’être tuables ou invincibles.',
                    ],
                ],
            ],
        ],
        'hints' => [
            'header' => __('randomizer.hints.title'),
            'content' => [
                'Active ou désactive la possibilité d’avoir des indices sur les Tuiles Télépathiques à travers le monde.',
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
                'silver' => 'Silver',
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
                    'silvers' => 'Le mode “Sans épée” ne retire par les Flèches d’Argent, mais réduit leur usage à exclusivement la pièce de Ganon.',
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
                        'Les quatre Épées Progressives sont randomisées dans le jeu. Si ce paramètre est combiné avec ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . ', alors votre Oncle aura toujours l’un des objets suivants:',
                        '<ul>'
                            . '<li>Épée (oui, c’est possible !)</li>'
                            . '<li>Marteau</li>'
                            . '<li>Arc, avec un plein de flèches</li>'
                            . '<li>Un plein de Bombes</li>'
                            . '<li>Baguette de Feu, avec un plein de magie</li>'
                            . '<li>Canne de Somaria, avec un plein de magie</li>'
                            . '<li>Canne de Byrna,  avec un plein de magie</li>'
                            . '</ul>',
                        'Si vous tombez à court de magie ou de munitions, alors Sauver et Quitter rendra une part de votre magie ou de vos flèches, afin que vous puissiez progresser.',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.assured'),
                    'content' => [
                        'Link démarre avec une épée déjà equipée! Peut-être était-elle cachée sous son oreiller?',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.vanilla'),
                    'content' => [
                        'Les quatre épées sont à leur emplacement d’origine, c’est-à-dire :',
                        '<ul>'
                            . '<li>L’oncle de Link</li>'
                            . '<li>Le Piédestal de la Master Sword</li>'
                            . '<li>Le Forgeron</li>'
                            . '<li>La Fée de la Pyramide</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.swordless'),
                    'content' => [
                        'Toutes les épées sont retirées du jeu, remplacées par 20 rubis. Plusieurs changements ont été faits pour que ceci fonctionne:',
                        '<ul>'
                            . '<li>Les épées ont été remplacées par des 20 rubis (verts).</li>'
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
                        'La vie des ennemis n’est pas aléatoire.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.easy'),
                    'content' => [
                        'Tous les ennemis auront de 1 à 4 points de vie (1 ou deux coups d’Épée du Combattant).',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.hard'),
                    'content' => [
                        'Tous les ennemis auront de 2 à 15 points de vie (1 à 8 coups d’Épée du Combattant). Notez que en moyenne, ceci donne plus de vie aux ennemis que le jeu original.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.expert'),
                    'content' => [
                        'Tous les ennemis auront de 2 à 30 points de vie (1 à 15 coups d’Épée du Combattant). Presque tous les ennemis auront beaucoup plus de vie que la normale.',
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
                        'Les dégâts causés par les ennemis ne sont pas aléatoires.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.shuffled'),
                    'content' => [
                        'Les dégâts infligés par les ennemis sont randomisés selon les types d’ennemis. Par exemple, les dégâts des Octoroks et de Ganon peuvent être échangés, causant les Octorok à infliger 8 cœurs de dégâts, tandis que Ganon ne fera que 1 cœur. Les améliorations d’armure fonctionnent toujours normalement.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.random'),
                    'content' => [
                        'Les dégâts des ennemis sont complètement aléatoires. Une valeur est choisie pour chaque armure. Les armures ne réduisent donc plus forcément les dégâts. Il n’y a aucune relation entre différents ennemis. Tous les ennemis pourraient faire des dégâts massifs.',
                    ],
                ],
            ],
        ],
        'post_generation' => [
            'header' => 'Paramètres Cosmétiques (après-génération)',
            'cards' => [
                'heart_speed' => [
                    'header' => __('rom.settings.heart_speed'),
                    'content' => [
                        'Change la vitesse de l’alarme quand la vie de Link est faible.',
                    ],
                ],
                'play_as' => [
                    'header' => __('rom.settings.play_as'),
                    'content' => [
                        'Change le sprite du joueur (par exemple, jouez la Tasse de Thé au lieu de Link).',
                    ],
                ],
                'menu_speed' => [
                    'header' => __('rom.settings.menu_speed'),
                    'content' => [
                        'Change la vitesse d’ouverture et de fermeture du menu. Ceci n’est pas disponible pour les ROMs de course.',
                    ],
                ],
                'heart_color' => [
                    'header' => __('rom.settings.heart_color'),
                    'content' => [
                        'Change la couleur des cœurs. Les choix sont limités par les limitations du jeu.',
                    ],
                ],
                'music' => [
                    'header' => __('rom.settings.music'),
                    'content' => [
                        'Active ou désactive la musique originale du jeu.',
                    ],
                ],
                'msu1resume' => [
                    'header' => __('rom.settings.msu1resume'),
                    'content' => [
                        'Active la fonction de reprise de musique MSU-1. Cette fonction permet à la piste de reprendre là où elle s’est arrêtée quand on revient dans l’overworld.',
                    ],
                ],
                'shuffle_sfx' => [
                    'header' => __('rom.settings.shuffle_sfx'),
                    'content' => [
                        'Mélange les effets sonores du jeu. Cela veut dire que tout peut sonner comme n’importe quoi d’autre. À activer avec précaution!',
                    ],
                ],
                'quickswap' => [
                    'header' => __('rom.settings.quickswap'),
                    'content' => [
                        'Autorise les objets à être changés avec les boutons L ou R sans ouvrir le menu.',
                    ],
                ],
                'palette_shuffle' => [
                    'header' => __('rom.settings.palette_shuffle'),
                    'content' => [
                        'Randomise les palettes de couleurs du jeu. Ceci signifie que toute peut avoir l’air extrêmement bizarre. Utilisez avec précaution!',
                    ],
                ],
                'reduce_flashing' => [
                    'header' => __('rom.settings.reduce_flashing'),
                    'content' => [
                        'Réduit drastiquement les effets de clignotement du jeu, ou les désactive. Svp, faire attention, votre sensibilité aux effets de clignotement peut varier.',
                    ],
                ],
            ],
        ],
        'item_pool' => 'Groupe d’objets',
    ],
];

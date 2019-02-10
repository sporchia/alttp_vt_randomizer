<?php
return [
	'header' => 'Optionen',
	'subheader' => 'Es gibt viele Wege um ALttP:Randomizer zu spielen!',
	'cards' => [
		'mode' => [
			'header' => __('randomizer.mode.title'),
			'sections' => [
				[
					'header' => __('randomizer.mode.options.standard'),
					'content' => [
						'Dieser Modus hält sich am meisten an das Original. Du startes in Link´s Bett, kriegst eine Waffe von deinem Onkel (hängt zusammen mit den Schwert Optionen, siehe unten), und rettest Zelda bevor du mit dem Rest des Spiels fortschreiten kannst.',
					],
				],
				[
					'header' => __('randomizer.mode.options.open'),
					'content' => [
						'Dieser Modus startet mit der Option ob du in deinem Haus oder in der Kathedrale startest und du kannst sofort die Welt erkunden. Es gibt einige Punkte zu erwähnen in diesem Modus:',
						'<ul>'
							. '<li>Der Onkel ist schon in der Kanalisation und hat einen Gegenstand.</li>'
							. '<li>Dunkle Räume bekommen keinen freien Lichtpegel, nichtmal in der Kanalisation.</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.mode.options.inverted'),
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
							. '<li>The old man has decided to “get lost” the Dark World. You’ll still have to return him to his cave in the Light World</li>'
							. '<li>Portals? All the ones you used to see in the Light World will be in the Dark World with the same requirements to use them</li>'
							. '<li>Agahnim has really gotten tired of his place in Hyrule Castle and decided to move on up to the Tower formally known as Ganon’s on Dark Death Mountain. No silly bat barrier to get in, oh and he added some stairs so you can get to East Dark Death Mountain or his place pretty quickly</li>'
							. '<li>Since Agahnim decided to move on up, that means Ganon’s Tower came on down to Hyrule Castle, that center door being in the entrance, you’ll still need those 7 crystals though</li>'
							. '<li>Ice Palace tore down the wall so you can swim there pretty early now</li>'
							. '<li>Remember a bunny can use the ' . __('item.BookOfMudora') . ' as well as talk to people, and collect items it sees lying on the ground</li>'
							. '<li>The top of Turtle Rock can be accessed by walking on it’s tail</li>'
						. '</ul>',
					],
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
					'header' => __('randomizer.weapons.options.uncle'),
					'content' => [
						'Der Onkel hat immer ein Schwert. Die verbleibende Upgrades sind zufällig verteilt.',
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
		'logic' => [
			'header' => __('randomizer.logic.title'),
			'sections' => [
				[
					'header' => __('randomizer.logic.options.NoGlitches'),
					'content' => [
						'Dieser Modus setzt kein fortschrittliches Wissen über das Spiel vorraus. Es wurde so entworfen als würdest du das Spiel zum ersten Mal spielen.',
						'In diesem Modus wurde vorgebeugt das du nirgends feststecken kannst, egal wie du deine kleine Schlüsseln in Dungeons verwendest.',
						'Es könnte sein das vorrausgesetzt wird, das du in bestimmten Situation "Save and Quit" benutzt, um zum Beispiel wieder zurück in die Lichtwelt zu kommen wenn du in der Schattenwelt bist ohne magischen Spiegel.',
					],
				],
				[
					'header' => __('randomizer.logic.options.OverworldGlitches'),
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
							. '<li>Mirror Screenwraps</li>'
							. '<li>Overworld YBAs</li>'
							. '<li>Underworld Clips</li>'
							. '<li>Dark Room Navigation</li>'
							. '<li>Hovering</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.logic.options.MajorGlitches'),
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
						'Das Triforce wurde in 30 Splitter zerschlagen und über ganz Hyrule verteilt! Sammle 20 Splitter um zu gewinnen!',
					],
				],
			],
		],
		'difficulty' => [
			'header' => __('randomizer.difficulty.title'),
			'sections' => [
				[
					'header' => __('randomizer.difficulty.options.easy'),
					'content' => [
						'Dieser Modus ist für neuere Spieler empfohlen. Einfach macht das reisen durch Hyrule um einiges sicherer.',
						'Das finden der zweiten ½ Magic wird deine Magie zu ¼ Magic upgraden.',
						'Wenn im Standard Modus, falls der Onkel Bogen, Bomen, Feuerstab, Somaria Stab, oder Byrna Stab hat, wird Link während der Flucht Sequenz unendlich Munition für diesen Gegenstand erhalten.',
						'Schau dir die Tabelle an die die Schwierigkeitsgrade untereiander vergleicht für alle Informationen.',
					],
				],
				[
					'header' => __('randomizer.difficulty.options.normal'),
					'content' => [
						'In diesem Modus wirst du alle Gegenstände vom Original Spiel finden.',
					],
				],
				[
					'header' => sprintf('%s, %s, and %s', __('randomizer.difficulty.options.hard'), __('randomizer.difficulty.options.expert'), __('randomizer.difficulty.options.insane')),
					'content' => [
						'Du suchst eine Herausforderung? Diese fortschrittlichen Schwierigkeitsgrade passen das Spiel um einiges mehr an um dein Können zu testen! Schau dir unten den Vergleich an für mehr Informationen.',
					],
				],
			],
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
		'variation' => [
			'header' => __('randomizer.variation.title'),
			'sections' => [
				[
					'header' => __('randomizer.variation.options.none'),
					'content' => [
						'Die Option die dem Original am meisten ähnelt.',
					],
				],
				[
					'header' => __('randomizer.variation.options.timed-race'),
					'content' => [
						'Die Zeitanzeige zählt aufwärts von 0, mit dem Ziel die beste Zeit auf der Anzeige zu haben. Es gibt Gegenstände in der Welt die deine Zeitanzeige beeinflussen können, so als Erster fertig zu sein heißt nicht der Gewinner zu sein.',
						'Wirst du Zeit spenden um Uhren zu finden? Oder wirst du einfach bis zum Ende rennen?',
						'Die folgende Gegenstände wurde zum Gegenstandspool hinzugefügt:',
						'<ul>'
							. '<li>20 Grüne Uhren die 4 Minuten von der Zeitanzeige abziehen</li>'
							. '<li>10 Blaue Uhren die 2 Minuten von der Zeitanzeige abziehen</li>'
							. '<li>10 Rote Uhren die 2 Minuten von der Zeitanzeige hinzufügen</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.variation.options.timed-ohko') . ' (One Hit Knockout)',
					'content' => [
						'In diesem Modus startest du mit Zeit auf der Anzeige und findest grüne Uhren, um mehr hinzuzufügen.',
						'Wenn die Zeitanzeige Null erreicht, wird der One Hit Knockout Modus aktiviert, wo alles dich sofort töten wird.',
						'Verzweifle aber nicht. Wenn du im OHKO Modus bist und eine weitere Uhr findest, wirst du den OHKO Modus verlassen und bekommst Zeit auf deine Anzeige, unabhänging wie lange du im OHKO Modus warst.',
					],
					'ohko_table' => [
						'minutes' => 'Minuten',
						'start_time' => 'Zeit mit der du startest',
						'green_clock' => 'Grüne Uhren (+4 Minuten)',
						'red_clock' => 'Rote Uhren (sofort im OHKO)',
					],
				],
				[
					'header' => __('randomizer.variation.options.ohko') . ' (One Hit Knockout)',
					'content' => [
						'Egal bei welchem Schaden, Link wird sofort sterben. Nicht für schwache Herzen.',
					],
				],
				[
					'header' => __('randomizer.variation.options.key-sanity'),
					'content' => [
						'Das Spiel ist nicht zufällig genug? Du suchst eine richtige Herausforderung?',
						'NA SCHÖN!',
						'Alle Karten, Kompasse und Schlüssel die in Truhen gefunden werden, sind nicht mehr an ihre Dungeons gebunden!',
						'Du wirst alles von oben bis unten absuchen müssen um Schlüssel zu finden damit du in den Dungeons fortschreiten kannst. Schlüssel von Gegner und Töpfe bleiben aber gleich.',
						'Außerdem sind Karten und Kompasse mehr wert: Die Karte der Oberwelt wird dir keine Informationen über die Dungeons geben bis du die entsprechende Karte gefunden hast (und falls du dachtest du könntest die Musik der Dungeons nutzen, falsch gedacht, die sind jetzt auch zufällig). Und Kompasse, naja, die Zeigen dir an wieviele Kisten du schon in einem Dungeon geöffnet hast wenn du sie einsammelst.',
						'Und falls du dich fragst woher du weißt welchen Schlüssel / Karte / Kompass du eingesammelt hast. Da haben wir vorgesorgt: Es wird eine Textbox erscheinen die dir mitteilt für welchen Dungeons es ist . Außerdem wird das Menü eine Tabelle haben, die dir hilft, alles im Überblick zu haben.',
						'Karten und Kompasse werden in der Logik vorrausgesetzt um ihre entsprechende Dungeons zu beenden.',
					],
				],
				[
					'header' => __('randomizer.variation.options.retro'),
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
		'item_pool' => 'Gegenstandspool',
	],
];

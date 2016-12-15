# ALttP PHP Randomizer

## First and foremost, big thanks to Dessyreqt, Christos, and Karkat for their work.
### Without their work none of this would even be remotely possible.

### I wanted to create an API that modeled the Randomizer. This happened.

### Install
You will need [Composer](https://getcomposer.org/) for the Monolog/Logger Dependency. Once you have that, run the following

```
$ composer install
```

### Running
To generate a seed one simply runs the command. This should output a file in the format of *ALttP - V1.XXXXXX.rom* (where XXXXXX is the seed number)
as well as a *ALttP - V1.XXXXXX.txt* file, which is the spoiler, to the *./out/* directory. A spoiler will be dumped to the terminal as well.

```
./randomizer
```

#### This is a port of the ALttP Randomizer "intended" to be a webservice.

#### Features include
* Randomization of Items including Boss Hearts, Swords, Crystals and Pendants.
* Tries to distrobute the items in a way as to not have everything way too early.
* Logic updates with the Boss Hearts and Dungeon Prize locations randomized.
* Ability to set custom Uncle Text.
* Ability to have Boss item in regular dungeon pool (Compass/Map/Keys)
* Documentation of classes and objects (paritally done).
* Ability to create as many "seeds" as you want.
* With a little logic create any seed with items in specific places (might take a while, or never finish if you are looking for dead locks).

### API Documentation
The API documentation can be generated after you install by running:

```
$ composer documentation
```

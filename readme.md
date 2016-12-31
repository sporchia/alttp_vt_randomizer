# ALttP PHP Randomizer

## First and foremost, big thanks to Dessyreqt, Christos, and Karkat for their work.
### Without their work none of this would even be remotely possible.

### I wanted to create an API that modeled the Randomizer. This happened.

### Install
You will need [Composer](https://getcomposer.org/) for the Laravel Dependency. Once you have that, run the following

```
$ composer install
```

### Running

#### Command line
To generate a seed one simply runs the command.

```
php artisan alttp:randomize {input_file.sfc} {output_directory}
```

#### Web interface
To use the built-in php webserver you can run this in development mode. Run the following command then navigate to http://localhost:8000/.

```
php artisan serve
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

[![Build Status](https://travis-ci.org/sporchia/alttp_php_randomizer.svg?branch=master)](https://travis-ci.org/sporchia/alttp_php_randomizer)

# ALttP PHP VT Randomizer

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
$ php artisan alttp:randomize {input_file.sfc} {output_directory} {--seed=#} {--spoiler}
```

For bulk generation

```
$ php artisan alttp:randomize {input_file.sfc} {output_directory} --bulk=10 {--spoiler}
```

#### Web interface
To use the built-in php webserver you can run this in development mode. Run the following command then navigate to http://localhost:8000/.

```
$ php artisan serve
```

you may want to build the assets for this to work with

```
$ ./node_modules/gulp/bin/gulp.js --production
```

#### This is a port of the ALttP Randomizer which can be used as a web service.

It has the ability to patch a ROM file completely in the browser.

#### Features include
* Randomization of Items including Boss Hearts, Swords, Crystals and Pendants.
* Custom mode allowing one to switch on and off a bunch of different features.
* Tries to distrobute the items in a way as to not have everything way too early.
* Logic updates with the Boss Hearts and Dungeon Prize locations randomized.
* Ability to set custom Uncle Text.
* Ability to have Boss item in regular dungeon pool (Compass/Map/Keys)
* Documentation of classes and objects.
* Unit Tests (partially done).
* Ability to create as many "seeds" as you want.

### Running tests
You can run the current test suite with the following command (you may need to install [PHPUnit](https://phpunit.de/))

```
$ phpunit
```

### API Documentation
The API documentation can be generated after you install by running:

```
$ composer documentation
```

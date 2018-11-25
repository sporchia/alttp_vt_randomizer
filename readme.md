[![Build Status](https://travis-ci.org/sporchia/alttp_vt_randomizer.svg?branch=master)](https://travis-ci.org/sporchia/alttp_vt_randomizer)

# ALttP VT Randomizer

## First and foremost, big thanks to Dessyreqt, Christos, Smallhacker, and Karkat for their work.
### Without their work none of this would even be remotely possible.

## Installing dependencies
You will need [Composer](https://getcomposer.org/) for the Laravel Dependency. Once you have that, run the following

```
$ composer install
```

## Running from the command line
To generate a game one simply runs the command:

```
$ php artisan alttp:randomize {input_file.sfc} {output_directory}
```

For help (and all the options):

```
$ php artisan alttp:randomize -h
```

## Running the Web Interface

### Database setup
Create a new mysql database for the randomizer (see mysql documentation for how to do this, you'll need to install mysql server if it's not installed already)

Run the following command to create a new config for the app
```
$ cp .env.example .env
```

Then modify .env with appropriate username, password, and database name. Change the db connection to mysql
Example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=randomizer
DB_USERNAME=foo
DB_PASSWORD=bar
```

Then run the following commands to setup the app configuration

```
$ php artisan key:generate
$ php artisan config:cache
```
p.s. If you update the .env file then you'll need to run the config:cache command to pick up the new changes.

Now run the db migration command:

```
$ php artisan migrate
```

### Web server setup
You will need to build assets the first time (you will need [NPM](https://www.npmjs.com/get-npm) to install the javascript dependencies).

```
$ npm install
$ npm run production
```

Once you have the dependencies installed. Run the following command then navigate to http://localhost:8000/.

```
$ php artisan serve
```

## Running tests
You can run the current test suite with the following command (you may need to install [PHPUnit](https://phpunit.de/))

```
$ phpunit
```

## Updating base randomizer code
The base randomizer code requires xkas v0.6 to be installed.  Once that is done, you will need a copy of the unmodified Zelda no Densetsu - Kamigami no Triforce (J) (V1.0) ROM named "alttp.sfc" and copied to the root of this repository.  You can then update the base randomizer ROM (source files located in vendor/z3/randomizer) by running

```
$ ./updatebase.sh
```

## Installing xkas
xkas does not build or run properly on linux, so it must be run via WINE.  Also, it only supports 32-bit WINE, which may or may not require enabling multiarch support, depending on your environment.  Once wine32 is installed, copy xkas.exe anywhere on your system and then create a text file named xkas somewhere in your $PATH (e.g. /usr/local/bin) containing the following:

```
#!/bin/sh
wine /path/to/xkas.exe "$@"
```

Now you can should be able to run xkas normally.

```
$ xkas
xkas v0.06 ~byuu
usage: xas file.asm <file.smc>
```

## Bug Reports
Bug reports for the current release version can be opened in this repository's [issue tracker](https://github.com/sporchia/alttp_vt_randomizer/issues).

Please do not open issues for bugs that you encounter when testing a development branch.

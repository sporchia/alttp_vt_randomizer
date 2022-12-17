[![Build Status](https://travis-ci.org/sporchia/alttp_vt_randomizer.svg?branch=master)](https://travis-ci.org/sporchia/alttp_vt_randomizer)

# ALttP VT Randomizer

## First and foremost, big thanks to Dessyreqt, Christos, Smallhacker, and KatDevsGames for their work.
### Without their work none of this would even be remotely possible.

## Local Setup

### System Setup
This assumes you're running Ubuntu 20.04 (either natively, or via Windows Subsystem for Linux).
Native Windows is not currently supported.
Users of either Mac OS or other Linux distributions will need to install the appropriate packages for their system.

This version of the randomizer requires version 8.1 of PHP.

```
sudo apt-get install php8.1 php8.1-bcmath php8.1-dom php8.1-mbstring php8.1-curl -y
```

### Installing PHP dependencies
You will need [Composer](https://getcomposer.org/) for the Laravel Dependency. Once you have that, run the following

```
$ composer install
```

## Database setup

Run the following command to create a new config for the app
```
$ cp .env.example .env
```

### MySQL
Create a new mysql database for the randomizer (see mysql documentation for how to do this, you'll need to install mysql server if it's not installed already)

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

### SQLite
SQLite can also be used too, this might be a better option for a quick setup.

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/existing/folder/db.sqlite
```

Then run the following commands to setup the app configuration

### Last steps on DB setup
```
$ php artisan key:generate
$ php artisan config:cache
```
p.s. If you update the .env file then you'll need to run the config:cache command to pick up the new changes.

Now run the db migration command:

```
$ php artisan migrate
```

## Generate a base patch

In you .env file, update `ENEMIZER_BASE=` to the **absolute path** of an unheadered Japanese 1.0 ROM of A Link to the Past.

Then, in the command line run this to create the base patch.

```
php artisan config:cache
php artisan alttp:updatebuildrecord
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

### Web server setup
You will need to build assets the first time (you will need [NPM](https://www.npmjs.com/get-npm) to install the javascript dependencies).

```
$ npm install
```

And then

```
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

## Bug Reports
Bug reports for the current release version can be opened in this repository's [issue tracker](https://github.com/sporchia/alttp_vt_randomizer/issues).

Please do not open issues for bugs that you encounter when testing a development branch.

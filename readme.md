[![Build Status](https://travis-ci.org/sporchia/alttp_vt_randomizer.svg?branch=master)](https://travis-ci.org/sporchia/alttp_vt_randomizer)

# ALttP VT Randomizer

## First and foremost, big thanks to Dessyreqt, Christos, Smallhacker, and Karkat for their work.
### Without their work none of this would even be remotely possible.

### Install
You will need [Composer](https://getcomposer.org/) for the Laravel Dependency. Once you have that, run the following

```
$ composer install
```

Next create a new mysql database for the randomizer (see mysql documentation for how to do this)

Modify the config/database.php with appropriate username, password, and database name in the mysql section.

Then run the following

```
$ php artisan migrate
```

### Running

#### Command line
To generate a seed one simply runs the command:

```
$ php artisan alttp:randomize {input_file.sfc} {output_directory}
```

For help (and all the options):

```
$ php artisan alttp:randomize -h
```

#### Web interface
You will need to build assets the first time (you will need [Yarn](https://yarnpkg.com/) to install the javascript dependencies).

```
$ yarn
$ ./node_modules/gulp/bin/gulp.js --production
```

Once you have the dependencies installed. Run the following command then navigate to http://localhost:8000/.

```
$ php artisan serve
```

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

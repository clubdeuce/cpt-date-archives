# CPT Date Archives #

This mu-plugin adds support for date based archives for public custom post types that are registered with the `has_archive` property set to `true`. It adds rules for year, month, and date archives.

For example, if you register a custom post type of `books` for a website at `http://example.com`, the following URLs will be be active if you are using pretty permalinks (providing posts fit within the timeframe) :

`http://example.com/books/2015`

`http://example.com/books/2015/04`

`http://example.com/books/2015/04/20`

## Requirements ##

This plugin requires PHP 5.3 or later and WordPress 3.0 or later.

## Installation ##

The preferred installation method is via [Composer](http://getcomposer.org). This plugin can be found on [Packagist](https://packagist.org/packages/clubduece/cpt-date-archives).

Additionally, you can [download a release](https://github.com/clubduece/cpt-date-archives/releases) and then upload to the `mu-plugins` directory. You will need to add file in the `mu-plugins` directory that loads the `cpt-date-archives.php` file from the plugin root directory.

## Contributions ##

Contributions are welcome. Please fork the project and submit via Pull Request. Please adhere to the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/coding-standards/php/).
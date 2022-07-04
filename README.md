# websearch

A library for crawling search engine (google.com and google.ae) results and extracting metadata for a set of keywords for the first 5 pages.

## Requirements

* PHP 7.2 or above

## Installation

You can install the library via [Composer](https://getcomposer.org/). If you don't already have Composer installed, first install it by following one of these instructions depends on your OS of choice:
* [Composer installation instruction for Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)
* [Composer installation instruction for Mac OS X and Linux](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)

After composer is installed, Then run the following command to install library:

```bash
composer require rani/searchengine
```

## Usage

create a new php file and paste the below code in it
```php
<?php 

namespace Rani\Searchengine;
require_once './vendor/autoload.php';

$client = new SearchEngine();

//set search engine (google.com or google.ae)
$searchengine = $client->setEngine("google.com");

//search keywords goes here
if($searchengine){
    $results = $client->searchdata(["amazon"]);

    //print the results
    print_r($results);
}
?>
```

Run your php file using below command or run the file in your browser.
```bash
php {filename}.php
```

## License
[MIT](https://choosealicense.com/licenses/mit/)


# Yii2 Logger

![License](https://img.shields.io/packagist/l/cinghie/yii2-logger.svg)
![Latest Stable Version](https://img.shields.io/github/release/cinghie/yii2-logger.svg)
![Latest Release Date](https://img.shields.io/github/release-date/cinghie/yii2-logger.svg)
![Latest Commit](https://img.shields.io/github/last-commit/cinghie/yii2-logger.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/cinghie/yii2-logger.svg)](https://packagist.org/packages/cinghie/yii2-logger)

Yii2 Extension to log action to database or file

Installation
-----------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require cinghie/yii2-logger "*"
```

or add

```
"cinghie/yii2-logger": "*"
```

### 2. Update database schema

Run the following command:

```
$ php yii migrate/up --migrationPath=@vendor/cinghie/yii2-logger/migrations
```

## Configuration

Add in your common configuration file:

```
use cinghie\logger\components\LoggerDB;

'components' => [

    'logger' => [
    	'class' => LoggerDB::class,
    ],
    
],

```

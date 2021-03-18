<<<<<<< HEAD
# Lavacharts 3.1.12

=======
# Lavacharts 3.2.0
>>>>>>> a4edf0a4d82aba848efa07ff10b537d640d4f91b
[![Total Downloads](https://img.shields.io/packagist/dt/khill/lavacharts.svg?style=plastic)](https://packagist.org/packages/khill/lavacharts)
[![License](https://img.shields.io/packagist/l/khill/lavacharts.svg?style=plastic)](http://opensource.org/licenses/MIT)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg?style=plastic)](https://php.net/)
[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/kevinkhill/lavacharts?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
<<<<<<< HEAD
[![PayPal](https://img.shields.io/badge/paypal-donate-yellow.svg?style=plastic)](https://www.paypal.me/kevinkhill/)
=======
[![PayPal](https://img.shields.io/badge/paypal-donate-yellow.svg?style=plastic)](https://paypal.me/kevinkhill)
>>>>>>> a4edf0a4d82aba848efa07ff10b537d640d4f91b

Lavacharts is a graphing / chart library for PHP5.6+ that wraps the Google Chart API.

Stable:
[![Current Release](https://img.shields.io/github/release/kevinkhill/lavacharts.svg?style=plastic)](https://github.com/kevinkhill/lavacharts/releases)
[![Build Status](https://img.shields.io/travis/kevinkhill/lavacharts/3.1.svg?style=plastic)](https://travis-ci.org/kevinkhill/lavacharts)
[![Coverage Status](https://img.shields.io/coveralls/kevinkhill/lavacharts/3.1.svg?style=plastic)](https://coveralls.io/r/kevinkhill/lavacharts?branch=3.1)

Dev:
[![Development Release](https://img.shields.io/badge/release-dev--master-brightgreen.svg?style=plastic)](https://github.com/kevinkhill/lavacharts/tree/master)
[![Build Status](https://img.shields.io/travis/kevinkhill/lavacharts/master.svg?style=plastic)](https://travis-ci.org/kevinkhill/lavacharts)
[![Coverage Status](https://img.shields.io/coveralls/kevinkhill/lavacharts/master.svg?style=plastic)](https://coveralls.io/r/kevinkhill/lavacharts?branch=master)

## Developer Note
Please don't be discouraged if you see that it has been "years" since an update, but rather think that Lavacharts has settled into a "stable" state and requires less tinkering from me. I would love to add new features, but my responsibilities leave little room for my projects. I am happy to field issues, answer questions, debug and help if needed. Lavacharts is not vaporware! :smile:

## Package Features
<<<<<<< HEAD
- **Updated!** Laravel 5.5+ auto-discovery
- Any option for customizing charts that Google supports, Lavacharts should as well. Just use the chart constructor to assign any customization options you wish!
 - Visit [Google's Chart Gallery](https://developers.google.com/chart/interactive/docs/gallery) for details on available options
=======
- **Updated!** Global package configuration
  - Options include: `auto_run`, `locale`, `datetime_format`, `timezone`, `maps_api_key`

- **Updated!** New DataInterface for creating custom DataProviders.
  - [JoinedDataTable] (https://github.com/kevinkhill/lavacharts/blob/3.2/src/DataTables/JoinedDataTable.php) Is an example of one of the usages for DataInterface. 
  
- **Updated!** 

- Any option for customizing charts that Google supports, Lavacharts should as well.
 - Visit [Google's Chart Gallery](https://developers.google.com/chart/interactive/docs/gallery) for details on available option
 
>>>>>>> a4edf0a4d82aba848efa07ff10b537d640d4f91b
- Custom JavaScript module for interacting with charts client-side
  - AJAX data + option reloading
  - Fetching charts
  - Events integration
- Column Formatters and Roles

- Framework Integrations for [Laravel](https://github.com/kevinkhill/lavacharts/blob/3.2/src/Laravel/LavachartsServiceProvider.php), [Symfony](https://github.com/kevinkhill/lavacharts/tree/3.2/src/Symfony/Bundle/Resources), [Angular](https://github.com/kevinkhill/lavacharts/blob/3.2/javascript/src/angular/LavaJsService.ts)
- Template Extensions for [Blade](https://github.com/kevinkhill/lavacharts/blob/3.2/src/Laravel/BladeTemplateExtensions.php), [Twig](https://github.com/kevinkhill/lavacharts/blob/3.2/src/Symfony/Bundle/Twig/LavachartsExtension.php)
  
- [Carbon](https://github.com/briannesbitt/Carbon) support for date/datetime/timeofday columns

- Now supporting **22** Charts!
  - Annotation, Area, Bar, Bubble, Calendar, Candlestick, Column, Combo, Gantt, Gauge, Geo, Histogram, Line, Org, Pie, Sankey, Scatter, SteppedArea, Table, Timeline, TreeMap, and WordTree!


### For complete documentation, please visit [lavacharts.com](http://lavacharts.com/)

#### Upgrade guide: [Migrating from 2.5.x to 3.0.x](https://github.com/kevinkhill/lavacharts/wiki/Upgrading-from-2.5-to-3.0)
#### For contributing, a handy guide [can be found here](https://github.com/kevinkhill/lavacharts/blob/master/.github/CONTRIBUTING.md)

---

## Installing
In your project's main `composer.json` file, add this line to the requirements:
```json
<<<<<<< HEAD
"khill/lavacharts": "^3.1"
=======
"khill/lavacharts": "~3.2"
>>>>>>> a4edf0a4d82aba848efa07ff10b537d640d4f91b
```

Run Composer to install Lavacharts:
```bash
$ composer update
```

## Framework Agnostic
If you are using Lavacharts with Silex, Lumen or your own Composer project, that's no problem! Just make sure to:
`require 'vendor/autoload.php';` within you project and create an instance of Lavacharts: `$lava = new Khill\Lavacharts\Lavacharts;`


## Laravel
To integrate Lavacharts into Laravel, a ServiceProvider has been included.


### Laravel ~5.5
Thanks to the fantastic new [Package Auto-Discovery](https://laravel-news.com/package-auto-discovery) feature added in 5.5, you're ready to go, no registration required :+1:

#### Configuration
To modify the default configuration of Lavacharts, datetime formats for datatables or adding your maps api key...
Publish the configuration with `php artisan vendor:publish --tag=lavacharts`

### Laravel ~5.4
Register Lavacharts in your app by adding these lines to the respective arrays found in `config/app.php`:
```php
<?php
// config/app.php

// ...
'providers' => [
    // ...

    Khill\Lavacharts\Laravel\LavachartsServiceProvider::class,
],

// ...
'aliases' => [
    // ...

    'Lava' => Khill\Lavacharts\Laravel\LavachartsFacade::class,
]
```
#### Configuration
To modify the default configuration of Lavacharts, datetime formats for datatables or adding your maps api key...
Publish the configuration with `php artisan vendor:publish --tag=lavacharts`


### Laravel ~4
Register Lavacharts in your app by adding these lines to the respective arrays found in `app/config/app.php`:

```php
<?php
// app/config/app.php

// ...
'providers' => array(
    // ...

    "Khill\Lavacharts\Laravel\LavachartsServiceProvider",
),

// ...
'aliases' => array(
    // ...

    'Lava' => "Khill\Lavacharts\Laravel\LavachartsFacade",
)
```
#### Configuration
To modify the default configuration of Lavacharts, datetime formats for datatables or adding your maps api key...
Publish the configuration with `php artisan config:publish khill/lavacharts`


## Symfony
The package also includes a Bundle for Symfony to enable Lavacharts as a service that can be pulled from the Container.

### Add Bundle
Add the bundle to the registerBundles method in the AppKernel, found at `app/AppKernel.php`:
```php
<?php
// app/AppKernel.php

class AppKernel extends Kernel
{
    // ..

    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Khill\Lavacharts\Symfony\Bundle\LavachartsBundle(),
        );
    }
}
```
### Import Config
Add the service definition to the `app/config/config.yml` file
```yaml
imports:
  # ...
  - { resource: "@LavachartsBundle/Resources/config/services.yml"
```


# Usage
The creation of charts is separated into two parts:
First, within a route or controller, you define the chart, the data table, and the customization of the output.

Second, within a view, you use one line and the library will output all the necessary JavaScript code for you.

## Basic Example
Here is an example of the simplest chart you can create: A line chart with one dataset and a title, no configuration.

### Controller
Setting up your first chart.

#### Data
```php
$data = $lava->DataTable();

$data->addDateColumn('Day of Month')
     ->addNumberColumn('Projected')
     ->addNumberColumn('Official');

// Random Data For Example
for ($a = 1; $a < 30; $a++) {
    $rowData = [
      "2017-4-$a", rand(800,1000), rand(800,1000)
    ];

    $data->addRow($rowData);
}
```

Arrays work for datatables as well...
```php
$data->addColumns([
    ['date', 'Day of Month'],
    ['number', 'Projected'],
    ['number', 'Official']
]);
```

Or you can `use \Khill\Lavacharts\DataTables\DataFactory` [to create DataTables in another way](https://gist.github.com/kevinkhill/0c7c5f6211c7fd8f9658)

#### Chart Options
Customize your chart, with any options found in Google's documentation. Break objects down into arrays and pass to the chart.
```php
$lava->LineChart('Stocks', $data, [
    'title' => 'Stock Market Trends',
    'animation' => [
        'startup' => true,
        'easing' => 'inAndOut'
    ],
    'colors' => ['blue', '#F4C1D8']
]);
```

#### Output ID
The chart will needs to be output into a div on the page, so an html ID for a div is needed.
Here is where you want your chart `<div id="stocks-div"></div>`
 - If no options for the chart are set, then the third parameter is the id of the output:
```php
$lava->LineChart('Stocks', $data, 'stocks-div');
```
 - If there are options set for the chart, then the id may be included in the options:
```php
$lava->LineChart('Stocks', $data, [
    'elementId' => 'stocks-div'
    'title' => 'Stock Market Trends'
]);
```
 - The 4th parameter will also work:
```php
$lava->LineChart('Stocks', $data, [
    'title' => 'Stock Market Trends'
], 'stocks-div');
```


## View
Pass the main Lavacharts instance to the view, because all of the defined charts are stored within, and render!
```php
<?= $lava->render('LineChart', 'Stocks', 'stocks-div'); ?>
```

Or if you have multiple charts, you can condense theh view code withL
```php
<?= $lava->renderAll(); ?>
```


# Changelog
The complete changelog can be found [here](https://github.com/kevinkhill/lavacharts/wiki/Changelog)

## Stargazers over time

[![Stargazers over time](https://starchart.cc/kevinkhill/lavacharts.svg)](https://starchart.cc/kevinkhill/lavacharts)

# Laravel Eloquent Dynamic Tables for Models
###A simple but effective way to set the table of a model at runtime and continue using Eloquent instead of QueryBuilder

## Installation

The package can be installed via Composer:

`composer require lexbelcode/laravel-eloquent-dynamic-tables-for-models`

## Description
Consider this scenario:

You have, for any razon, a database in which exists A) tables with different names but same structure, or you need break a really big table into smallers and you don't want to use the partitioning provided by your database, and B) tables with different names but same structure that has a relationship with the tables in A)

Example:
In general, if you have one model for sells and one model for buyers, and you need to get records from the sells table with the realted data from buyers, using Eloquent you will do this:

```PHP
$data = Sell::select(...here your columns...)
    ->where(...here your filters...)
    ->with('buyers')
    ->get();
```

But if the scenario changes and you have to divide your tables into multiples like this:
sells_01
sells_02
sells_03
sells_04

buyers_01
buyers_02
buyers_03
buyers_04

Your models are the same, but if you need to get data from sells_03 with the realted data from buyers_03 **you can't use Eloquent like before**, because your Sell model is pointed to the sells table and your Buyer model is pointed to the buyers table, so, the only way to get the data is through the QueryBuilder or raw querys using joins, and you will lost the magic of Eloquent, inclusive, if you have Eloquent events, you won't be able to fire them because of this

But if you update your models, to extend from the LaravelEloquentDynamicModel class, you can do it as simple as this:

Your models:
```php
use lexbelcode\LaravelEloquentDynamicTablesForModels\LaravelEloquentDynamicModel;

class Sell extends LaravelEloquentDynamicModel
{
    ...
}
```

```php
use lexbelcode\LaravelEloquentDynamicTablesForModels\LaravelEloquentDynamicModel;

class Buyer extends LaravelEloquentDynamicModel
{
    ...
}
```

And in your code, you only have to add this two lines of code:
```PHP
Sell::$dynamicTableName = 'sells_03';
Buyer::$dynamicTableName = 'buyers_03';

$data = Sell::select(...here your columns...)
    ->where(...here your filters...)
    ->with('buyers')
    ->get();
```

And during the time execution of the related PHP script, model Sell will be pointing to sells_03 table and model Buyer will be pointing to buyers_03 table, and you'll can use Eloquent normaly with that models, relationships, events, etc.

## Requirements

- **[PHP 8.1+](https://php.net/)**
- **[Laravel 10+](https://laravel.com)**

## Author
Alex Beltrán
Follow me on X as [@LexBelCode](https://twitter.com/LexBelCode)

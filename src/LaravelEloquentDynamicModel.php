<?php
namespace lexbelcode\LaravelEloquentDynamicTablesForModels;

use Illuminate\Database\Eloquent\Model;
use lexbelcode\LaravelEloquentDynamicTablesForModels\LaravelEloquentDynamicTrait;

class LaravelEloquentDynamicModel extends Model {
    use LaravelEloquentDynamicTrait;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        if(!empty(self::$dynamicTableName))
            $this->setTable(self::$dynamicTableName);
    }
}
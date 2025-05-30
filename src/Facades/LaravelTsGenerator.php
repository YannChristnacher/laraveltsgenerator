<?php

namespace Ycp\LaravelTsGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ycp\LaravelTsGenerator\LaravelTsGenerator
 */
class LaravelTsGenerator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ycp\LaravelTsGenerator\LaravelTsGenerator::class;
    }
}

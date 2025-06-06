<?php

use Ycp\LaravelTsGenerator\Application\Extractors\EloquentSqlStructureExtractor;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

it('can extract property from datatable structure', function () {
    $extractor = new EloquentSqlStructureExtractor();
    $reflectionClass = new \ReflectionClass(TestModel::class);
    $results = $extractor->extract($reflectionClass);
    $this->assertEquals(count($results), 5);

});

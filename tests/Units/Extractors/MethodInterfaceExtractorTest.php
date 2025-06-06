<?php

use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Application\Extractors\MethodInterfaceExtractor;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

it('can extract property from datatable structure', function () {
    $extractor = new MethodInterfaceExtractor();
    $reflectionClass = new \ReflectionClass(TestModel::class);
    $results = $extractor->extract($reflectionClass);

    $this->assertEquals(count($results), 1);
    /** @var PropertyDto $result */
    $result = $results[0];
    $this->assertTrue($result->getName() === "myProperty");
    $this->assertTrue($result->getType() === "string");
});

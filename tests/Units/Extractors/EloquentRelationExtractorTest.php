<?php

use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Application\Extractors\EloquentRelationExtractor;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

it('can extract property from model', function () {
    $extractor = new EloquentRelationExtractor();
    $reflectionClass = new \ReflectionClass(TestModel::class);
    $results = $extractor->extract($reflectionClass);

    $this->assertNotEmpty($results);
    $relationOne = $results[0];
    $relationMany = $results[1];

    $this->assertInstanceOf(PropertyDto::class, $relationOne);
    $this->assertTrue($relationOne->getName() === "relationOne");
    $this->assertTrue($relationOne->isRelatedClass());
    $this->assertTrue($relationOne->getType() === TestModel::class);
    $this->assertTrue($relationOne->isArray() === false);

    $this->assertInstanceOf(PropertyDto::class, $relationMany);
    $this->assertTrue($relationMany->getName() === "relationMany");
    $this->assertTrue($relationMany->isRelatedClass());
    $this->assertTrue($relationMany->getType() === TestModel::class);
    $this->assertTrue($relationMany->isArray());
});

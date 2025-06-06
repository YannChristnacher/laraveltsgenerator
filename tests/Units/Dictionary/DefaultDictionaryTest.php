<?php

use Ycp\LaravelTsGenerator\Application\Dictionaries\DefaultDictionary;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

it('can get mapped array on default dictionnary', function () {
    $dictionary = new DefaultDictionary();

    $this->assertNotEmpty($dictionary->getMapping());
});

it('can map a property', function () {
    $dictionary = new DefaultDictionary();
    $property = new PropertyDto(name: "name", type: "int");
    $results = $dictionary->map([$property]);

    $this->assertNotEmpty($results);
    $result = $results[0];
    $this->assertInstanceOf(PropertyDto::class, $result->getProperty());
    $this->assertTrue($result->getTsType() === "number");
});

it('can map a related property', function () {
    $dictionary = new DefaultDictionary();
    $property = new PropertyDto(name: "name", type: TestModel::class, isRelatedClass: true);
    $results = $dictionary->map([$property]);

    $this->assertNotEmpty($results);
    $result = $results[0];
    $this->assertInstanceOf(PropertyDto::class, $result->getProperty());
    $this->assertTrue($result->getTsType() === "TestModel");
});

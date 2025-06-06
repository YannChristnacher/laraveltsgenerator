<?php

use Ycp\LaravelTsGenerator\Application\Dto\MappedDto;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;

it('can create new Mapped Dto', function () {

    $name = "My property name";
    $type = "My property type";

    $property = new PropertyDto(name: $name, type: $type);
    $dto = new MappedDto(property: $property, tsType: "type");

    $this->assertTrue($dto->getTsType() === "type");
    $this->assertNotNull($dto->getProperty());
});

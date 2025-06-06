<?php

use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;

it('can create new property Dto', function () {

    $name = "My property name";
    $type = "My property type";

    $dto = new PropertyDto(name: $name, type: $type);

    $this->assertTrue($dto->getName() === $name);
    $this->assertTrue($dto->getType() === $type);
    $this->assertTrue($dto->isArray() === false);
    $this->assertTrue($dto->isNullable() === false);
    $this->assertTrue($dto->isOptional() === false);
    $this->assertTrue($dto->isRelatedClass() === false);
});

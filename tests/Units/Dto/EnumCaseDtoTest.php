<?php

use Ycp\LaravelTsGenerator\Application\Dto\EnumCaseDto;

it('can create new Enum case Dto with value', function () {

    $name = "Up";
    $value = "up";

    $dto = new EnumCaseDto(name: $name, value: $value);

    $this->assertTrue($dto->getValue() === "up");
    $this->assertTrue($dto->getName() === "Up");
});

it('can create new Enum case Dto without value', function () {

    $name = "Up";
    $value = null;

    $dto = new EnumCaseDto(name: $name, value: $value);

    $this->assertSame($dto->getValue(), $value);
    $this->assertTrue($dto->getName() === "Up");
});

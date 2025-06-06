<?php

use Ycp\LaravelTsGenerator\Application\Adapter\InterfaceAdapter;
use Ycp\LaravelTsGenerator\Application\Dto\MappedDto;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;

it('can get adapt a mapped property to string', function () {
    $adapter = new InterfaceAdapter();
    $mapped = new MappedDto(
        property: new PropertyDto(name: "my_property", type: "int"),
        tsType: "number"
    );
    $result = $adapter->adapt($mapped);
    $attempt = "my_property: number;";
    $this->assertSame($attempt, $result);
});



it('can get adapt a mapped nullable property to string', function () {
    $adapter = new InterfaceAdapter();
    $mapped = new MappedDto(
        property: new PropertyDto(name: "my_property", type: "int", isNullable: true),
        tsType: "number"
    );
    $result = $adapter->adapt($mapped);
    $attempt = "my_property: number|null;";
    $this->assertSame($attempt, $result);
});

it('can get adapt a mapped optional property to string', function () {
    $adapter = new InterfaceAdapter();
    $mapped = new MappedDto(
        property: new PropertyDto(name: "my_property", type: "int", isOptional: true),
        tsType: "number"
    );
    $result = $adapter->adapt($mapped);
    $attempt = "my_property?: number;";
    $this->assertSame($attempt, $result);
});

it('can generate header', function () {
    $adapter = new InterfaceAdapter();
    $result = $adapter->getHeader("myClass");
    $attempt = "\nexport interface myClass {\n\t";
    $this->assertSame($attempt, $result);
});

it('can generate footer', function () {
    $adapter = new InterfaceAdapter();
    $result = $adapter->getFooter("myClass");
    $attempt = "\n}\n";
    $this->assertSame($attempt, $result);
});

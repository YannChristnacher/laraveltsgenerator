<?php

use Ycp\LaravelTsGenerator\Application\Adapter\EnumAdapter;
use Ycp\LaravelTsGenerator\Application\Dto\EnumCaseDto;

it('can get adapt a backed case property to string', function () {
    $adapter = new EnumAdapter();
    $mapped = new EnumCaseDto(
        name: "Up",
        value: "up"
    );
    $result = $adapter->adapt($mapped);
    $attempt = 'Up = "up",';
    $this->assertSame($attempt, $result);
});

it('can get adapt a not typed case property to string', function () {
    $adapter = new EnumAdapter();
    $mapped = new EnumCaseDto(
        name: "Up",
        value: null
    );
    $result = $adapter->adapt($mapped);
    $attempt = 'Up,';
    $this->assertSame($attempt, $result);
});

it('can get adapt header', function () {
    $adapter = new EnumAdapter();
    $result = $adapter->getHeader("MyEnum");
    $attempt = "\nexport enum MyEnum {\n\t";
    $this->assertSame($attempt, $result);
});

it('can get adapt footer', function () {
    $adapter = new EnumAdapter();
    $result = $adapter->getFooter("MyEnum");
    $attempt =  "\n}\n";
    $this->assertSame($attempt, $result);
});

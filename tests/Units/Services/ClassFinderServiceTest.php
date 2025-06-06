<?php

use Ycp\LaravelTsGenerator\Services\ClassFinderService;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

it('can get class by path', function () {
    $reflectionClass = new ReflectionClass(TestModel::class);
    $path = $reflectionClass->getFileName();
    $service = new ClassFinderService();
    $result = $service->findByPath($path);
    $this->assertSame(TestModel::class, $result);
});

it('can get class by namespace', function () {
    $namespace = "Ycp\LaravelTsGenerator\Tests\src";
    $service = new ClassFinderService();
    $result = $service->findByNamespace($namespace);
    $this->assertNotEmpty($result);
    $this->assertSame(TestModel::class, $result[1]);
});

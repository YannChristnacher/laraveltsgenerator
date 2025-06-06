<?php
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Application\Extractors\MethodInterfaceExtractor;
use Ycp\LaravelTsGenerator\Application\Extractors\ReflectionExtractor;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

it('can extract property from public property', function () {
    $extractor = new ReflectionExtractor();
    $reflectionClass = new \ReflectionClass(TestModel::class);
    $results = $extractor->extract($reflectionClass);
    $this->assertEquals(count($results), 2);
    /** @var PropertyDto $result */
    $result = $results[0];
    $this->assertTrue($result->getName() === "myProperty");
    $this->assertTrue($result->getType() === "string");
});

it('can extract property from public related property', function () {
    $extractor = new ReflectionExtractor();
    $reflectionClass = new \ReflectionClass(TestModel::class);
    $results = $extractor->extract($reflectionClass);
    $this->assertEquals(count($results), 2);
    /** @var PropertyDto $result */
    $result = $results[1];
    $this->assertTrue($result->getName() === "myRelatedProperty");
    $this->assertTrue($result->getType() === TestModel::class);
    $this->assertTrue($result->isRelatedClass());
});

<?php
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Application\Extractors\EnumExtractor;
use Ycp\LaravelTsGenerator\Application\Extractors\MethodInterfaceExtractor;
use Ycp\LaravelTsGenerator\Tests\src\TestEnum;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

it('can extract property from enum', function () {
    $extractor = new EnumExtractor();
    $reflectionClass = new \ReflectionClass(TestEnum::class);
    $results = $extractor->extract($reflectionClass);

    $this->assertSame(count($results), 4);
});

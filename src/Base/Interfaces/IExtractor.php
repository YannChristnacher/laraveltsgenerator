<?php

namespace Ycp\LaravelTsGenerator\Base\Interfaces;

use ReflectionClass;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;

interface IExtractor
{
    /**
     * @param ReflectionClass $reflectionClass
     * @param ...$params
     * @return array<PropertyDto>
     */
    public function extract(ReflectionClass $reflectionClass, ...$params): array;
}

<?php

namespace Ycp\LaravelTsGenerator\Base\Abstracts;

use ReflectionClass;
use Ycp\LaravelTsGenerator\Application\Dto\EntryConfigDto;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Base\Interfaces\IExtractor;
use Ycp\LaravelTsGenerator\Base\Interfaces\IProvider;

abstract class ProviderAbstract implements IProvider
{
    public function __construct( protected EntryConfigDto $entryConfigDto)
    {}

    /**
     * @param ReflectionClass $reflectionClass
     * @param ...$params
     * @return array<PropertyDto>
     */
    public function getProperties(ReflectionClass $reflectionClass, ...$params): array
    {
        $properties = [];
        foreach ( $this->getExtractors() as $extractor)
        {
            /** @var IExtractor $extractor */
            $extractor = new $extractor();
            $properties = array_merge($properties, $extractor->extract($reflectionClass, ...$params));
        }
        return $properties;
    }
}

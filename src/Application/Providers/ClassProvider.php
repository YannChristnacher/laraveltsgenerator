<?php

namespace Ycp\LaravelTsGenerator\Application\Providers;

use Illuminate\Support\Collection;
use Ycp\LaravelTsGenerator\Application\Adapter\InterfaceAdapter;
use Ycp\LaravelTsGenerator\Application\Dictionaries\DefaultDictionary;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Application\Extractors\EloquentRelationExtractor;
use Ycp\LaravelTsGenerator\Application\Extractors\EloquentSqlStructureExtractor;
use Ycp\LaravelTsGenerator\Application\Extractors\MethodInterfaceExtractor;
use Ycp\LaravelTsGenerator\Application\Extractors\ReflectionExtractor;
use Ycp\LaravelTsGenerator\Base\Abstracts\AdapterAbstract;
use Ycp\LaravelTsGenerator\Base\Abstracts\DictionaryAbstract;
use Ycp\LaravelTsGenerator\Base\Abstracts\ProviderAbstract;

/**
 * ClassProvider is responsible for managing extractors, retrieving the dictionary,
 * setting up the adapter, and processing reflection class properties.
 */
class ClassProvider extends ProviderAbstract
{

    /**
     * Retrieve an array of extractor classes used for various data extraction tasks.
     *
     * @return array An array of extractor class names.
     */
    public function getExtractors(): array
    {
        return [
            EloquentRelationExtractor::class,
            EloquentSqlStructureExtractor::class,
            MethodInterfaceExtractor::class,
            ReflectionExtractor::class
        ];
    }

    /**
     * Retrieve the default dictionary instance.
     *
     * @return DictionaryAbstract The default dictionary implementation.
     */
    public function getDictionary(): DictionaryAbstract
    {
        return new DefaultDictionary();
    }

    /**
     * Get the adapter instance.
     *
     * @return AdapterAbstract The adapter instance.
     */
    public function getAdapter(): AdapterAbstract
    {
        return new InterfaceAdapter();
    }

    /**
     * Processes the provided reflection class and generates a rendered string representation.
     *
     * @param \ReflectionClass $reflectionClass The reflection class to be processed.
     * @return string The rendered string based on the processed data.
     */
    public function process(\ReflectionClass $reflectionClass): string
    {
        $properties = $this->getProperties($reflectionClass);
        $properties = (new Collection($properties))->unique(function (PropertyDto $item) {
            return $item->getName();
        })->toArray();
        $mapped = $this->getDictionary()->map($properties);
        return $this->getAdapter()->render($mapped, $reflectionClass->getShortName());
    }
}

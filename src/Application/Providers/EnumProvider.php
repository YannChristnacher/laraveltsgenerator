<?php

namespace Ycp\LaravelTsGenerator\Application\Providers;

use Ycp\LaravelTsGenerator\Application\Adapter\EnumAdapter;
use Ycp\LaravelTsGenerator\Application\Dictionaries\DefaultDictionary;
use Ycp\LaravelTsGenerator\Application\Extractors\EnumExtractor;
use Ycp\LaravelTsGenerator\Base\Abstracts\AdapterAbstract;
use Ycp\LaravelTsGenerator\Base\Abstracts\DictionaryAbstract;
use Ycp\LaravelTsGenerator\Base\Abstracts\ProviderAbstract;

/**
 * ClassProvider is responsible for managing extractors, retrieving the dictionary,
 * setting up the adapter, and processing reflection class properties.
 */
class EnumProvider extends ProviderAbstract
{

    /**
     * Retrieve an array of extractor classes used for various data extraction tasks.
     *
     * @return array An array of extractor class names.
     */
    public function getExtractors(): array
    {
        return [
            EnumExtractor::class
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
        return new EnumAdapter();
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
        return $this->getAdapter()->render($properties, $reflectionClass->getShortName());
    }
}

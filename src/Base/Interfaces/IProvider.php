<?php

namespace Ycp\LaravelTsGenerator\Base\Interfaces;

use Ycp\LaravelTsGenerator\Base\Abstracts\AdapterAbstract;
use Ycp\LaravelTsGenerator\Base\Abstracts\DictionaryAbstract;
use Ycp\LaravelTsGenerator\Base\Abstracts\ProviderAbstract;

interface IProvider
{
    /**
     * @return array<ProviderAbstract>
     */
    public function getExtractors(): array;

    public function getDictionary(): DictionaryAbstract;

    public function getAdapter(): AdapterAbstract;

    public function process(\ReflectionClass $reflectionClass): string;
}

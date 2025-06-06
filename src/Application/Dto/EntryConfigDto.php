<?php

namespace Ycp\LaravelTsGenerator\Application\Dto;

use Ycp\LaravelTsGenerator\Application\Providers\ClassProvider;

/**
 * Represents a configuration data transfer object for entries.
 *
 * This class is used to provide a structured representation of data
 * related to entry configurations, including their name, status, associated
 * classes, namespaces, paths, excluded properties, and provider information.
 *
 * Methods in this class allow retrieving the configuration details and initializing
 * the object using a configuration array.
 */
class EntryConfigDto
{
    public function __construct(
      protected string $name,
      protected bool $isEnabled,
      protected array $specifiedClasses,
      protected array $namespaces,
      protected array $paths,
      protected array $excluded_properties,
      protected string $provider,
    ){}

    public static function initFromConfig(string $name, array $config): EntryConfigDto
    {
        return new self(
            name: $name,
            isEnabled: $config['enabled'] ?? true,
            specifiedClasses: $config['input']['specified_class'] ?? [],
            namespaces: $config['input']['namespaces'] ?? [],
            paths: $config['input']['paths'] ?? [],
            excluded_properties: $config['excluded_properties'] ?? [],
            provider: $config['provider'] ?? ClassProvider::class ,
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getSpecifiedClasses(): array
    {
        return $this->specifiedClasses;
    }

    public function getNamespaces(): array
    {
        return $this->namespaces;
    }

    public function getPaths(): array
    {
        return $this->paths;
    }

    public function getExcludedProperties(): array
    {
        return $this->excluded_properties;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }


}

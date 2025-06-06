<?php

namespace Ycp\LaravelTsGenerator\Application\Generator;

use ReflectionClass;
use ReflectionException;
use Ycp\LaravelTsGenerator\Application\Dto\EntryConfigDto;
use Ycp\LaravelTsGenerator\Application\Providers\ClassProvider;
use Ycp\LaravelTsGenerator\Base\Abstracts\ProviderAbstract;
use Ycp\LaravelTsGenerator\Services\ClassFinderService;

/**
 * Class Generator
 * Responsible for managing class mapping and generating a result based on class reflections and provider processing.
 */
class Generator
{

    /**
     * @var array
     */
    protected array $classMap = [];

    /**
     * @param EntryConfigDto $entryConfigDto
     */
    public function __construct(
        protected EntryConfigDto $entryConfigDto,
    )
    {
        $finder = new ClassFinderService();
        $this->classMap = $finder->findClassesInEntry($this->entryConfigDto);
    }

    /**
     * @return string
     * @throws ReflectionException
     */
    public function generate(): string
    {
        $result = "";
        $provider = $this->getProvider($this->entryConfigDto);

        foreach ($this->classMap as $class)
        {
            $reflection = new ReflectionClass($class);
            $result .= $provider->process($reflection);
        }

        return $result;
    }

    /**
     * @throws ReflectionException
     */
    private function getProvider(EntryConfigDto $entryConfigDto): ProviderAbstract
    {
        $provider = $entryConfigDto->getProvider();
        $reflection = new ReflectionClass($provider);
        if ($reflection->isSubclassOf(ProviderAbstract::class)) return new $provider($entryConfigDto);
        return new ClassProvider($entryConfigDto);
    }
}

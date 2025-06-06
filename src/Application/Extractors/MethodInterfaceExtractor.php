<?php

namespace Ycp\LaravelTsGenerator\Application\Extractors;

use ReflectionClass;
use Ycp\LaravelTsGenerator\Base\Interfaces\IExtractByMethod;
use Ycp\LaravelTsGenerator\Base\Interfaces\IExtractor;

class MethodInterfaceExtractor implements IExtractor
{
    /**
     * Extracts data by invoking the extractByMethod() function on a class that implements the IExtractByMethod interface.
     *
     * @param ReflectionClass $reflectionClass An instance of ReflectionClass used to check and interact with the class.
     * @param mixed ...$params Additional parameters that can be passed to the method (unused in this implementation).
     *
     * @return array Returns the result of the extractByMethod() function if the class implements the IExtractByMethod interface; otherwise, returns an empty array.
     *
     * @throws \Throwable May throw an exception if the instantiation of the class or the method invocation fails.
     */
    public function extract(ReflectionClass $reflectionClass, ...$params): array
    {
        if($reflectionClass->implementsInterface(IExtractByMethod::class)) {
            $className = $reflectionClass->getName();
            /** @var IExtractByMethod $instance */
            $instance = new $className();
            return $instance->extractByMethod();
        }
        return [];
    }
}

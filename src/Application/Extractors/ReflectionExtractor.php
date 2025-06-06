<?php

namespace Ycp\LaravelTsGenerator\Application\Extractors;

use ReflectionProperty;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Base\Interfaces\IExtractor;

class ReflectionExtractor implements IExtractor
{

    /**
     * Extracts public non-static properties of a given class and returns them as a list of PropertyDto objects.
     *
     * @param \ReflectionClass $reflectionClass The reflection class to extract properties from.
     * @param mixed ...$params Additional parameters (not used in this method).
     *
     * @return array An array of PropertyDto objects representing the public non-static properties of the class.
     */
    public function extract(\ReflectionClass $reflectionClass, ...$params): array
    {
        $list = [];

        if(class_exists($reflectionClass->name) === false) return $list;

        foreach ($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            if($property->isStatic())continue;
            if($property->class == $reflectionClass->name){

                $type = "any";
                $isRelated = false;

                if($property->getType()) {
                    $type = $property->getType()->getName();
                    $isRelated = !$property->getType()->isBuiltin();
                }
                $list[] = new PropertyDto(
                    name: $property->getName(),
                    type: $type,
                    isNullable: $property->getType()?->allowsNull() ?? false,
                    isOptional: $property->hasDefaultValue(),
                    isRelatedClass: $isRelated
                );
            }
        }
        return $list;
    }
}

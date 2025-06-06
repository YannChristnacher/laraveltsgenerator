<?php

namespace Ycp\LaravelTsGenerator\Application\Extractors;

use ReflectionClass;
use ReflectionEnum;
use Ycp\LaravelTsGenerator\Application\Dto\EnumCaseDto;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Base\Interfaces\IExtractor;

class EnumExtractor implements IExtractor
{

    /**
     * @throws \ReflectionException
     */
    public function extract(ReflectionClass $reflectionClass, ...$params): array
    {
        $properties = [];
        if ($reflectionClass->isEnum()) {
            $enumReflection = new ReflectionEnum($reflectionClass->getName());
            if($enumReflection->isBacked()){
                return $this->getBackedEnumProperties($enumReflection);
            }
            return $this->getNotTypedEnumProperties($enumReflection);
        }

        return $properties;
    }

    private function getNotTypedEnumProperties(ReflectionEnum $enumReflection): array
    {
        $properties = [];

        foreach ($enumReflection->getCases() as $case) {

            $properties[] = new EnumCaseDto(
                name: $case->getValue()->name,
                value: null,
            );
        }

        return $properties;
    }

    private function getBackedEnumProperties(ReflectionEnum $enumReflection): array
    {
        $properties = [];
        foreach ($enumReflection->getCases() as $case) {

            $properties[] = new EnumCaseDto(
                name: $case->getValue()->name,
                value: $case->getValue()->value,
            );
        }
        return $properties;
    }
}

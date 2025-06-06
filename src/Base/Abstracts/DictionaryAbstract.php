<?php

namespace Ycp\LaravelTsGenerator\Base\Abstracts;

use Ycp\LaravelTsGenerator\Application\Dto\MappedDto;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Base\Interfaces\IDictionary;

abstract class DictionaryAbstract implements IDictionary
{
    /**
     * @param array<PropertyDto> $properties
     * @return array<MappedDto>
     */
    public function map(array $properties): array
    {
        $data = [];
        foreach ($properties as $property)
        {
            if($mappedDto = $this->getByMap($property)){
                $data[] = $mappedDto;
            }
            elseif ($mappedDto =$this->getByRelatedClass($property)){
                $data[] = $mappedDto;
            }
            else{
                $data[] = new MappedDto(
                    property: $property,
                    tsType: $property->getType()
                );
            }
        }

        return $data;
    }

    private function getByMap(PropertyDto $property): ?MappedDto
    {
        if(isset($this->getMapping()[$property->getType()]))
        {
            return new MappedDto(
                property: $property,
                tsType: $this->getMapping()[$property->getType()]
            );
        }

        return null;
    }

    private function getByRelatedClass(PropertyDto $property): ?MappedDto
    {
        if($property->isRelatedClass())
        {
            return new MappedDto(
                property: $property,
                tsType:  $this->getClassName($property->getType())
            );
        }
        return null;
    }


    private function getClassName(string $classname): string
    {
        if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
        return "any";
    }
}

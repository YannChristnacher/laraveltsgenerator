<?php

namespace Ycp\LaravelTsGenerator\Application\Dto;


class MappedDto
{
    public function __construct(
      protected PropertyDto $property,
      protected string $tsType,
    ){}

    public function getProperty(): PropertyDto
    {
        return $this->property;
    }

    public function getTsType(): string
    {
        return $this->tsType;
    }
}

<?php

namespace Ycp\LaravelTsGenerator\Application\Dto;

class EnumCaseDto
{
    public function __construct(
        protected string $name,
        protected mixed $value,
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }
    public function getValue(): mixed
    {
        return $this->value;
    }
}

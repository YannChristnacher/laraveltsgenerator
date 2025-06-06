<?php

namespace Ycp\LaravelTsGenerator\Application\Dto;

/**
 * Represents the properties of a data transfer object with various attributes.
 */
class PropertyDto
{
    public function __construct(
        protected string $name,
        protected string $type,
        protected bool $isNullable = false,
        protected bool $isOptional = false,
        protected bool $isRelatedClass = false,
        protected bool $isArray = false
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isNullable(): bool
    {
        return $this->isNullable;
    }

    public function isOptional(): bool
    {
        return $this->isOptional;
    }

    public function isRelatedClass(): bool
    {
        return $this->isRelatedClass;
    }

    public function isArray(): bool
    {
        return $this->isArray;
    }


}

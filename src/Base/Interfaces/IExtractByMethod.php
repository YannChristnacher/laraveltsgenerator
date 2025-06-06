<?php

namespace Ycp\LaravelTsGenerator\Base\Interfaces;

use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;

interface IExtractByMethod
{
    /**
     * @return array<PropertyDto>
     */
    public function extractByMethod(): array;
}

<?php

namespace Ycp\LaravelTsGenerator\Base\Interfaces;

use Ycp\LaravelTsGenerator\Application\Dto\MappedDto;

interface IAdapter
{
    public function adapt(mixed $data): string;
    public function getHeader(string $class): string;
    public function getFooter(string $class): string;
}

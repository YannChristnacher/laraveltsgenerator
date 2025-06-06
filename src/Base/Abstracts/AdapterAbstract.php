<?php

namespace Ycp\LaravelTsGenerator\Base\Abstracts;

use Ycp\LaravelTsGenerator\Base\Interfaces\IAdapter;

/**
 *
 */
abstract class AdapterAbstract implements IAdapter
{

    public function render( array $mappedDtos, string $class): string
    {
        $result = [];
        foreach ($mappedDtos as $mappedDto)
        {
            $result[] = $this->adapt($mappedDto);
        }
        return $this->getHeader($class) . implode("\n \t", $result) . $this->getFooter($class);
    }
}

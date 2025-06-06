<?php

namespace Ycp\LaravelTsGenerator\Application\Adapter;

use Ycp\LaravelTsGenerator\Application\Dto\MappedDto;
use Ycp\LaravelTsGenerator\Base\Abstracts\AdapterAbstract;

/**
 *
 */
class InterfaceAdapter extends AdapterAbstract
{

    /**
     * @param MappedDto $data
     * @return string
     */
    public function adapt(mixed $data): string
    {
        $name = $data->getProperty()->getName();
        if($data->getProperty()->isOptional()) {
            $name = $name . "?";
        }

        $type = $data->getTsType();
        if($data->getProperty()->isNullable()) {
            $type = $type . "|null";
        }
        return $name . ": " . $type . ";";
    }

    public function getHeader(string $class): string
    {
       return "\nexport interface " . $class . " {\n\t";
    }

    public function getFooter(string $class): string
    {
       return "\n}\n";
    }
}

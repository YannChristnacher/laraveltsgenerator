<?php

namespace Ycp\LaravelTsGenerator\Application\Adapter;

use Ycp\LaravelTsGenerator\Application\Dto\EnumCaseDto;
use Ycp\LaravelTsGenerator\Application\Dto\MappedDto;
use Ycp\LaravelTsGenerator\Base\Abstracts\AdapterAbstract;

class EnumAdapter extends AdapterAbstract
{

    /**
     * @param EnumCaseDto $data
     * @return string
     */
    public function adapt(mixed $data): string
    {
        $name = $data->getName();
        $value = $data->getValue();
        $render= $name;
        if($value) {
            if(is_string($value)) $value = '"'.$value.'"';
            $render .= " = " . $value;
        }
        $render .= ",";
        return $render;
    }

    public function getHeader(string $class): string
    {
        return "\nexport enum " . $class . " {\n\t";
    }

    public function getFooter(string $class): string
    {
        return "\n}\n";
    }
}

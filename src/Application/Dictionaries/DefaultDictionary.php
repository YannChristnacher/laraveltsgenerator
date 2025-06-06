<?php

namespace Ycp\LaravelTsGenerator\Application\Dictionaries;

use Ycp\LaravelTsGenerator\Base\Abstracts\DictionaryAbstract;
use Ycp\LaravelTsGenerator\Base\Interfaces\IDictionary;


class DefaultDictionary extends DictionaryAbstract
{

    public function getMapping(): array
    {
       return [
           "integer" => "number",
           "int" => "number",
           "float" => "number",

           "string" => "string",
           "varchar" => "string",
           "date" => "string",
           "datetime" => "string",
           "text" => "string",

           "array" => "any[]",
           "mixed" => "any",
           "json" => "any"
       ];
    }
}

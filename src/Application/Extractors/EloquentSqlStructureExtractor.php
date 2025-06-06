<?php

namespace Ycp\LaravelTsGenerator\Application\Extractors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Base\Interfaces\IExtractor;

class EloquentSqlStructureExtractor implements IExtractor
{

    /**
     * Extracts property data from a given model's database table schema.
     *
     * This method inspects the provided class to determine if it is a Model instance.
     * If it is a model, the corresponding database table schema is queried to generate
     * an array of property data. Each property is represented as a PropertyDto object,
     * capturing the column's name, type, nullability, and other related attributes.
     *
     * @param ReflectionClass $reflectionClass The reflection class of the model to extract properties from.
     * @param mixed ...$params Additional parameters that may be passed to the method.
     *
     * @return array An array of PropertyDto objects representing the properties of the model's table.
     */
    public function extract(ReflectionClass $reflectionClass, ...$params): array
    {
        $properties = [];
        if($this->isModel($reflectionClass) === false) return [];

        /** @var Model $model */
        $model = $reflectionClass->newInstance();
        $tableName = $model->getTable();

        if (!Schema::hasTable($tableName)) {
            return $properties;
        }

        foreach (Schema::getColumns($tableName) as $column) {
            $properties[] = new PropertyDto(
                name:  $column['name'],
                type: $column['type'],
                isNullable: (bool)$column['nullable'],
                isOptional: false,
                isRelatedClass: false,
                isArray: false
            );
        }

        return $properties;

    }

    private function isModel(\ReflectionClass $reflectionClass): bool
    {
        if($reflectionClass->isSubclassOf(Model::class)) return true;
        return false;
    }
}

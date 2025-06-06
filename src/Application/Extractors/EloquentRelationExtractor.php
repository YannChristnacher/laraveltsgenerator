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
use ReflectionMethod;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Base\Interfaces\IExtractor;

class EloquentRelationExtractor implements IExtractor
{

    /**
     * Extracts relationships from a given ReflectionClass instance.
     *
     * Iterates through the public methods of the class, invoking each method
     * to determine if it is a relationship. If a method yields a valid relationship,
     * it constructs a PropertyDto containing information about the relationship.
     *
     * @param ReflectionClass $reflectionClass The reflection class instance.
     * @param mixed ...$params Additional parameters, if any.
     * @return array An array of PropertyDto objects representing the relationships.
     */
    public function extract(ReflectionClass $reflectionClass, ...$params): array
    {
        $properties = [];
        if($this->isModel($reflectionClass) === false) return [];

        $relationships = [];

        foreach ($reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            try {
                $result = $method->invoke($reflectionClass->newInstance());

                if ($result instanceof Relation) {
                    $relatedClass = get_class($result->getRelated());
                    $isCollection = $this->isCollectionRelationship($result);

                    $relationships[] = new PropertyDto(
                        name: $method->getName(),
                        type: $relatedClass,
                        isRelatedClass: true,
                        isArray: $isCollection
                    );
                }
            } catch (\Throwable $e) {
                // Skip methods that throw exceptions
                continue;
            }



        }
        return $relationships;
    }
    private function isModel(\ReflectionClass $reflectionClass): bool
    {
        if($reflectionClass->isSubclassOf(Model::class)) return true;
        return false;
    }
    private function isCollectionRelationship($relation): bool
    {
        return $relation instanceof \Illuminate\Database\Eloquent\Relations\HasMany ||
            $relation instanceof \Illuminate\Database\Eloquent\Relations\BelongsToMany ||
            $relation instanceof \Illuminate\Database\Eloquent\Relations\MorphMany;
    }
}

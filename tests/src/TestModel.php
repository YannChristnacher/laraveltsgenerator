<?php

namespace Ycp\LaravelTsGenerator\Tests\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ycp\LaravelTsGenerator\Application\Dto\PropertyDto;
use Ycp\LaravelTsGenerator\Base\Interfaces\IExtractByMethod;

class TestModel extends Model implements IExtractByMethod
{
    protected $table = 'test_model';

    public string $myProperty;
    public TestModel $myRelatedProperty;

    protected $fillable = [
        'title',
        'content',
    ];

    public function relationOne(): HasOne
    {
        return $this->hasOne(TestModel::class);
    }

    public function relationMany(): HasMany
    {
        return $this->hasMany(TestModel::class);
    }

    public function extractByMethod(): array
    {
        return [
            new PropertyDto(name: "myProperty", type: "string"),
        ];
    }
}

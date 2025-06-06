<?php

namespace Ycp\LaravelTsGenerator\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Ycp\LaravelTsGenerator\LaravelTsGeneratorServiceProvider;
use Ycp\LaravelTsGenerator\Tests\src\TestEnum;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

class TestCase extends Orchestra
{
    public static array $entries = [
        "base" => [
            "enabled" => true,
            "input" => [
                "specified_class" => [TestModel::class],

            ],
            'excluded_properties' => [],
            "provider" => \Ycp\LaravelTsGenerator\Application\Providers\ClassProvider::class
        ],
        "enum" => [
            "enabled" => true,
            "input" => [
                "specified_class" => [TestEnum::class],

            ],
            'excluded_properties' => [],
            "provider" => \Ycp\LaravelTsGenerator\Application\Providers\EnumProvider::class
        ]
    ];

    public static string $outputPath = __DIR__ . "/src/generated";
    public static string $outputFileName = "types.generated.ts";

    protected function setUp(): void
    {
        parent::setUp();


    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelTsGeneratorServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/src/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }

    }

    public function setConfigTestingValues(): void
    {
        config()->set("laraveltsgenerator.entries", self::$entries);
        config()->set("laraveltsgenerator.output.path", self::$outputPath);
        config()->set("laraveltsgenerator.output.filename", self::$outputFileName);
    }
}

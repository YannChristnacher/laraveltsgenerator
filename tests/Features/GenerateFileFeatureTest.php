<?php

use Illuminate\Support\Str;
use Ycp\LaravelTsGenerator\Application\Dto\EntryConfigDto;
use Ycp\LaravelTsGenerator\Application\Generator\Generator;
use Ycp\LaravelTsGenerator\Services\ConfigService;
use Ycp\LaravelTsGenerator\Services\OutputService;
use Ycp\LaravelTsGenerator\Tests\TestCase;

it('can transform all entries & check file generated', function () {
    $this->setConfigTestingValues();

    $entries = ConfigService::getEntries();
    $result = "";
    $path = TestCase::$outputPath . "/" . TestCase::$outputFileName;

    if(file_exists($path))unlink($path);

    foreach ($entries as $key => $entry) {
        $entry = EntryConfigDto::initFromConfig($key, $entry);
        $generator = new Generator($entry);
        $result .= $generator->generate();
    }
    OutputService::save($result);


    $this->assertFileExists($path);

    $file = file_get_contents($path);
    $this->assertTrue(Str::contains($file, "export interface TestModel {"));
    $this->assertTrue(Str::contains($file, "relationOne: TestModel;"));
    $this->assertTrue(Str::contains($file, "relationMany: TestModel;"));
    $this->assertTrue(Str::contains($file, "id: number;"));
    $this->assertTrue(Str::contains($file, "title: string;"));
    $this->assertTrue(Str::contains($file, "content: string|null;"));
    $this->assertTrue(Str::contains($file, "created_at: string|null;"));
    $this->assertTrue(Str::contains($file, "updated_at: string|null;"));
    $this->assertTrue(Str::contains($file, "myProperty: string;"));
    $this->assertTrue(Str::contains($file, "myRelatedProperty: TestModel;"));
    $this->assertTrue(Str::contains($file, "}"));
});

<?php

use Ycp\LaravelTsGenerator\Services\ConfigService;
use Ycp\LaravelTsGenerator\Tests\TestCase;

it('can get entries in config', function () {
    $this->setConfigTestingValues();

    $values = ConfigService::getEntries();
    $this->assertSame($values, TestCase::$entries);
});

it('can get output path in config', function () {
    $this->setConfigTestingValues();

    $values = ConfigService::getOutputPath();
    $this->assertSame($values, TestCase::$outputPath);
});

it('can get output filename in config', function () {
    $this->setConfigTestingValues();

    $values = ConfigService::getOutputFileName();
    $this->assertSame($values, TestCase::$outputFileName);
});

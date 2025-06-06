<?php

use Ycp\LaravelTsGenerator\Services\OutputService;
use Ycp\LaravelTsGenerator\Tests\TestCase;

it('can get save result in file', function () {
    $this->setConfigTestingValues();
    config()->set("laraveltsgenerator.output.filename", "service_test_save.ts");

    $path = TestCase::$outputPath . "/" . "service_test_save.ts";
    if(file_exists($path))unlink($path);
    $value = OutputService::save("my content");

    $this->assertTrue($value);
    $this->assertFileExists($path);

    $content = file_get_contents($path, true);
    $this->assertSame("my content", $content);
});

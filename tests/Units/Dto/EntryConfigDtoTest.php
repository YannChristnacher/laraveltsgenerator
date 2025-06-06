<?php

use Ycp\LaravelTsGenerator\Application\Dto\EntryConfigDto;
use Ycp\LaravelTsGenerator\Services\ConfigService;
use Ycp\LaravelTsGenerator\Tests\src\TestModel;

it('can init from config entry', function () {
    $this->setConfigTestingValues();
    $values = ConfigService::getEntries();
    $dto = EntryConfigDto::initFromConfig("base", $values["base"]);

    $this->assertTrue($dto->getName() === "base");
    $this->assertTrue($dto->getProvider() === \Ycp\LaravelTsGenerator\Application\Providers\ClassProvider::class);
    $this->assertTrue($dto->getNamespaces() === []);
    $this->assertTrue($dto->getPaths() === []);
    $this->assertTrue($dto->getSpecifiedClasses() === [TestModel::class]);
    $this->assertTrue($dto->getExcludedProperties() === []);
});

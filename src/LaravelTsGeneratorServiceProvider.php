<?php

namespace Ycp\LaravelTsGenerator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ycp\LaravelTsGenerator\Commands\LaravelTsGeneratorCommand;

class LaravelTsGeneratorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laraveltsgenerator')
            ->hasConfigFile()
            ->hasCommand(LaravelTsGeneratorCommand::class);
    }
}

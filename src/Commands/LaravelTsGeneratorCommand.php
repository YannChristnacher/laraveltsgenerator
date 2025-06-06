<?php

namespace Ycp\LaravelTsGenerator\Commands;

use Illuminate\Console\Command;
use Ycp\LaravelTsGenerator\Application\Dto\EntryConfigDto;
use Ycp\LaravelTsGenerator\Application\Generator\Generator;
use Ycp\LaravelTsGenerator\Services\ConfigService;
use Ycp\LaravelTsGenerator\Services\OutputService;

class LaravelTsGeneratorCommand extends Command
{
    public $signature = 'make:ts-generate';
    protected $description = 'Génère une déclaration TypeScript à partir d’une enum ou d’une classe PHP';


    /**
     * @throws \ReflectionException
     */
    public function handle(): int
    {
        $entries = ConfigService::getEntries();
        $result = "";

        $this->info('🚀 Génération des interfaces TypeScript');
        foreach ($entries as $key => $entry){
            $this->info("📄  Entrée : " . $key);
            $entry = EntryConfigDto::initFromConfig($key, $entry);

            $this->info("⌛  Génération en cours ...  ");
            $generator = new Generator($entry);
            $result .=$generator->generate();
            $this->info('✅  Génération terminée : ');
        }
        OutputService::save($result);
        $this->info('💾  Enregristement terminée : ' . ConfigService::getOutputPath() . ConfigService::getOutputFileName());
        return self::SUCCESS;

    }



}

<?php

namespace Ycp\LaravelTsGenerator\Commands;

use Illuminate\Console\Command;

class LaravelTsGeneratorCommand extends Command
{
    public $signature = 'laraveltsgenerator';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

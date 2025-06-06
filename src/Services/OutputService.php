<?php

namespace Ycp\LaravelTsGenerator\Services;

class OutputService
{
    /**
     * Saves the given content to a file at a designated output path.
     *
     * The output path and file name are determined by the ConfigService.
     * If the directory does not exist, it will be created with the appropriate
     * permissions.
     *
     * @param string $content The content to be saved to the file.
     * @return bool Returns true on success or false on failure.
     */
    public static function save(string $content): bool
    {
        $dir = ConfigService::getOutputPath();
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

       return file_put_contents("$dir/".ConfigService::getOutputFileName(), $content);
    }
}

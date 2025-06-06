<?php

namespace Ycp\LaravelTsGenerator\Services;


class ConfigService
{
    /**
     * Retrieves the entries configuration for the Laravel TypeScript generator.
     *
     * @return array|null The configured entries or null if not set.
     */
    public static function getEntries(): ?array
    {
        return config('laraveltsgenerator.entries');
    }

    /**
     * Retrieves the output path configuration for the Laravel TypeScript generator.
     *
     * @return string The configured output path.
     */
    public static function getOutputPath(): string
    {
        return config('laraveltsgenerator.output.path', resource_path("types/shared"));
    }

    /**
     * Retrieves the output file name configuration for the Laravel TypeScript generator.
     *
     * @return string The configured output file name.
     */
    public static function getOutputFileName(): string
    {
        return config('laraveltsgenerator.output.filename', "types.generated.ts");
    }
}

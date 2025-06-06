<?php

// config for Ycp/LaravelTsGenerator
return [

    /*
     |-----------------------------------------------------------
     | Definition of entries
     |-----------------------------------------------------------

     List for each entry:
     - If the entry is active or not
     - Element concerned (can be namespace, path or specified class)
     - If specified properties must be excluded for the generation
     - The linked provider
     */
    "entries" => [
        "base" => [
            "enabled" => true,
            "input" => [
                "specified_class" => [],
                "namespaces" => [],
                "paths" => [],
            ],
            'excluded_properties' => [],
            "provider" => \Ycp\LaravelTsGenerator\Application\Providers\ClassProvider::class
        ]

    ],

    /*
     |-----------------------------------------------------------
     | Definition of the output
     |-----------------------------------------------------------

     Output options:
     - The path where the file must be generated
     - The name of the file
     */
    "output" => [
        "path" => resource_path("./types/shared"),
        "filename" => "types.generated.ts"
    ]
];

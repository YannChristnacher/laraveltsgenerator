<?php

namespace Ycp\LaravelTsGenerator\Services;

use HaydenPierce\ClassFinder\ClassFinder;
use Symfony\Component\Finder\Finder;
use Ycp\LaravelTsGenerator\Application\Dto\EntryConfigDto;

/**
 * Service that is responsible for finding class definitions within specific paths, namespaces,
 * or user-specified class declarations in a Laravel application's file structure.
 */
class ClassFinderService
{
    protected Finder $finder;

    public function __construct()
    {
        $this->finder = new Finder();
    }

    /**
     * @param EntryConfigDto $entryConfigDto
     * @return array
     * @throws \Exception
     */
    public function findClassesInEntry(EntryConfigDto $entryConfigDto): array
    {
        $list = [];
        $list = array_merge($list, $this->findByPaths($entryConfigDto->getPaths()));
        foreach ($entryConfigDto->getNamespaces() as $namespace) {
            $list = array_merge($list, $this->findByNamespace($namespace));
        }
        $list = array_merge($list, $entryConfigDto->getSpecifiedClasses());
        return array_unique($list);
    }

    public function findByPaths(array $paths):array
    {
        $result = [];
        foreach ($paths as $path) {
            if (!is_dir(base_path($path))) {
                if( $find =  $this->findByPath($path)) $result[] = $find;
            }

           $files = $this->finder->files()->in(base_path($path))->name('*.php');

            foreach ($files as $file) {
                if( $find =  $this->findByPath($file->getPathname())) $result[] = $find;
            }
        }
        return $result;
    }

    public function findByPath(string $path):?string
    {
        $extract = $this->extractClassNameFromFile($path);
        if($extract){
             return $extract;
        }
        return null;
    }

    /**
     * @throws \Exception
     */
    public function findByNamespace(string $namespace):array
    {
        return array_values(ClassFinder::getClassesInNamespace($namespace));
    }


    /**
     * @param string $filePath
     * @return string|null
     */
    private function extractClassNameFromFile(string $filePath): ?string
    {
        $content = file_get_contents($filePath);

        // Extract namespace
        if (preg_match('/namespace\s+([^;]+);/', $content, $namespaceMatches)) {
            $namespace = trim($namespaceMatches[1]);
        } else {
            $namespace = '';
        }

        // Extract class name
        if (preg_match('/(?:class|enum|interface)\s+(\w+)/', $content, $classMatches)) {
            $className = $classMatches[1];
            return $namespace ? $namespace . '\\' . $className : $className;
        }

        return null;
    }
}

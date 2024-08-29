<?php

declare(strict_types=1);

namespace App\Service;

use Exception;
use Generator;

/**
 * Class FileReader
 * Service to check if file exists and read a file line by line
 */
readonly class FileReader
{
    public function fileExists(string $path): bool
    {
        return file_exists($path);
    }

    /**
     * @throws Exception
     */
    public function readByLine(string $path): Generator
    {
        if (!$this->fileExists($path)) {
            throw new Exception('File not found: ' . $path);
        }

        $fileHandle = fopen($path, 'r');
        while (!feof($fileHandle)) {
            $line = fgets($fileHandle);
            if (empty($line)) {
                continue;
            }
            yield $line;
        }

        fclose($fileHandle);
    }
}

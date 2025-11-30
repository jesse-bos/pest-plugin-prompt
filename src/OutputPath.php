<?php

declare(strict_types=1);

namespace Pest\Prompt;

class OutputPath
{
    private static ?string $outputPath = null;

    public static function set(string $path): void
    {
        self::$outputPath = $path;
    }

    public static function get(): ?string
    {
        return self::$outputPath;
    }

    public static function has(): bool
    {
        return self::$outputPath !== null;
    }

    public static function clear(): void
    {
        self::$outputPath = null;
    }

    public static function generate(string $path): string
    {
        // Ensure folder path ends with directory separator
        $folderPath = rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

        return $folderPath.self::generateFilename();
    }

    private static function generateFilename(): string
    {
        $datetime = date('Y-m-d-H-i-s');

        return $datetime.'.html';
    }
}

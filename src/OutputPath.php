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

    public static function withHtmlFallback(string $path): string
    {
        $pathInfo = pathinfo($path);

        if (! isset($pathInfo['extension']) || $pathInfo['extension'] === '') {
            return $path.'.html';
        }

        return $path;
    }
}

<?php

declare(strict_types=1);

namespace Pest\Prompt;

class Output
{
    private function __construct(private readonly ?string $path = null) {}

    public static function toFolder(?string $path): self
    {
        return new self($path);
    }

    public function generate(): string
    {
        // Ensure folder path ends with directory separator
        $folderPath = rtrim($this->path ?: '', DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

        return $folderPath.$this->generateFilename();
    }

    private function generateFilename(): string
    {
        /** @phpstan-ignore-next-line */
        $testName = (string) test()->name();
        $datetime = date('Y-m-d_His');

        // Remove Pest's internal prefix
        $testName = str_replace('__pest_evaluable_', '', $testName);

        // Sanitize test name for filename (convert special characters to underscores, like Pest does)
        $sanitizedTestName = (string) preg_replace('/[^a-zA-Z0-9-_]/', '_', $testName);
        $sanitizedTestName = (string) preg_replace('/_+/', '_', $sanitizedTestName); // Replace multiple underscores with single underscore
        $sanitizedTestName = trim($sanitizedTestName, '_'); // Remove leading/trailing underscores

        return $datetime.'_'.$sanitizedTestName.'.html';
    }
}

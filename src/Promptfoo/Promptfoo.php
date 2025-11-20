<?php

declare(strict_types=1);

namespace Pest\Prompt\Promptfoo;

class Promptfoo
{
    private static string $promptfooCommand = 'npx playwright@latest';

    public static function initialize(): PromptfooClient
    {
        return new PromptfooClient(self::$promptfooCommand);
    }
}

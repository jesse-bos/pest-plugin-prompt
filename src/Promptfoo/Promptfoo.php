<?php

declare(strict_types=1);

namespace Pest\Prompt\Promptfoo;

use Pest\Prompt\Api\Evaluation;

class Promptfoo
{
    private static string $promptfooCommand = 'npx playwright@latest';

    /**
     * @var string[]
     */
    private static array $defaultProviders = ['openai:gpt-4o-mini'];

    public static function initialize(): PromptfooClient
    {
        return new PromptfooClient(self::$promptfooCommand);
    }

    public static function evaluate(Evaluation $evaluationBuilder): EvaluationResult
    {
        return self::initialize()->evaluate($evaluationBuilder);
    }

    /**
     * @return string[]
     */
    public static function defaultProviders(): array
    {
        return self::$defaultProviders;
    }

    public static function setDefaultProviders(array $defaultProviders): void
    {
        self::$defaultProviders = $defaultProviders;
    }
}

<?php

declare(strict_types=1);

namespace Pest\Prompt;

use Pest\Prompt\Api\EvaluationBuilder;

class TestContext
{
    /** @var EvaluationBuilder[] */
    private static array $evaluations = [];

    /**
     * @return EvaluationBuilder[]
     */
    public static function getCurrentEvaluations(): array
    {
        return self::$evaluations;
    }

    public static function addEvaluation(EvaluationBuilder $evaluation): void
    {
        self::$evaluations[] = $evaluation;
    }

    public static function clear(): void
    {
        self::$evaluations = [];
    }
}

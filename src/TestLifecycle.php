<?php

declare(strict_types=1);

namespace Pest\Prompt;

use Pest\Prompt\Promptfoo\EvaluationResult;

class TestLifecycle
{
    public static function evaluate(): void
    {
        $evaluations = TestContext::getCurrentEvaluations();

        while (count($evaluations) > 0) {
            $evaluation = array_shift($evaluations);

            expect(true)->toBeTrue();
            self::handleEvaluationResult($evaluation->evaluate());
        }

        TestContext::clear();
    }

    private static function handleEvaluationResult(EvaluationResult $evaluationResult): void {}
}

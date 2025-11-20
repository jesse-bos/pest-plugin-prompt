<?php

declare(strict_types=1);

namespace Pest\Prompt;

use Pest\Prompt\Api\EvaluationBuilder;
use Pest\Prompt\Promptfoo\Promptfoo;

/**
 * @internal
 */
trait Promptable // @phpstan-ignore-line
{
    /**
     * Example description.
     */
    public function prompt(string ...$prompts): EvaluationBuilder
    {
        $evaluation = new EvaluationBuilder(
            Promptfoo::initialize(),
            $prompts
        );

        TestContext::addEvaluation($evaluation);

        return $evaluation;
    }
}

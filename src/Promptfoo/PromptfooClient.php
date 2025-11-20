<?php

declare(strict_types=1);

namespace Pest\Prompt\Promptfoo;

use Pest\Prompt\Api\EvaluationBuilder;
use Pest\Prompt\Contracts\EvaluatorClient;

class PromptfooClient implements EvaluatorClient
{
    public function __construct(private string $promptfooCommand, private array $options = []) {}

    public function evaluate(EvaluationBuilder $evaluationBuilder): EvaluationResult
    {
        return new EvaluationResult([], []);
    }
}

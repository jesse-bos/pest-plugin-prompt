<?php

namespace Pest\Prompt\Contracts;

use Pest\Prompt\Api\EvaluationBuilder;
use Pest\Prompt\Promptfoo\EvaluationResult;

interface EvaluatorClient
{
    public function evaluate(EvaluationBuilder $evaluationBuilder): EvaluationResult;
}

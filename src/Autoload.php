<?php

declare(strict_types=1);

namespace Pest\Prompt;

use Pest\Plugin;
use Pest\Prompt\Api\EvaluationBuilder;

Plugin::uses(Promptable::class);

function prompt(string ...$prompts): EvaluationBuilder
{
    return test()->prompt(...$prompts); // @phpstan-ignore-line
}

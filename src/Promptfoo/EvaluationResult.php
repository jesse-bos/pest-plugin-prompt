<?php

declare(strict_types=1);

namespace Pest\Prompt\Promptfoo;

class EvaluationResult
{
    /** @param array<int, array<string, mixed>> $results */
    public function __construct(private readonly array $results, /** @var array<string, mixed> */ private array $stats = []) {}
}

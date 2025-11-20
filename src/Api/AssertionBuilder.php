<?php

declare(strict_types=1);

namespace Pest\Prompt\Api;

use Pest\Prompt\Promptfoo\Assertion;

class AssertionBuilder
{
    public function __construct(
        private readonly TestCaseBuilder $testCaseBuilder,
        private readonly EvaluationBuilder $evaluationBuilder,
    ) {}

    /**
     * @param  array<string,mixed>  $options
     */
    public function toContain(string $contains, bool $strict = false, ?float $threshold = null, array $options = []): self
    {
        $this->testCaseBuilder->assert(new Assertion(
            $strict ? 'contains' : 'icontain',
            $contains,
            $threshold,
            $options,
        ));

        return $this;
    }

    /**
     * @param  array<string,mixed>  $variables
     */
    public function and(array $variables): AssertionBuilder
    {
        return $this->evaluationBuilder->expect($variables);
    }
}

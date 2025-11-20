<?php

declare(strict_types=1);

namespace Pest\Prompt\Api;

use Pest\Prompt\Contracts\EvaluatorClient;
use Pest\Prompt\Promptfoo\EvaluationResult;

class EvaluationBuilder
{
    /** @var string[] */
    private array $prompts = [];

    /** @var string[] */
    private array $providers = [];

    /** @var TestCaseBuilder[] */
    private array $testCases = [];

    public function __construct(
        private readonly EvaluatorClient $evaluatorClient,
        array $prompts
    ) {
        $this->prompts = $prompts;
    }

    public function usingProvider(string ...$providers): self
    {
        foreach ($providers as $provider) {
            $this->providers[] = $provider;
        }

        return $this;
    }

    /**
     * @param  array<string,mixed>  $variables
     */
    public function expect(array $variables = []): AssertionBuilder
    {
        $testCase = new TestCaseBuilder($variables);
        $this->testCases[] = $testCase;

        return new AssertionBuilder($testCase, $this);
    }

    public function evaluate(): EvaluationResult
    {
        return $this->evaluatorClient->evaluate($this);
    }
}

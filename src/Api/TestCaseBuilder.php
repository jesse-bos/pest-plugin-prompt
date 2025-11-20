<?php

declare(strict_types=1);

namespace Pest\Prompt\Api;

use Pest\Prompt\Promptfoo\Assertion;

class TestCaseBuilder
{
    private array $assertions = [];

    public function __construct(
        private readonly array $variables = [],
    ) {}

    public function assert(Assertion $assertion): self
    {
        $this->assertions[] = $assertion;

        return $this;
    }
}

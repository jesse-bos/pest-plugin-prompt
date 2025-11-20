<?php

declare(strict_types=1);

namespace Pest\Prompt\Promptfoo;

class Assertion
{
    public function __construct(
        private readonly string $type,
        private readonly mixed $value,
        private readonly ?float $threshold = null,
        /** @var array<string, mixed>|null */
        private readonly ?array $options = null
    ) {}
}

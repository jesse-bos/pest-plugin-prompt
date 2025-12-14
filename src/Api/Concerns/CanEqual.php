<?php

declare(strict_types=1);

namespace KevinPijning\Prompt\Api\Concerns;

use KevinPijning\Prompt\Api\Assertion;

trait CanEqual
{
    public function toEqual(mixed $value): self
    {
        return $this->assert(new Assertion(
            type: 'equals',
            value: $value,
        ));
    }
}

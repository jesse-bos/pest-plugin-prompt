<?php

declare(strict_types=1);

use KevinPijning\Prompt\Api\Evaluation;
use KevinPijning\Prompt\Promptable;
use KevinPijning\Prompt\TestContext;

beforeEach(function () {
    TestContext::clear();
});

test('Promptable trait provides prompt method', function () {
    $testClass = new class
    {
        use Promptable;
    };

    $result = $testClass->prompt('test prompt');

    expect($result)->toBeInstanceOf(Evaluation::class)
        ->and(TestContext::getCurrentEvaluations())->toHaveCount(1);
});

test('Promptable trait prompt method can accept multiple prompts', function () {
    $testClass = new class
    {
        use Promptable;
    };

    $result = $testClass->prompt('prompt1', 'prompt2', 'prompt3');

    expect($result)->toBeInstanceOf(Evaluation::class)
        ->and($result->prompts())->toBe(['prompt1', 'prompt2', 'prompt3']);
});

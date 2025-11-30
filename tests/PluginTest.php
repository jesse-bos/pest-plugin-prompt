<?php

declare(strict_types=1);

use Pest\Prompt\Output;
use Pest\Prompt\Plugin;

beforeEach(function () {
    Output::clear();
});

test('handle arguments uses default path when --output is provided without value', function () {
    $plugin = new Plugin;

    $result = $plugin->handleArguments(['script.php', '--output']);

    expect(Output::has())->toBeTrue()
        ->and(Output::get())->toBe('prompt-tests-output')
        ->and($result)->not->toContain('--output');
});

test('handle arguments sets output path when valid folder is provided', function () {
    $plugin = new Plugin;

    $result = $plugin->handleArguments(['script.php', '--output', 'custom-folder']);

    expect(Output::has())->toBeTrue()
        ->and(Output::get())->toBe('custom-folder')
        ->and($result)->not->toContain('--output');
});

test('handle arguments sets output path when using equals syntax', function () {
    $plugin = new Plugin;

    $result = $plugin->handleArguments(['script.php', '--output=custom-folder']);

    expect(Output::has())->toBeTrue()
        ->and(Output::get())->toBe('custom-folder')
        ->and($result)->not->toContain('--output');
});

test('handle arguments removes output value from arguments array', function () {
    $plugin = new Plugin;

    $result = $plugin->handleArguments(['script.php', '--output', 'test-output', 'other-arg']);

    expect($result)->toBe(['script.php', 'other-arg'])
        ->and($result)->not->toContain('test-output')
        ->and($result)->not->toContain('--output');
});

test('handle arguments returns arguments unchanged when --output is not provided', function () {
    $plugin = new Plugin;

    $arguments = ['script.php', '--other-option', 'value'];
    $result = $plugin->handleArguments($arguments);

    expect($result)->toBe($arguments)
        ->and(Output::has())->toBeFalse();
});

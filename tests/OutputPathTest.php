<?php

declare(strict_types=1);

use Pest\Prompt\Output;

beforeEach(function () {
    Output::clear();
});

test('has returns false by default', function () {
    expect(Output::has())->toBeFalse();
});

test('get returns null by default', function () {
    expect(Output::get())->toBeNull();
});

test('set sets the path', function () {
    $path = '/path/to/output.html';

    Output::set($path);

    expect(Output::has())->toBeTrue()
        ->and(Output::get())->toBe($path);
});

test('clear resets the output path', function () {
    Output::set('/path/to/output.html');

    Output::clear();

    expect(Output::has())->toBeFalse()
        ->and(Output::get())->toBeNull();
});

test('set overwrites previous path', function () {
    Output::set('/first/path.html');

    Output::set('/second/path.html');

    expect(Output::get())->toBe('/second/path.html');
});

test('generate sanitizes special characters: (test) with [special] chars!', function () {
    $result = Output::generate('output');

    // Should sanitize special characters from test name (spaces, colons, parentheses, brackets become underscores, like Pest does)
    // The exact path format: output/datetime_sanitized_test_name.html
    // Special characters are converted to underscores to match Pest's internal format
    expect($result)->toMatch('/^output\/\d{4}_\d{2}_\d{2}_\d{2}_\d{2}_\d{2}_generate_sanitizes_special_characters_test_with_special_chars\.html$/')
        ->and($result)->not->toContain('(')
        ->and($result)->not->toContain(')')
        ->and($result)->not->toContain('[')
        ->and($result)->not->toContain(']')
        ->and($result)->not->toContain(':')
        ->and($result)->not->toContain(' ');
});

<?php

declare(strict_types=1);

use Pest\Prompt\OutputPath;

beforeEach(function () {
    OutputPath::clear();
});

test('has returns false by default', function () {
    expect(OutputPath::has())->toBeFalse();
});

test('get returns null by default', function () {
    expect(OutputPath::get())->toBeNull();
});

test('set sets the path', function () {
    $path = '/path/to/output.html';

    OutputPath::set($path);

    expect(OutputPath::has())->toBeTrue()
        ->and(OutputPath::get())->toBe($path);
});

test('clear resets the output path', function () {
    OutputPath::set('/path/to/output.html');

    OutputPath::clear();

    expect(OutputPath::has())->toBeFalse()
        ->and(OutputPath::get())->toBeNull();
});

test('set overwrites previous path', function () {
    OutputPath::set('/first/path.html');

    OutputPath::set('/second/path.html');

    expect(OutputPath::get())->toBe('/second/path.html');
});

test('generate sanitizes special characters: (test) with [special] chars!', function () {
    $result = OutputPath::generate('output');

    // Should sanitize special characters from test name (spaces, colons, parentheses, brackets become underscores, like Pest does)
    // The exact path format: output/datetime_sanitized_test_name_counter.html
    // Special characters are converted to underscores to match Pest's internal format
    expect($result)->toMatch('/^output\/\d{4}_\d{2}_\d{2}_\d{2}_\d{2}_\d{2}_generate_sanitizes_special_characters_test_with_special_chars_1\.html$/')
        ->and($result)->not->toContain('(')
        ->and($result)->not->toContain(')')
        ->and($result)->not->toContain('[')
        ->and($result)->not->toContain(']')
        ->and($result)->not->toContain(':')
        ->and($result)->not->toContain(' ');
});

test('generate increments counter for multiple calls in same test', function () {
    $result1 = OutputPath::generate('output');
    $result2 = OutputPath::generate('output');
    $result3 = OutputPath::generate('output');

    // All should have the same test name but different counter
    expect($result1)->toMatch('/_generate_increments_counter_for_multiple_calls_in_same_test_1\.html$/')
        ->and($result2)->toMatch('/_generate_increments_counter_for_multiple_calls_in_same_test_2\.html$/')
        ->and($result3)->toMatch('/_generate_increments_counter_for_multiple_calls_in_same_test_3\.html$/');
});

test('generate resets counter for new test', function () {
    // First test - generate once
    $result1 = OutputPath::generate('output');

    // Clear to simulate new test (this happens in beforeEach)
    OutputPath::clear();

    // New test - counter should start at 1 again
    $result2 = OutputPath::generate('output');

    // Both should have counter 1
    expect($result1)->toMatch('/_generate_resets_counter_for_new_test_1\.html$/')
        ->and($result2)->toMatch('/_generate_resets_counter_for_new_test_1\.html$/');
});

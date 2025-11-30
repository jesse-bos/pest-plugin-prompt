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

test('generate always treats path as folder and adds datetime filename', function () {
    $result1 = OutputPath::generate('path/to/results');
    $result2 = OutputPath::generate('pest-prompt-tests');
    $result3 = OutputPath::generate('path/to/results.html');
    $result4 = OutputPath::generate('path/to/results.json');

    // Should always start with folder path and end with datetime.html
    expect($result1)->toStartWith('path/to/results/')
        ->and($result1)->toEndWith('.html')
        ->and($result1)->toMatch('/\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2}\.html$/')
        ->and($result2)->toStartWith('pest-prompt-tests/')
        ->and($result2)->toEndWith('.html')
        ->and($result2)->toMatch('/\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2}\.html$/')
        ->and($result3)->toStartWith('path/to/results.html/')
        ->and($result3)->toEndWith('.html')
        ->and($result3)->toMatch('/\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2}\.html$/')
        ->and($result4)->toStartWith('path/to/results.json/')
        ->and($result4)->toEndWith('.html')
        ->and($result4)->toMatch('/\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2}\.html$/');
});

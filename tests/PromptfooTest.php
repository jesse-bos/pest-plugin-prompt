<?php

use function Pest\Prompt\prompt;

test('oke', function () {

    prompt(
        'translate {{message}} to {{language}}',
        'Convert {{message}} to {{language}}',
    )->usingProvider('openai:gpt-4o-mini')
        ->expect([
            'message' => 'Hello World!',
            'language' => 'es',
        ])
        ->toContain('Hola')
        ->toContain('muda')
        ->and([
            'message' => 'Hello World!',
            'language' => 'nl',
        ])
        ->toContain('Hallo')
        ->toContain('wereld');

    prompt('nice')
        ->usingProvider('openai:gpt-4o-mini')
        ->expect()
        ->toContain('ok');
});

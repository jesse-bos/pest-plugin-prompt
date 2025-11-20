<?php

declare(strict_types=1);

namespace Pest\Prompt;

use Pest\Contracts\Plugins\Bootable;
use Pest\TestSuite;

/**
 * @internal
 */
final class Plugin implements Bootable
{
    public function boot(): void
    {
        pest()->afterEach(function (): void {
            TestLifecycle::evaluate();
        })->in($this->in());
    }

    private function in(): string
    {
        return TestSuite::getInstance()->rootPath.DIRECTORY_SEPARATOR.TestSuite::getInstance()->testPath;
    }
}

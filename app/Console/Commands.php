<?php

namespace App\Console;

use Illuminate\Console\Command;

abstract class Commands extends Command
{
    protected function write(string $component, ...$arguments): void
    {
        with(new $component($this->output))->render(...$arguments);
    }
}

<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\DebuggingConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\DebugHelpers;

trait WithDebugging
{
    use DebuggingConfiguration,
        DebugHelpers;

    /**
     * Dump table properties for debugging
     */
    protected bool $debugStatus = false;
}

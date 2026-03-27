<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\DeferredLoadingConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\DeferredLoadingHelpers;

trait WithDeferredLoading
{
    use DeferredLoadingConfiguration,
        DeferredLoadingHelpers;

    protected bool $deferLoading = false;
}




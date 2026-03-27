<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration;

trait DeferredLoadingConfiguration
{
    /**
     * Enable deferred loading - table data will load asynchronously
     */
    public function deferLoading(): self
    {
        $this->deferLoading = true;

        return $this;
    }

    /**
     * Disable deferred loading
     */
    public function disableDeferredLoading(): self
    {
        $this->deferLoading = false;

        return $this;
    }
}




<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Core;

use Closure;
use SkywalkerLabs\LaravelLivewireTables\View\{Column,Filter};

trait HasLocationCallback
{
    protected mixed $locationCallback = null;

    public function location(callable $callback): self
    {
        $this->locationCallback = $callback;

        return $this;
    }

    public function getLocationCallback(): ?callable
    {
        return $this->locationCallback;
    }

    public function hasLocationCallback(): bool
    {
        return $this->locationCallback !== null;
    }
}

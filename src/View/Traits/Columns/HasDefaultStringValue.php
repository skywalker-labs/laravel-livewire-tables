<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Columns;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use SkywalkerLabs\LaravelLivewireTables\View\{Column,Filter};

trait HasDefaultStringValue
{
    public string $defaultValue = '';

    public function defaultValue(string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }
}

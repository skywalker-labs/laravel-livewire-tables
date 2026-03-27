<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Filters;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use SkywalkerLabs\LaravelLivewireTables\View\{Column,Filter};

trait HasConfig
{
    public function config(array $config = []): self
    {
        $this->config = [...config($this->configPath), ...$config];

        return $this;
    }

    public function getConfigs(): array
    {
        return ! empty($this->config) ? $this->config : $this->config = config($this->configPath);
    }
}

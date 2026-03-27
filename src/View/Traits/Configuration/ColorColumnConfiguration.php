<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration;

use SkywalkerLabs\LaravelLivewireTables\View\Traits\Columns;

trait ColorColumnConfiguration
{
    public function color(callable $callback): self
    {
        $this->colorCallback = $callback;

        return $this;
    }
}

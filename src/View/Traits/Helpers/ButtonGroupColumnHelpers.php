<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers;

use SkywalkerLabs\LaravelLivewireTables\View\Columns\LinkColumn;

trait ButtonGroupColumnHelpers
{
    public function getButtons(): array
    {
        return collect($this->buttons)
            ->reject(fn ($button) => ! $button instanceof LinkColumn)
            ->toArray();
    }
}

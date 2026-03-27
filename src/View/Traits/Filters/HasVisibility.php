<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Filters;

use SkywalkerLabs\LaravelLivewireTables\View\{Column,Filter};
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\HasVisibility as HasCoreVisibility;

trait HasVisibility
{
    use HasCoreVisibility;

    protected bool $hiddenFromFilterCount = false;

    public function isHiddenFromFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === true;
    }

    public function isVisibleInFilterCount(): bool
    {
        return $this->hiddenFromFilterCount === false;
    }

    public function hiddenFromFilterCount(): self
    {
        $this->hiddenFromFilterCount = true;

        return $this;
    }

    public function hiddenFromAll(): self
    {
        $this->hiddenFromMenus = true;
        $this->hiddenFromPills = true;
        $this->hiddenFromFilterCount = true;

        return $this;
    }
}

<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Filters;

use SkywalkerLabs\LaravelLivewireTables\View\Filter;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\HasWireables;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Filters\{IsStringFilter};

class NumberFilter extends Filter
{
    use IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.number';

    public function validate(mixed $value): float|int|bool
    {
        return is_numeric($value) ? $value : false;
    }
}

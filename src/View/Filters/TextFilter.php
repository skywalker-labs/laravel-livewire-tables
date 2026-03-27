<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Filters;

use SkywalkerLabs\LaravelLivewireTables\View\Filter;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\HasWireables;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Filters\{HandlesWildcardStrings, IsStringFilter};

class TextFilter extends Filter
{
    use IsStringFilter;
    use HasWireables;
    use HandlesWildcardStrings;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.text-field';

    public function validate(string $value): string|bool
    {
        if ($this->hasConfig('maxlength')) {
            return strlen($value) <= $this->getConfig('maxlength') ? $value : false;
        }

        return strlen($value) ? $value : false;
    }
}

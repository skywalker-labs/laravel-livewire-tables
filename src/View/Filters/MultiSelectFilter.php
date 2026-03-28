<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Filters;

use SkywalkerLabs\LaravelLivewireTables\View\Filter;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\HasWireables;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Filters\{HasOptions,IsArrayFilter};

class MultiSelectFilter extends Filter
{
    use HasOptions,
        IsArrayFilter;
    use HasWireables;

    public string $wireMethod = 'live.debounce.250ms';

    protected string $view = 'livewire-tables::components.tools.filters.multi-select';

    protected string $configPath = 'livewire-tables.multi_select_filter.default_config';

    protected string $optionsPath = 'livewire-tables.multi_select_filter.default_options';

    public function validate(int|string|array $value): array|int|string|bool
    {
        if (is_array($value)) {
            foreach ($value as $index => $val) {
                // Remove the bad value
                if (! in_array($val, $this->getKeys())) {
                    unset($value[$index]);
                }
            }
        }

        return $value;
    }

    public function getFilterPillValue($value): array|string|bool|null
    {
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item) ?? $this->getOptions()[$item] ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return $values;
    }
}

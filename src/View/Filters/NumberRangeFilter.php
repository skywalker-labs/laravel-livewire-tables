<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Filters;

use SkywalkerLabs\LaravelLivewireTables\View\Filter;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\HasWireables;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Filters\HasOptions;

class NumberRangeFilter extends Filter
{
    use HasOptions;
    use HasWireables;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.number-range';

    protected string $configPath = 'livewire-tables.number_range.default_config';

    public function options(array $options = []): NumberRangeFilter
    {
        $this->options = [...config('livewire-tables.number_range.default_options'), ...$options];

        return $this;
    }

    public function getOptions(): array
    {
        return ! empty($this->options) ? $this->options : $this->options = config('livewire-tables.number_range.default_options');
    }

    public function config(array $config = []): NumberRangeFilter
    {
        $this->config = [...config('livewire-tables.number_range.default_config'), ...$config];

        return $this;
    }

    public function getConfigs(): array
    {
        return ! empty($this->config) ? $this->config : $this->config = config('livewire-tables.number_range.default_config');
    }

    public function validate(array $values): array|bool
    {
        $values['min'] = isset($values['min']) ? intval($values['min']) : null;
        $values['max'] = isset($values['max']) ? intval($values['max']) : null;
        if ($values['min'] == 0 && $values['max'] == 0) {
            return false;
        }
        if ($values['max'] < $values['min']) {
            $tmpMin = $values['min'];
            $values['min'] = $values['max'];
            $values['max'] = $tmpMin;
        }

        if (! isset($values['min']) || ! is_numeric($values['min']) || $values['min'] < intval($this->getConfig('min_range')) || $values['min'] > intval($this->getConfig('max_range'))) {
            return false;
        }
        if (! isset($values['max']) || ! is_numeric($values['max']) || $values['max'] > intval($this->getConfig('max_range')) || $values['max'] < intval($this->getConfig('min_range'))) {
            return false;
        }

        return ['min' => $values['min'], 'max' => $values['max']];
    }

    public function isEmpty(array|string $value): bool
    {
        if (! is_array($value)) {
            return true;
        } else {
            if (! isset($value['min']) || ! isset($value['max']) || $value['min'] == '' || $value['max'] == '') {
                return true;
            }

            if (intval($value['min']) == intval($this->getConfig('min_range')) && intval($value['max']) == intval($this->getConfig('max_range'))) {
                return true;
            }
        }

        return false;
    }

    public function getDefaultValue(): array|string
    {
        return [];
    }

    public function getFilterPillValue($values): array|string|bool|null
    {
        if ($this->validate($values)) {
            return __('Min:').$values['min'].', '.__('Max:').$values['max'];
        }

        return '';
    }
}

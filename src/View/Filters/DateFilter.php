<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Filters;

use SkywalkerLabs\LaravelLivewireTables\View\Filter;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\HasWireables;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Filters\{HandlesDates, HasConfig, IsStringFilter};

class DateFilter extends Filter
{
    use HandlesDates,
        HasConfig,
        IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.date';

    protected string $configPath = 'livewire-tables.dateFilter.defaultConfig';

    public function validate(string $value): string|bool
    {
        $this->setInputDateFormat('Y-m-d')->setOutputDateFormat($this->getConfig('pillFormat') ?? 'Y-m-d');
        $carbonDate = $this->createCarbonDate($value);

        return ($carbonDate === false) ? false : $carbonDate->format('Y-m-d');
    }

    public function getFilterPillValue($value): array|string|bool|null
    {
        if ($this->validate($value)) {
            return $this->outputTranslatedDate($this->createCarbonDate($value));
        }

        return null;
    }
}

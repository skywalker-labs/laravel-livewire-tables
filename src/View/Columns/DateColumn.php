<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Columns;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\DateColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\DateColumnHelpers;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\IsColumn;

class DateColumn extends Column
{
    use IsColumn;
    use DateColumnConfiguration,
        DateColumnHelpers { DateColumnHelpers::getValue insteadof IsColumn; }

    public string $inputFormat = 'Y-m-d';

    public string $outputFormat = 'Y-m-d';

    public string $emptyValue = '';

    protected string $view = 'livewire-tables::includes.columns.date';

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        try {
            $dateTime = $this->getValue($row);
            if ($dateTime != '' && $dateTime != null) {
                if ($dateTime instanceof DateTime) {
                    return $dateTime->format($this->getOutputFormat());
                } else {
                    // Check if format matches what is expected and return Carbon instance if so, otherwise emptyValue
                    return Carbon::canBeCreatedFromFormat($dateTime, $this->getInputFormat()) ? Carbon::createFromFormat($this->getInputFormat(), $dateTime)->format($this->getOutputFormat()) : $this->getEmptyValue();
                }
            }
        } catch (\Exception $exception) {
            return $this->getEmptyValue();
        }

        return $this->getEmptyValue();
    }
}

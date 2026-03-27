<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Columns;

use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\ArrayColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\ArrayColumnHelpers;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\IsColumn;

class ArrayColumn extends Column
{
    use IsColumn,
        ArrayColumnConfiguration,
        ArrayColumnHelpers { ArrayColumnHelpers::getContents insteadof IsColumn; }

    public string $separator = '<br />';

    public string $emptyValue = '';

    protected mixed $dataCallback = null;

    protected mixed $outputFormat = null;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }
}

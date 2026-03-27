<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits;

use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\AggregateColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\AggregateColumnHelpers;

trait IsAggregateColumn
{
    use IsColumn,
        AggregateColumnHelpers,
        AggregateColumnConfiguration { AggregateColumnHelpers::getContents insteadof IsColumn;
            AggregateColumnConfiguration::sortable insteadof IsColumn; }
}

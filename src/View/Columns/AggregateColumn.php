<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Columns;

use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\IsAggregateColumn;

class AggregateColumn extends Column
{
    use IsAggregateColumn;

    public ?string $dataSource;

    public string $aggregateMethod = 'count';

    public ?string $foreignColumn;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}

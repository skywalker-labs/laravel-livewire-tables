<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\GroupingConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\GroupingHelpers;

trait WithGrouping
{
    use GroupingConfiguration,
        GroupingHelpers;

    protected bool $groupingStatus = false;

    protected ?string $groupByColumn = null;

    protected bool $groupsCollapsed = false;

    protected array $expandedGroups = [];
}

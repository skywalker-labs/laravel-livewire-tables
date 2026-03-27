<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits;

use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\FilterConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\{HasConfig,HasView};
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Filters\{HasCustomPosition,HasVisibility};
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\FilterHelpers;

trait IsFilter
{
    use FilterConfiguration,
        FilterHelpers,
        HasConfig,
        HasCustomPosition,
        HasVisibility,
        HasView;

    protected string $name;

    protected string $key;

    protected bool $resetByClearButton = true;

    protected mixed $filterCallback = null;

    protected ?string $filterPillTitle = null;

    protected array $filterPillValues = [];

    protected ?string $filterCustomLabel = null;

    protected array $filterLabelAttributes = [];

    protected ?string $filterCustomPillBlade = null;

    protected mixed $filterDefaultValue = null;

    public array $genericDisplayData = [];
}

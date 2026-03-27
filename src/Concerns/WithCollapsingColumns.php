<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\CollapsingColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\CollapsingColumnHelpers;

trait WithCollapsingColumns
{
    use CollapsingColumnConfiguration;
    use CollapsingColumnHelpers;

    protected bool $collapsingColumnsStatus = true;

    protected array $collapsingColumnButtonCollapseAttributes = ['default-styling' => true, 'default-colors' => true];

    protected array $collapsingColumnButtonExpandAttributes = ['default-styling' => true, 'default-colors' => true];
}

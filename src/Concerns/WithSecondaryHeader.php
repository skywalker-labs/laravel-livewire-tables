<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\SecondaryHeaderConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\SecondaryHeaderHelpers;

trait WithSecondaryHeader
{
    use SecondaryHeaderConfiguration,
        SecondaryHeaderHelpers;

    protected bool $secondaryHeaderStatus = true;

    protected bool $columnsWithSecondaryHeader = false;

    protected ?object $secondaryHeaderTrAttributesCallback;

    protected ?object $secondaryHeaderTdAttributesCallback;

    public function bootedWithSecondaryHeader(): void
    {
        $this->setupSecondaryHeader();
    }

    public function setupSecondaryHeader(): void
    {
        foreach ($this->getColumns() as $column) {
            if ($column->hasSecondaryHeader()) {
                $this->columnsWithSecondaryHeader = true;
            }
        }
    }
}

<?php

declare(strict_types=1);

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\ColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\ColumnHelpers;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\NoColumnsException;

/**
 * Column management for DataTableComponent
 */
trait WithColumns
{
    use ColumnConfiguration;
    use ColumnHelpers;

    /**
     * Collection of table columns
     */
    protected Collection $columns;

    /**
     * Columns prepended to the table
     */
    protected Collection $prependedColumns;

    /**
     * Columns appended to the table
     */
    protected Collection $appendedColumns;

    /**
     * Whether columns should always collapse
     */
    protected ?bool $shouldAlwaysCollapse = null;

    /**
     * Whether columns should collapse on mobile
     */
    protected ?bool $shouldMobileCollapse = null;

    /**
     * Whether columns should collapse on tablet
     */
    protected ?bool $shouldTabletCollapse = null;

    /**
     * Sets up Columns
     */
    public function bootedWithColumns(): void
    {
        $this->columns = collect();

        // Sets Columns
        // Fire Lifecycle Hooks for settingColumns
        $this->callHook('settingColumns');
        $this->callTraitHook('settingColumns');

        // Set Columns
        $this->setColumns();

        // Fire Lifecycle Hooks for columnsSet
        $this->callHook('columnsSet');
        $this->callTraitHook('columnsSet');

        if ($this->columns->count() == 0) {
            throw new NoColumnsException('You must have defined a minimum of one Column for the table to function');
        }

    }

    /**
     * The array defining the columns of the table.
     */
    abstract public function columns(): array;

    /**
     * Prepend columns.
     */
    public function prependColumns(): array
    {
        return [];
    }

    /**
     * Append columns.
     */
    public function appendColumns(): array
    {
        return [];
    }

    /**
     * Add Columns to View
     */
    public function renderingWithColumns(View $view, array $data = []): void
    {
        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'columns' => $this->getColumns(),
            ]);
        }
    }
}

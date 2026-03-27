<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use Illuminate\View\View;
use Livewire\Attributes\Locked;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\ColumnSelectConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\ColumnSelectHelpers;
use SkywalkerLabs\LaravelLivewireTables\Events\ColumnsSelected;
use SkywalkerLabs\LaravelLivewireTables\View\Column;

trait WithColumnSelect
{
    use ColumnSelectConfiguration,
        ColumnSelectHelpers;

    #[Locked]
    public array $columnSelectColumns = ['setupRun' => false, 'selected' => [], 'deselected' => [], 'defaultdeselected' => []];

    public array $selectedColumns = [];

    public array $deselectedColumns = [];

    public array $selectableColumns = [];

    public array $defaultDeselectedColumns = [];

    #[Locked]
    public bool $excludeDeselectedColumnsFromQuery = false;

    #[Locked]
    public bool $defaultDeselectedColumnsSetup = false;

    protected bool $columnSelectStatus = true;

    protected bool $rememberColumnSelectionStatus = true;

    protected bool $columnSelectHiddenOnMobile = false;

    protected bool $columnSelectHiddenOnTablet = false;

    protected function queryStringWithColumnSelect(): array
    {
        if ($this->queryStringIsEnabled() && $this->columnSelectIsEnabled()) {
            return [
                'columns' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-columns'],
            ];
        }

        return [];
    }

    public function bootedWithColumnSelect(): void
    {
        $this->setupColumnSelect();
    }

    public function updatedSelectedColumns(): void
    {
        // The query string isn't needed if it's the same as the default
        session([$this->getColumnSelectSessionKey() => $this->selectedColumns]);
        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    public function renderingWithColumnSelect(View $view, array $data = []): void
    {
        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'selectedVisibleColumns' => $this->getVisibleColumns(),
            ]);
        }
    }
}

<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use Illuminate\View\View;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\SummariesConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\SummariesHelpers;

trait WithSummaries
{
    use SummariesConfiguration,
        SummariesHelpers;

    protected bool $summariesStatus = false;

    protected array $summaryColumns = [];

    public function setupSummaries(): void
    {
        $this->summaryColumns = [];

        foreach ($this->getColumns() as $column) {
            if ($column->hasSummary()) {
                $this->summaryColumns[] = $column;
                $this->summariesStatus = true;
            }
        }
    }

    public function renderingWithSummaries(?View $view = null, array $data = []): void
    {
        $this->setupSummaries();
    }
}

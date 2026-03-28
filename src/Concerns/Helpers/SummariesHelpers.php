<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers;

use Illuminate\Support\Collection;
use SkywalkerLabs\LaravelLivewireTables\View\Column;

trait SummariesHelpers
{
    public function getSummariesStatus(): bool
    {
        return $this->summariesStatus;
    }

    public function summariesAreEnabled(): bool
    {
        return $this->getSummariesStatus() === true;
    }

    public function summariesAreDisabled(): bool
    {
        return $this->getSummariesStatus() === false;
    }

    public function hasSummaries(): bool
    {
        return $this->summariesAreEnabled() && ! empty($this->summaryColumns);
    }

    public function getSummaryColumns(): Collection
    {
        return collect($this->summaryColumns);
    }

    /**
     * Calculate summary for a column
     */
    public function calculateSummary(Column $column, Collection $rows): mixed
    {
        if (! $column->hasSummary()) {
            return null;
        }

        // Use the column's own calculateSummary method
        return $column->calculateSummary($rows);
    }
}

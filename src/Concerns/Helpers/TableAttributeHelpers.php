<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Computed;
use SkywalkerLabs\LaravelLivewireTables\View\Column;

trait TableAttributeHelpers
{
    #[Computed]
    public function componentWrapperAttributes(): array
    {
        return count($this->componentWrapperAttributes) ? $this->componentWrapperAttributes : ['id' => 'datatable-'.$this->getId()];
    }

    #[Computed]
    public function tableWrapperAttributes(): array
    {
        return count($this->tableWrapperAttributes) ? $this->tableWrapperAttributes : ['default' => true];
    }

    #[Computed]
    public function tableAttributes(): array
    {
        return count($this->tableAttributes) ? $this->tableAttributes : ['id' => 'table-'.$this->tableName(), 'default' => true];
    }

    #[Computed]
    public function theadAttributes(): array
    {
        return count($this->theadAttributes) ? $this->theadAttributes : ['default' => true];
    }

    #[Computed]
    public function tbodyAttributes(): array
    {
        return count($this->tbodyAttributes) ? $this->tbodyAttributes : ['default' => true];
    }

    #[Computed]
    public function thAttributes(Column $column): array
    {
        return isset($this->thAttributesCallback) ? call_user_func($this->thAttributesCallback, $column) : ['default' => true];
    }

    #[Computed]
    public function thSortButtonAttributes(Column $column): array
    {
        return isset($this->thSortButtonAttributesCallback) ? call_user_func($this->thSortButtonAttributesCallback, $column) : ['default' => true];
    }

    #[Computed]
    public function trAttributes(Model $row, int $index): array
    {
        $attributes = isset($this->trAttributesCallback) ? call_user_func($this->trAttributesCallback, $row, $index) : ['default' => true];

        // Merge record classes if set
        if (isset($this->recordClassesCallback)) {
            $classes = call_user_func($this->recordClassesCallback, $row);
            if ($classes) {
                $classesArray = is_array($classes) ? $classes : explode(' ', $classes);
                $existingClasses = isset($attributes['class']) ? explode(' ', $attributes['class']) : [];
                $mergedClasses = array_unique(array_merge($existingClasses, $classesArray));
                $attributes['class'] = implode(' ', array_filter($mergedClasses));
            }
        }

        return $attributes;
    }

    public function hasRecordClasses(): bool
    {
        return isset($this->recordClassesCallback);
    }

    #[Computed]
    public function tdAttributes(Column $column, Model $row, int $colIndex, int $rowIndex): array
    {
        return isset($this->tdAttributesCallback) ? call_user_func($this->tdAttributesCallback, $column, $row, $colIndex, $rowIndex) : ['default' => true];
    }

    public function hasTableRowUrl(): bool
    {
        return isset($this->trUrlCallback);
    }

    public function getTableRowUrl(int|Model $row): ?string
    {
        return isset($this->trUrlCallback) ? call_user_func($this->trUrlCallback, $row) : null;
    }

    public function getTableRowUrlTarget(int|Model $row): ?string
    {
        return isset($this->trUrlTargetCallback) ? call_user_func($this->trUrlTargetCallback, $row) : null;
    }
}

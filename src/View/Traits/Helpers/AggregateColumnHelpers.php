<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait AggregateColumnHelpers
{
    public function getDataSource(): string
    {

        return $this->dataSource;
    }

    public function hasDataSource(): bool
    {
        return isset($this->dataSource);
    }

    public function getAggregateMethod(): string
    {
        return $this->aggregateMethod;
    }

    public function hasForeignColumn(): bool
    {
        return isset($this->foreignColumn);
    }

    public function getForeignColumn(): string
    {
        return $this->foreignColumn;
    }

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|Application|Factory|View
    {
        if (! isset($this->dataSource)) {
            throw new DataTableConfigurationException('You must specify a data source');
        } else {
            return parent::getContents($row);
        }
    }
}

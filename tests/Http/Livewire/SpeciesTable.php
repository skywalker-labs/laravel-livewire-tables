<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Http\Livewire;

use SkywalkerLabs\LaravelLivewireTables\DataTableComponent;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Species;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\{AvgColumn,CountColumn,SumColumn};

class SpeciesTable extends DataTableComponent
{
    public $model = Species::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0'),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            AvgColumn::make('Average Age')
                ->setDataSource('pets', 'age'),
            CountColumn::make('Number of Pets')
                ->setDataSource('pets'),
            SumColumn::make('Total Age')
                ->setDataSource('pets', 'age'),

        ];
    }
}

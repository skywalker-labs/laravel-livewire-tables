<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use SkywalkerLabs\LaravelLivewireTables\DataTableComponent;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Breed;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Pet;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Species;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\ImageColumn;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\LinkColumn;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\DateFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\DateTimeFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\MultiSelectDropdownFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\MultiSelectFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\NumberFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\SelectFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\TextFilter;

class PetsTableCustomFilters extends DataTableComponent
{
    public $model = Pet::class;

    public string $paginationTest = 'standard';

    public function enableDetailedPagination(string $type = 'standard')
    {
        $this->setPerPageAccepted([1, 3, 5, 10, 15, 25, 50])->setPerPage(3);
        $this->setPaginationMethod($type);
        $this->setDisplayPaginationDetailsEnabled();

    }

    public function disableDetailedPagination(string $type = 'standard')
    {
        $this->setPerPageAccepted([1, 3, 5, 10, 15, 25, 50])->setPerPage(3);
        $this->setPaginationMethod($type);
        $this->setDisplayPaginationDetailsDisabled();
    }

    public function setPaginationTest(string $type)
    {
        $this->paginationTest = $type;
    }

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
            Column::make('Sort')
                ->sortable()
                ->excludeFromColumnSelect(),
            Column::make('Name')
                ->sortable()
                ->secondaryHeader($this->getFilterByKey('pet_name_filter'))
                ->footerFilter('pet_name_filter')
                ->searchable(),

            Column::make('Age'),

            Column::make('Breed', 'breed.name')
                ->secondaryHeaderFilter('breed')
                ->footer($this->getFilterByKey('breed'))
                ->sortable(
                    fn (Builder $query, string $direction) => $query->orderBy('pets.id', $direction)
                )
                ->searchable(
                    fn (Builder $query, $searchTerm) => $query->orWhere('breed.name', $searchTerm)
                ),

            Column::make('Other')
                ->label(function ($row, Column $column) {
                    return 'Other';
                })
                ->footer(function ($rows) {
                    return 'Count: '.$rows->count();
                }),

            LinkColumn::make('Link')
                ->title(fn ($row) => 'Edit')
                ->location(fn ($row) => 'http://www.google.com')
                ->attributes(fn ($row) => [
                    'class' => 'rounded-full',
                    'alt' => $row->name.' Avatar',
                ]),
            ImageColumn::make('RowImg')
                ->location(fn ($row) => 'test'.$row->id)
                ->attributes(fn ($row) => [
                    'class' => 'rounded-full',
                    'alt' => $row->name.' Avatar',
                ]),
            Column::make('Last Visit', 'last_visit')
                ->sortable()
                ->deselected(),
        ];
    }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Breed')
                ->options(
                    Breed::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($breed) => $breed->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $values) {
                    return $builder->whereIn('breed_id', $values);
                }),
            MultiSelectDropdownFilter::make('Species')
                ->options(
                    Species::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($species) => $species->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $values) {
                    return $builder->whereIn('species_id', $values);
                })
                ->setPillsSeparator('<br />'),

        ];
    }
}

<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Http\Livewire\FailingTables;

use Illuminate\Database\Eloquent\Builder;
use SkywalkerLabs\LaravelLivewireTables\DataTableComponent;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Breed;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Pet;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Species;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\DateFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\DateTimeFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\MultiSelectDropdownFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\MultiSelectFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\NumberFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\SelectFilter;
use SkywalkerLabs\LaravelLivewireTables\View\Filters\TextFilter;

class NoColumnsTable extends DataTableComponent
{
    public $model = Pet::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
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
                }),
            NumberFilter::make('Breed ID', 'breed_id_filter')
                ->filter(function (Builder $builder, string $value) {
                    return $builder->where('breed_id', '=', $value);
                }),

            TextFilter::make('Pet Name', 'pet_name_filter')
                ->filter(function (Builder $builder, string $value) {
                    return $builder->where('pets.name', '=', $value);
                }),

            DateFilter::make('Last Visit After Date', 'last_visit_date_filter')
                ->filter(function (Builder $builder, string $value) {
                    return $builder->whereDate('pets.last_visit', '=>', $value);
                }),

            DateTimeFilter::make('Last Visit Before DateTime', 'last_visit_datetime_filter')
                ->filter(function (Builder $builder, string $value) {
                    return $builder->whereDate('pets.last_visit', '<=', $value);
                }),

            SelectFilter::make('Breed SelectFilter', 'breed_select_filter')
                ->options(
                    Breed::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($breed) => $breed->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, string $value) {
                    return $builder->where('breed_id', $value);
                })
                ->setCustomFilterLabel('livewire-tables::tests.testFilterLabel')
                ->setFilterPillBlade('livewire-tables::tests.testFilterPills'),
        ];
    }
}

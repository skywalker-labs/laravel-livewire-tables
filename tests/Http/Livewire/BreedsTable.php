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

class BreedsTable extends DataTableComponent
{
    public $model = Breed::class;

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

            Column::make('Name')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }
}

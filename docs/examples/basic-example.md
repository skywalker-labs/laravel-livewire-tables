---
title: Basic Example
weight: 1
---

```php
<?php

namespace App\Livewire;

use App\Models\User;
use SkywalkerLabs\LaravelLivewireTables\DataTableComponent;
use SkywalkerLabs\LaravelLivewireTables\View\Column;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Address', 'address.address')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
        ];
    }
}
```

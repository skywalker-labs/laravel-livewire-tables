![Package Logo](https://banners.beyondco.de/Laravel%20Livewire%20Tables.png?theme=light&packageName=skywalker-labs%2Flaravel-livewire-tables&pattern=hideout&style=style_1&description=A+dynamic+table+component+for+Laravel+Livewire&md=1&fontSize=100px&images=table)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/skywalker-labs/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/skywalker-labs/laravel-livewire-tables)
[![Tests](https://github.com/skywalker-labs/laravel-livewire-tables/actions/workflows/run-tests.yml/badge.svg)](https://github.com/skywalker-labs/laravel-livewire-tables/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/skywalker-labs/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/skywalker-labs/laravel-livewire-tables)
![PHP Stan Level 6](https://img.shields.io/badge/PHPStan-level%206-brightgreen.svg?style=flat)

### Enjoying this package? [Sponsor me on GitHub 💖](https://github.com/sponsors/ermradulsharma)

A dynamic Laravel Livewire component for data tables, maintained by **Skywalker Labs**.

![Dark Mode](https://imgur.com/QoEdC7n.png)

![Full Table](https://i.imgur.com/2kfibjR.png)

## Installation

You can install the package via composer:

``` bash
composer require skywalker-labs/laravel-livewire-tables
```

You must also have [Alpine.js](https://alpinejs.dev) version 3 or greater installed and available to the component.

## Documentation and Usage Instructions

See the [documentation](https://skywalker-labs.com/docs/laravel-livewire-tables) for detailed installation and usage instructions.

## Basic Example

```php
<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Name')
                ->sortable(),
        ];
    }
}

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please e-mail skywalkerlknw@gmail.com to report any security vulnerabilities.

## Credits

- [Skywalker Labs Team](https://skywalker-labs.com/)
- [Mradul Sharma](https://github.com/ermradulsharma)
- [All Contributors](./CONTRIBUTORS.md)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

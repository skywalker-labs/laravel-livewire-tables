<p align="center">
    <img src="https://banners.beyondco.de/Laravel%20Livewire%20Tables.png?theme=light&packageName=skywalker-labs%2Flaravel-livewire-tables&pattern=hideout&style=style_1&description=A+dynamic+table+component+for+Laravel+Livewire&md=1&fontSize=100px&images=table" alt="Laravel Livewire Tables" style="max-width: 100%;">
</p>

# Laravel Livewire Tables

[![Latest Version on Packagist](https://img.shields.io/packagist/v/skywalker-labs/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/skywalker-labs/laravel-livewire-tables)
[![Tests](https://github.com/skywalker-labs/laravel-livewire-tables/actions/workflows/run-tests.yml/badge.svg)](https://github.com/skywalker-labs/laravel-livewire-tables/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/skywalker-labs/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/skywalker-labs/laravel-livewire-tables)
[![PHP Stan Level 6](https://img.shields.io/badge/PHPStan-level%206-brightgreen.svg?style=flat)](https://github.com/larastan/larastan)
[![License](https://img.shields.io/packagist/l/skywalker-labs/laravel-livewire-tables.svg?style=flat-square)](LICENSE.md)

**Laravel Livewire Tables** provides a powerful, highly-extensible, and designer-friendly data table component for Laravel Livewire. Built from the ground up to support modern design systems including **Tailwind CSS**, **Bootstrap 4**, and **Bootstrap 5**.

---

### Support the Project 💖
If you find this package useful for your business or personal projects, please consider **[Sponsoring the lead developer on GitHub](https://github.com/sponsors/ermradulsharma)** to support ongoing maintenance and new features.

---

## ✨ Features

-   🚀 **Zero-Config Data Tables**: Get started in minutes with minimum setup.
-   🌓 **Modern UI**: Full support for Dark Mode architectures.
-   🔍 **Advanced Search**: Fuzzy search, debounced inputs, and multi-column searching.
-   🌪️ **Powerful Filters**: Text, Number Range, Date Range, Select, Multi-Select, and custom filters.
-   📊 **Pagination**: Laravel-native pagination styles including Standard, Simple, and Cursor pagination.
-   ⚡ **Deferred Loading**: Load your data tables asynchronously to improve perceived performance.
-   📦 **Bulk Actions**: Select all across pages, export to CSV/Excel (via integration), and batch updates.
-   🧩 **Column Selection**: Let users choose which columns are visible in their view.
-   🔄 **Reordering**: Drag-and-drop row reordering with persistence.
-   🛠️ **Highly Customisable**: Override views, themes, and logic at every level.
-   💅 **Multiple Themes**: Out-of-the-box support for Tailwind CSS, Bootstrap 4, and Bootstrap 5.

## 📦 Installation

Install the package via composer:

```bash
composer require skywalker-labs/laravel-livewire-tables
```

> [!IMPORTANT]
> This package requires **Alpine.js 3.x** or higher to be available in your application's global scope.

## 🚀 Quick Start

Create your first table by extending `DataTableComponent`:

```php
namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use SkywalkerLabs\LaravelLivewireTables\DataTableComponent;
use SkywalkerLabs\LaravelLivewireTables\View\Column;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
             ->setTableRowUrl(fn($row) => route('admin.users.show', $row))
             ->setSearchDebounce(500)
             ->setLoadingPlaceholderEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Created At", "created_at")
                ->sortable(),
        ];
    }
}
```

Then, include it in your Blade view:

```blade
<livewire:admin.users-table />
```

## 📖 Complete Documentation

For detailed installation instructions, advanced configuration, and a full API reference, please visit our **[Official Documentation](https://skywalker-labs.com/docs/laravel-livewire-tables)**.

## 🛠️ Testing

We maintain a rigorous test suite using PHPUnit and Orchestra Testbench.

```bash
composer test
```

## 🔐 Security

If you discover any security-related issues, please email **skywalkerlknw@gmail.com** instead of using the issue tracker.

## 🤝 Contributing

We welcome contributions from the community! Please review our **[Contributing Guidelines](CONTRIBUTING.md)** and **[Architecture Overview](ARCHITECTURE.md)** before submitting a pull request.

## 📜 Credits

-   **[Skywalker Labs Team](https://skywalker-labs.com/)** - Main Maintainer
-   **[Mradul Sharma](https://github.com/ermradulsharma)** - Lead Developer
-   **[All Contributors](../../contributors)**

## 📄 License

The MIT License (MIT). Please see **[License File](LICENSE.md)** for more information.


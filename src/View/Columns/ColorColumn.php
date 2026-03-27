<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Columns;

use Illuminate\Database\Eloquent\Model;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Columns\HasDefaultStringValue;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\ColorColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\ColorColumnHelpers;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\IsColumn;

class ColorColumn extends Column
{
    use IsColumn;
    use ColorColumnConfiguration,
        ColorColumnHelpers;
    use HasDefaultStringValue;

    public ?object $colorCallback = null;

    protected string $view = 'livewire-tables::includes.columns.color';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }

    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView())
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withColor($this->getColor($row))
            ->withAttributeBag($this->getAttributeBag($row));
    }

    public function getValue(Model $row): string
    {
        return parent::getValue($row) ?? $this->getDefaultValue();
    }
}

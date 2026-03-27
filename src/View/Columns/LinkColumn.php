<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Columns;

use Illuminate\Database\Eloquent\Model;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\LinkColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\{HasLocationCallback,HasTitleCallback};
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\LinkColumnHelpers;

class LinkColumn extends Column
{
    use LinkColumnConfiguration,
        LinkColumnHelpers,
        HasLocationCallback,
        HasTitleCallback;

    protected string $view = 'livewire-tables::includes.columns.link';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (! $this->hasTitleCallback()) {
            throw new DataTableConfigurationException('You must specify a title callback for an link column.');
        }

        if (! $this->hasLocationCallback()) {
            throw new DataTableConfigurationException('You must specify a location callback for an link column.');
        }

        return view($this->getView())
            ->withColumn($this)
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withTitle(app()->call($this->getTitleCallback(), ['row' => $row]))
            ->withPath(app()->call($this->getLocationCallback(), ['row' => $row]))
            ->withAttributes($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}

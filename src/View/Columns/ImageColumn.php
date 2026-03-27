<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Columns;

use Illuminate\Database\Eloquent\Model;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\ImageColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\HasLocationCallback;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\ImageColumnHelpers;

class ImageColumn extends Column
{
    use ImageColumnConfiguration,
        ImageColumnHelpers,
        HasLocationCallback;

    protected string $view = 'livewire-tables::includes.columns.image';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (! $this->hasLocationCallback()) {
            throw new DataTableConfigurationException('You must specify a location callback for an image column.');
        }

        return view($this->getView())
            ->withColumn($this)
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withPath(app()->call($this->getLocationCallback(), ['row' => $row]))
            ->withAttributes($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}

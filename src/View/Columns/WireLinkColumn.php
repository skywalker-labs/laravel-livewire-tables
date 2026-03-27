<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Columns;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\WireLinkColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\{HasActionCallback,HasConfirmation, HasTitleCallback};
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\WireLinkColumnHelpers;

class WireLinkColumn extends Column
{
    use WireLinkColumnConfiguration,
        WireLinkColumnHelpers,
        HasActionCallback,
        HasTitleCallback,
        HasConfirmation;

    protected string $view = 'livewire-tables::includes.columns.wire-link';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function getContents(Model $row): null|string|HtmlString|DataTableConfigurationException|Application|Factory|View
    {
        if (! $this->hasTitleCallback()) {
            throw new DataTableConfigurationException('You must specify a title callback for a WireLink column.');
        }

        if (! $this->hasActionCallback()) {
            throw new DataTableConfigurationException('You must specify an action callback for a WireLink column.');
        }

        return view($this->getView())
            ->withColumn($this)
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withTitle(app()->call($this->getTitleCallback(), ['row' => $row]))
            ->withPath(app()->call($this->getActionCallback(), ['row' => $row]))
            ->withAttributes($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}

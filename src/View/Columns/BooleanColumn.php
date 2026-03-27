<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Columns;

use Illuminate\Database\Eloquent\Model;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\BooleanColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\HasCallback;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\BooleanColumnHelpers;

class BooleanColumn extends Column
{
    use BooleanColumnConfiguration,
        BooleanColumnHelpers,
        HasCallback;

    protected string $type = 'icons';

    protected bool $successValue = true;

    protected string $view = 'livewire-tables::includes.columns.boolean';

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not specify a boolean column as a label.');
        }

        $value = $this->getValue($row);

        return view($this->getView())
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withSuccessValue($this->getSuccessValue())
            ->withType($this->getType())
            ->withStatus($this->hasCallback() ? call_user_func($this->getCallback(), $value, $row) : (bool) $value === true);
    }
}

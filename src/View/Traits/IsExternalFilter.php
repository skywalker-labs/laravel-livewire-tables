<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits;

use Livewire\Attributes\Modelable;

trait IsExternalFilter
{
    #[Modelable]
    public $value = '';

    public $filterKey = '';
}

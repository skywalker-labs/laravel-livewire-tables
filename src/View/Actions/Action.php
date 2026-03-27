<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Actions;

use SkywalkerLabs\LaravelLivewireTables\View\Action as BaseAction;

class Action extends BaseAction
{
    public function __construct(?string $label = null)
    {
        parent::__construct($label);
    }
}

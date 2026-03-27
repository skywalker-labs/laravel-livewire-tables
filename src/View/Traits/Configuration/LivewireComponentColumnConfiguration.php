<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration;

trait LivewireComponentColumnConfiguration
{
    use ComponentColumnConfiguration;

    protected string $componentView;

    protected mixed $slotCallback;
}

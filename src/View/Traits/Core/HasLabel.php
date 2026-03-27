<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Core;

trait HasLabel
{
    public string $label = '';

    public function getLabel(): string
    {
        return $this->label;
    }
}

<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration;

trait ButtonGroupColumnConfiguration
{
    public function buttons(array $buttons): self
    {
        $this->buttons = $buttons;

        return $this;
    }
}

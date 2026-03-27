<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits\Core;

use Closure;
use SkywalkerLabs\LaravelLivewireTables\View\{Column,Filter};

trait HasConfirmation
{
    protected ?string $confirmMessage;

    public function confirmMessage(string $confirmMessage): self
    {
        $this->confirmMessage = $confirmMessage;

        return $this;
    }

    public function hasConfirmMessage(): bool
    {
        return isset($this->confirmMessage);
    }

    public function getConfirmMessage(): string
    {
        return $this->confirmMessage;
    }
}

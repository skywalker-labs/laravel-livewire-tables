<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers;

use Livewire\Attributes\Computed;

trait RefreshHelpers
{
    public function hasRefresh(): bool
    {
        return $this->refresh !== false;
    }

    public function refreshStatus(): bool|string
    {
        return $this->refresh;
    }

    public function refreshOptions(): ?string
    {
        if ($this->hasRefresh()) {
            if (is_numeric($this->refreshStatus())) {
                return '.'.$this->refreshStatus().'ms';
            }

            switch ($this->refreshStatus()) {
                case 'keep-alive':
                    return '.keep-alive';
                case 'visible':
                    return '.visible';
                default:
                    return '='.$this->refreshStatus();
            }
        }

        return null;
    }
}

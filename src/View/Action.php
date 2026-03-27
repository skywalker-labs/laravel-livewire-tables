<?php

namespace SkywalkerLabs\LaravelLivewireTables\View;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Actions\{HasActionAttributes, HasRoute};
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Columns\HasVisibility;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\{HasIcon, HasLabel, HasTheme, HasView, HasWireActions};

class Action extends Component
{
    use HasActionAttributes;
    use HasIcon;
    use HasLabel;
    use HasRoute;
    use HasTheme;
    use HasView;
    use HasVisibility;
    use HasWireActions;

    protected string $view = 'livewire-tables::includes.actions.button';

    public function __construct(?string $label = null)
    {
        $this->label = trim(__($label));
    }

    public static function make(?string $label = null): self
    {
        return new static($label);
    }

    public function render(): null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $view = view($this->getView())
            ->withAction($this)
            ->withIsBootstrap($this->isBootstrap())
            ->withIsTailwind($this->isTailwind())
            ->withAttributes($this->getActionAttributes());

        return $view;
    }
}

<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\LoadingPlaceholderConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\LoadingPlaceholderHelpers;

trait WithLoadingPlaceholder
{
    use LoadingPlaceholderConfiguration,
        LoadingPlaceholderHelpers;

    protected bool $displayLoadingPlaceholder = false;

    protected string $loadingPlaceholderContent = 'Loading';

    protected ?string $loadingPlaceholderBlade = null;

    protected array $loadingPlaceHolderAttributes = [];

    protected array $loadingPlaceHolderIconAttributes = [];

    protected array $loadingPlaceHolderWrapperAttributes = [];
}

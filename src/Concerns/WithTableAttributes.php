<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use Closure;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\TableAttributeConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\TableAttributeHelpers;

trait WithTableAttributes
{
    use TableAttributeConfiguration,
        TableAttributeHelpers;

    protected array $componentWrapperAttributes = [];

    protected array $tableWrapperAttributes = [];

    protected array $tableAttributes = [];

    protected array $theadAttributes = [];

    protected array $tbodyAttributes = [];

    protected ?object $thAttributesCallback;

    protected ?object $thSortButtonAttributesCallback;

    protected ?object $trAttributesCallback;

    protected ?object $tdAttributesCallback;

    protected ?object $trUrlCallback;

    protected ?object $trUrlTargetCallback;

    protected ?object $recordClassesCallback;
}

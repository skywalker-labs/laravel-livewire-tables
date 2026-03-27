<?php

namespace SkywalkerLabs\LaravelLivewireTables\View\Traits;

use SkywalkerLabs\LaravelLivewireTables\DataTableComponent;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Columns\{HasVisibility, IsCollapsible, IsSearchable, IsSelectable, IsSortable};
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Configuration\ColumnConfiguration;
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Core\{HasAttributes,HasFooter,HasSecondaryHeader,HasSummary,HasView};
use SkywalkerLabs\LaravelLivewireTables\View\Traits\Helpers\{ColumnHelpers,RelationshipHelpers};

trait IsColumn
{
    use ColumnConfiguration,
        ColumnHelpers,
        RelationshipHelpers,
        IsCollapsible,
        IsSearchable,
        IsSelectable,
        IsSortable,
        HasAttributes,
        HasFooter,
        HasSecondaryHeader,
        HasSummary,
        HasView,
        HasVisibility;

    protected ?DataTableComponent $component = null;

    // What displays in the columns header
    protected string $title;

    // Act as a unique identifier for the column
    protected string $hash;

    // The columns or relationship location: i.e. name, or address.group.name
    protected ?string $from = null;

    // The underlying columns name: i.e. name
    protected ?string $field = null;

    // The table of the columns or relationship
    protected ?string $table = null;

    // An array of relationships: i.e. address.group.name => ['address', 'group']
    protected array $relations = [];

    protected bool $eagerLoadRelations = false;

    protected mixed $formatCallback = null;

    protected bool $html = false;

    protected mixed $labelCallback = null;

    protected bool $clickable = true;

    protected ?string $customSlug = null;

    protected bool $hasTableRowUrl = false;

    protected string $theme = 'tailwind';

    protected bool $isReorderColumn = false;
}

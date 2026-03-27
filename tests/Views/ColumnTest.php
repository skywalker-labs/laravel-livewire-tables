<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Views;

use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;
use SkywalkerLabs\LaravelLivewireTables\View\Column;

final class ColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = Column::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_infer_field_name_from_title_if_no_from(): void
    {
        $column = Column::make('My Title');

        $this->assertSame('my_title', $column->getField());
    }

    public function test_can_set_base_field_from_from(): void
    {
        $column = Column::make('Name', 'name');

        $this->assertSame('name', $column->getField());
    }

    public function test_can_set_relation_field_from_from(): void
    {
        $column = Column::make('Name', 'address.group.name');

        $this->assertSame('name', $column->getField());
    }

    public function test_can_set_relations_from_from(): void
    {
        $column = Column::make('Name', 'address.group.name');

        $this->assertSame(['address', 'group'], $column->getRelations()->toArray());
        $this->assertSame('address.group', $column->getRelationString());
    }

    public function test_can_get_contents_of_column(): void
    {
        $rows = $this->basicTable->rows;
        $firstRow = $rows->first();
        
        // Test direct property access
        $this->assertSame('Cartman', $firstRow->name);
        $this->assertSame('Norwegian Forest', $firstRow['breed.name']);
        
        // Test getContents method on column
        $nameColumn = $this->basicTable->getColumnBySelectName('name');
        $this->assertSame('Cartman', $nameColumn->getContents($firstRow));
        
        $breedColumn = $this->basicTable->getColumnBySelectName('breed.name');
        $this->assertSame('Norwegian Forest', $breedColumn->getContents($firstRow));
    }

    public function test_can_get_column_formatted_contents(): void
    {
        $column = $this->basicTable->getColumnBySelectName('name');
        $rows = $this->basicTable->rows;

        $this->assertFalse($column->hasFormatter());
        $this->assertNull($column->getFormatCallback());

        $column->format(fn ($value) => strtoupper($value));

        $this->assertTrue($column->hasFormatter());
        $this->assertNotNull($column->getFormatCallback());

        $this->assertSame(strtoupper($rows->first()->name), $column->getContents($rows->first()));
    }

    public function test_column_table_gets_set_for_base_and_relationship_columns(): void
    {
        $column = $this->basicTable->getColumnBySelectName('name');

        $this->assertSame('pets', $column->getTable());

        $column = $this->basicTable->getColumnBySelectName('breed.name');

        $this->assertSame('breed', $column->getTable());
    }

    public function test_can_check_ishtml_from_html_column(): void
    {
        $column = Column::make('Name', 'name')->html();

        $this->assertTrue($column->isHtml());
    }

    public function test_can_get_html_from_html_label_column(): void
    {
        $column = Column::make('Name', 'name')->label(fn () => '<strong>My Label</strong>')->html();
        $rows = $this->basicTable->rows;
        $htmlString = new \Illuminate\Support\HtmlString('<strong>My Label</strong>');
        $this->assertSame($htmlString->toHtml(), $column->getContents($rows->first())->toHtml());
    }

    public function test_can_get_html_from_html_format_column(): void
    {
        $column = $this->basicTable->getColumnBySelectName('name');
        $rows = $this->basicTable->rows;

        $column->format(fn ($value) => strtoupper($value))->html();

        $htmlString = new \Illuminate\Support\HtmlString(strtoupper($rows->first()->name));

        $this->assertSame($htmlString->toHtml(), $column->getContents($rows->first())->toHtml());
    }

    public function test_cannot_collapse_on_tablet_and_mobile(): void
    {
        $rows = $this->basicTable->rows;
        $column = Column::make('Name', 'name')->label(fn () => '<strong>My Label</strong>')->collapseOnMobile()->collapseOnTablet()->html();
        $this->expectException(DataTableConfigurationException::class);

        $contents = $column->renderContents($rows->first());
    }
}

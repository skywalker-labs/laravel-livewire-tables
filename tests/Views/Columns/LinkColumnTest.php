<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Views\Columns;

use Illuminate\Support\HtmlString;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Pet;
use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\LinkColumn;

final class LinkColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = LinkColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_not_infer_field_name_from_title_if_no_from(): void
    {
        $column = LinkColumn::make('My Title');

        $this->assertNull($column->getField());
    }

    public function test_can_not_render_field_if_no_title_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        LinkColumn::make('Name')->getContents(Pet::find(1));
    }

    public function test_can_not_render_field_if_no_location_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        LinkColumn::make('Name')->title(fn ($row) => 'Edit')->getContents(Pet::find(1));
    }

    public function test_can_render_field_if_title_and_location_callback(): void
    {
        $column = LinkColumn::make('Name')->title(fn ($row) => 'Edit')->location(fn ($row) => 'test'.$row->id)->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }

    public function test_can_check_ishtml_from_html_column(): void
    {
        $column = LinkColumn::make('Name', 'name')
            ->title(fn ($row) => 'Title')
            ->location(fn ($row) => "#$row->id")
            ->html();

        $this->assertTrue($column->isHtml());
    }

    public function test_can_get_html_from_html_label_column(): void
    {
        $column = LinkColumn::make('Name', 'name')
            ->title(fn ($row) => '<strong>My Label</strong>')
            ->location(fn ($row) => "#$row->id")
            ->html();

        $rows = $this->basicTable->rows;
        $location = '#'.$rows->first()->id;
        $htmlString = new HtmlString('<a href="'.$location.'"><strong>My Label</strong></a>');

        // Removing every whitespace and line break for the comparison
        $expectedHtml = preg_replace('/\s+/', '', $htmlString->toHtml());
        $actualHtml = preg_replace(['/\s+/', '/<!--\[if.*?endif\]-->/s'], '', $column->getContents($rows->first())->toHtml());

        $this->assertSame($expectedHtml, $actualHtml);
    }
}

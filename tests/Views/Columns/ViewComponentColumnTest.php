<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Views\Columns;

use Illuminate\Support\Facades\Blade;
use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\Tests\Http\TestComponent;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Pet;
use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;
use SkywalkerLabs\LaravelLivewireTables\View\Column;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\ViewComponentColumn;

final class ViewComponentColumnTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Blade::component('test-component', TestComponent::class);
    }

    public function test_can_set_the_column_title(): void
    {
        $column = ViewComponentColumn::make('Total Users');

        $this->assertSame('Total Users', $column->getTitle());
    }

    public function test_can_have_component_view(): void
    {
        $column = ViewComponentColumn::make('Age 2', 'age')
            ->attributes(fn ($value, $row, Column $column) => [
                'age' => $row->age,
            ]);

        $this->assertFalse($column->hasComponentView());
        $column->component('test-component');
        $this->assertTrue($column->hasComponentView());
    }

    public function test_can_not_omit_component(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        $column = ViewComponentColumn::make('Age 2', 'age')
            ->attributes(fn ($value, $row, Column $column) => [
                'age' => $row->age,
            ]);
        $contents = $column->getContents(Pet::find(1));
        $this->assertSame('<div>2420</div>', $contents);

    }

    public function test_can_use_custom_component(): void
    {
        $column = ViewComponentColumn::make('Age 2', 'age')
            ->attributes(fn ($value, $row, Column $column) => [
                'age' => $row->age,
            ]);

        $this->assertFalse($column->hasCustomComponent());
        $column->customComponent(\SkywalkerLabs\LaravelLivewireTables\Tests\Http\TestComponent::class);
        $contents = $column->getContents(Pet::find(1));
        $this->assertSame('<div>2420</div>', $contents);
        $this->assertTrue($column->hasCustomComponent());

    }

    /*public function test_can_render_component(): void
    {

        $column = ViewComponentColumn::make('Age 2', 'age')
            ->component('test-component')
            ->attributes(fn ($value, $row, Column $column) => [
                'age' => $row->age,
            ]);
        $contents = $column->getContents(Pet::find(1));
        $this->assertSame('<div>2420</div>', $contents);

    }*/
}

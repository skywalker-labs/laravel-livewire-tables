<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Views;

use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Pet;
use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\ComponentColumn;

final class ComponentColumnTest extends TestCase
{
    public function test_component_column_attributes_callback_return_can_not_be_an_string()
    {
        $this->expectException(DataTableConfigurationException::class);
        ComponentColumn::make('Name')
            ->component('alert')
            ->attributes(fn () => 'string')->getContents(Pet::find(1));
    }

    public function test_component_column_component_has_to_be_an_string()
    {
        $column = ComponentColumn::make('Name')
            ->component('alert');
        $this->assertEquals('components.alert', $column->getComponentView());
    }

    public function test_component_column_component_view_has_to_be_set()
    {
        $this->expectException(DataTableConfigurationException::class);
        ComponentColumn::make('Name')
            ->getContents(Pet::find(1));
    }
}

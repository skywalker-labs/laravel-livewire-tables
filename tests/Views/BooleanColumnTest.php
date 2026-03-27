<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Views;

use SkywalkerLabs\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use SkywalkerLabs\LaravelLivewireTables\Tests\Models\Pet;
use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\BooleanColumn;

final class BooleanColumnTest extends TestCase
{
    public function test_boolean_column_can_not_be_a_label(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        BooleanColumn::make('Name')->label(fn () => 'My Label')->getContents(Pet::find(1));
    }

    public function test_boolean_column_can_be_yes_no(): void
    {
        $column = BooleanColumn::make('Name');

        $this->assertEquals('icons', $column->getType());

        $column->yesNo();

        $this->assertEquals('yes-no', $column->getType());
    }
}

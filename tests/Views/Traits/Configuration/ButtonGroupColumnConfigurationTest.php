<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Views\Traits\Configuration;

use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\ButtonGroupColumn;
use SkywalkerLabs\LaravelLivewireTables\View\Columns\LinkColumn;

final class ButtonGroupColumnConfigurationTest extends TestCase
{
    public function test_button_group_column_can_set_buttons(): void
    {
        $column = ButtonGroupColumn::make('Actions')
            ->attributes(function () {
                return [
                    'class' => 'space-x-2',
                ];
            })
            ->buttons([
                LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn () => 'View Names')
                    ->location(fn () => 'test')
                    ->attributes(function () {
                        return [
                            'class' => 'underline text-blue-500 hover:no-underline',
                        ];
                    }),
            ]);

        $firstButton = $column->getButtons()[0];

        $this->assertInstanceOf(LinkColumn::class, $firstButton);
    }
}

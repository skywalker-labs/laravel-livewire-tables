<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Traits\Configuration;

use SkywalkerLabs\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;

final class QueryStringAliasConfigurationTest extends TestCase
{
    public function test_can_set_query_string_alias(): void
    {
        $this->assertSame('test', $this->basicTable->setQueryStringAlias('test')->getQueryStringAlias());
    }

    public function test_can_set_query_string_in_configure_method(): void
    {
        $mock = new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setQueryStringAlias('test');
            }
        };

        $mock->configure();
        $mock->boot();

        $this->assertSame('test', $mock->getQueryStringAlias());
    }
}

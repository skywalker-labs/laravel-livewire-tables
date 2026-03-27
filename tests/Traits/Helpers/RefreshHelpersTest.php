<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Traits\Helpers;

use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;

final class RefreshHelpersTest extends TestCase
{
    public function test_can_check_if_refresh_is_set(): void
    {
        $this->assertFalse($this->basicTable->hasRefresh());

        $this->basicTable->setRefreshKeepAlive();

        $this->assertTrue($this->basicTable->hasRefresh());
    }

    public function test_can_get_refresh_options(): void
    {
        $this->assertNull($this->basicTable->refreshOptions());

        $this->basicTable->setRefreshTime(1000);

        $this->assertSame('.1000ms', $this->basicTable->refreshOptions());

        $this->basicTable->setRefreshKeepAlive();

        $this->assertSame('.keep-alive', $this->basicTable->refreshOptions());

        $this->basicTable->setRefreshVisible();

        $this->assertSame('.visible', $this->basicTable->refreshOptions());

        $this->basicTable->setRefreshMethod('myMethod');

        $this->assertSame('=myMethod', $this->basicTable->refreshOptions());
    }
}

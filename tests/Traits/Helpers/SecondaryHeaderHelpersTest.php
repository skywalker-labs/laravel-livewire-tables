<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Traits\Helpers;

use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;

final class SecondaryHeaderHelpersTest extends TestCase
{
    public function test_can_get_secondary_header_status(): void
    {
        $this->assertTrue($this->basicTable->secondaryHeaderIsEnabled());

        $this->basicTable->setSecondaryHeaderDisabled();

        $this->assertTrue($this->basicTable->secondaryHeaderIsDisabled());

        $this->basicTable->setSecondaryHeaderEnabled();

        $this->assertTrue($this->basicTable->secondaryHeaderIsEnabled());
    }
}

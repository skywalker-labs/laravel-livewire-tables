<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Traits\Helpers;

use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;

final class EventHelpersTest extends TestCase
{
    public function test_can_get_event_names()
    {
        $this->assertSame(['columnSelected', 'searchApplied', 'filterApplied'], $this->basicTable->getEventNames());
    }

    public function test_can_get_event_statuses()
    {
        $this->assertSame(['columnSelected' => true, 'searchApplied' => false, 'filterApplied' => false], $this->basicTable->getEventStatuses());
    }
}

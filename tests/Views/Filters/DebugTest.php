<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Views\Filters;

use SkywalkerLabs\LaravelLivewireTables\View\Filters\DateFilter;

final class DebugTest extends FilterTestCase
{
    public function test_access_rows_hangs(): void
    {
        $rows = $this->basicTable->rows();
        $this->assertGreaterThan(0, $rows->count());
    }
}

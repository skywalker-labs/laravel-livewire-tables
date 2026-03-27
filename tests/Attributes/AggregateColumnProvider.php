<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Attributes;

final class AggregateColumnProvider
{
    public static function relationshipProvider(): array
    {
        return [
            ['users', 'age'],
        ];
    }
}

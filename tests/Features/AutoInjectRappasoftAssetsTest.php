<?php

namespace SkywalkerLabs\LaravelLivewireTables\Tests\Features;

use SkywalkerLabs\LaravelLivewireTables\Assets\AutoInjectSkywalkerLabsAssets;
use SkywalkerLabs\LaravelLivewireTables\Tests\TestCase;

final class AutoInjectSkywalkerLabsAssetsTest extends TestCase
{
    public function test_shouldInjectSkywalkerLabsAndThirdParty()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', true);
        config()->set('livewire-tables.inject_third_party_assets_enabled', true);

        $injectionReturn = AutoInjectSkywalkerLabsAssets::injectAssets('<html><head></head><body></body></html>');

        $this->assertStringContainsStringIgnoringCase('<link href="/SkywalkerLabs/laravel-livewire-tables/core.min.css" rel="stylesheet" />', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<script src="/SkywalkerLabs/laravel-livewire-tables/core.min.js"  ></script>', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<link href="/SkywalkerLabs/laravel-livewire-tables/thirdparty.css" rel="stylesheet" />', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<script src="/SkywalkerLabs/laravel-livewire-tables/thirdparty.min.js"  ></script>', $injectionReturn);
    }

    public function test_shouldNotInjectSkywalkerLabsOrThirdParty()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', false);
        config()->set('livewire-tables.inject_third_party_assets_enabled', false);

        $injectionReturn = AutoInjectSkywalkerLabsAssets::injectAssets('<html><head></head><body></body></html>');

        $this->assertEquals('<html><head>  </head><body></body></html>', AutoInjectSkywalkerLabsAssets::injectAssets('<html><head></head><body></body></html>'));
    }

    public function test_shouldOnlyInjectThirdParty()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', false);
        config()->set('livewire-tables.inject_third_party_assets_enabled', true);

        $injectionReturn = AutoInjectSkywalkerLabsAssets::injectAssets('<html><head></head><body></body></html>');

        $this->assertStringContainsStringIgnoringCase('<link href="/SkywalkerLabs/laravel-livewire-tables/thirdparty.css" rel="stylesheet" />', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<script src="/SkywalkerLabs/laravel-livewire-tables/thirdparty.min.js"  ></script>', $injectionReturn);
    }

    public function test_shouldOnlyInjectSkywalkerLabs()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', true);
        config()->set('livewire-tables.inject_third_party_assets_enabled', false);

        $injectionReturn = AutoInjectSkywalkerLabsAssets::injectAssets('<html><head></head><body></body></html>');

        $this->assertStringContainsStringIgnoringCase('<link href="/SkywalkerLabs/laravel-livewire-tables/core.min.css" rel="stylesheet" />', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<script src="/SkywalkerLabs/laravel-livewire-tables/core.min.js"  ></script>', $injectionReturn);

    }
}

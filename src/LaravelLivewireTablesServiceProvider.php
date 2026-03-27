<?php

namespace SkywalkerLabs\LaravelLivewireTables;

use Composer\InstalledVersions;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Livewire\ComponentHookRegistry;
use SkywalkerLabs\LaravelLivewireTables\Assets\AutoInjectSkywalkerLabsAssets;
use SkywalkerLabs\LaravelLivewireTables\Assets\SkywalkerLabsFrontendAssets;
use SkywalkerLabs\LaravelLivewireTables\Console\MakeTableCommand;

class LaravelLivewireTablesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        if (class_exists(AboutCommand::class) && class_exists(InstalledVersions::class)) {
            AboutCommand::add('SkywalkerLabs Laravel Livewire Tables', [
                'Version' => InstalledVersions::getPrettyVersion('SkywalkerLabs/laravel-livewire-tables'),
            ]);
        }

        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-tables.php', 'livewire-tables'
        );

        // Load Default Translations
        $this->loadJsonTranslationsFrom(
            __DIR__.'/../resources/lang'
        );

        // Override if Published
        $this->loadJsonTranslationsFrom(
            $this->app->langPath('vendor/livewire-tables')
        );

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-tables');

        $this->consoleCommands();

        if (config('livewire-tables.inject_core_assets_enabled') || config('livewire-tables.inject_third_party_assets_enabled') || config('livewire-tables.enable_blade_directives')) {
            (new SkywalkerLabsFrontendAssets)->boot();
        }

    }

    public function consoleCommands(): void
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../resources/lang' => $this->app->langPath('vendor/livewire-tables'),
            ], 'livewire-tables-translations');

            $this->publishes([
                __DIR__.'/../config/livewire-tables.php' => config_path('livewire-tables.php'),
            ], 'livewire-tables-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-tables'),
            ], 'livewire-tables-views');

            $this->publishes([
                __DIR__.'/../resources/js' => public_path('vendor/SkywalkerLabs/livewire-tables/js'),
                __DIR__.'/../resources/css' => public_path('vendor/SkywalkerLabs/livewire-tables/css'),
            ], 'livewire-tables-public');

            $this->commands([
                MakeTableCommand::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-tables.php', 'livewire-tables'
        );
        if (config('livewire-tables.inject_core_assets_enabled') || config('livewire-tables.inject_third_party_assets_enabled') || config('livewire-tables.enable_blade_directives')) {
            (new SkywalkerLabsFrontendAssets)->register();
            ComponentHookRegistry::register(AutoInjectSkywalkerLabsAssets::class);
        }
    }
}

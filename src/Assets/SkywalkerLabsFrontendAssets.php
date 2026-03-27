<?php

namespace SkywalkerLabs\LaravelLivewireTables\Assets;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Livewire\Drawer\Utils;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Mechanisms\WithSkywalkerLabsTableScripts;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Mechanisms\WithSkywalkerLabsTableStyles;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Mechanisms\WithSkywalkerLabsTableThirdPartyScripts;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Mechanisms\WithSkywalkerLabsTableThirdPartyStyles;
use Symfony\Component\HttpFoundation\Response;

class SkywalkerLabsFrontendAssets
{
    use WithSkywalkerLabsTableScripts;
    use WithSkywalkerLabsTableStyles;
    use WithSkywalkerLabsTableThirdPartyScripts;
    use WithSkywalkerLabsTableThirdPartyStyles;

    public function register(): void
    {
        app()->singleton($this::class);
    }

    public function boot(): void
    {
        // Set the JS route for the core tables JS
        app($this::class)->setSkywalkerLabsTableScriptRoute(function ($handle) {
            $scriptPath = rtrim(config('livewire-tables.script_base_path', '/SkywalkerLabs/laravel-livewire-tables'), '/').'/core.min.js';

            return Route::get($scriptPath, $handle);
        });

        // Set the CSS route for the core tables CSS
        app($this::class)->setSkywalkerLabsTableStylesRoute(function ($handle) {
            $stylesPath = rtrim(config('livewire-tables.script_base_path', '/SkywalkerLabs/laravel-livewire-tables'), '/').'/core.min.css';

            return Route::get($stylesPath, $handle);
        });

        // Set the JS route for the third party JS
        app($this::class)->setSkywalkerLabsTableThirdPartyScriptRoute(function ($handle) {
            $scriptPath = rtrim(config('livewire-tables.script_base_path', '/SkywalkerLabs/laravel-livewire-tables'), '/').'/thirdparty.min.js';

            return Route::get($scriptPath, $handle);
        });

        // Set the CSS route for the third party CSS
        app($this::class)->setSkywalkerLabsTableThirdPartyStylesRoute(function ($handle) {
            $stylesPath = rtrim(config('livewire-tables.script_base_path', '/SkywalkerLabs/laravel-livewire-tables'), '/').'/thirdparty.css';

            return Route::get($stylesPath, $handle);
        });

        static::registerBladeDirectives();

    }

    protected function registerBladeDirectives(): void
    {
        Blade::directive('SkywalkerLabsTableScripts', [static::class, 'SkywalkerLabsTableScripts']);
        Blade::directive('SkywalkerLabsTableStyles', [static::class, 'SkywalkerLabsTableStyles']);
        Blade::directive('SkywalkerLabsTableThirdPartyScripts', [static::class, 'SkywalkerLabsTableThirdPartyScripts']);
        Blade::directive('SkywalkerLabsTableThirdPartyStyles', [static::class, 'SkywalkerLabsTableThirdPartyStyles']);
    }

    protected function pretendResponseIsJs(string $file): Response
    {

        if (config('livewire-tables.cache_assets', false) === true) {
            $expires = strtotime('+1 day');
            $lastModified = filemtime($file);
            $cacheControl = 'public, max-age=86400';
        } else {
            $expires = strtotime('+1 second');
            $lastModified = Carbon::now()->timestamp;
            $cacheControl = 'public, max-age=1';
        }

        $headers = [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => Utils::httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => Utils::httpDate($lastModified),
        ];

        return response()->file($file, $headers);
    }

    protected function pretendResponseIsCSS(string $file): Response
    {
        if (config('livewire-tables.cache_assets', false) === true) {
            $expires = strtotime('+1 day');
            $lastModified = filemtime($file);
            $cacheControl = 'public, max-age=86400';
        } else {
            $expires = strtotime('+1 second');
            $lastModified = Carbon::now()->timestamp;
            $cacheControl = 'public, max-age=1';
        }

        $headers = [
            'Content-Type' => 'text/css; charset=utf-8',
            'Expires' => Utils::httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => Utils::httpDate($lastModified),
        ];

        return response()->file($file, $headers);
    }

    /*
    public function maps(): \Symfony\Component\HttpFoundation\Response
    {
        return Utils::pretendResponseIsFile(__DIR__.'/../../../resources/js/laravel-livewire-tables.min.js.map');
    }

    protected static function minify(string $subject): array|string|null
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }*/
}

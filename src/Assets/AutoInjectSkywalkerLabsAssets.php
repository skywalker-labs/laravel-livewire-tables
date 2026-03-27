<?php

namespace SkywalkerLabs\LaravelLivewireTables\Assets;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Livewire\ComponentHook;
use SkywalkerLabs\LaravelLivewireTables\Assets\SkywalkerLabsFrontendAssets;

use function Livewire\on;

class AutoInjectSkywalkerLabsAssets extends ComponentHook
{
    public static bool $hasRenderedAComponentThisRequest = false;

    public static bool $forceAssetInjection = false;

    public static bool $shouldInjectSkywalkerLabsThirdPartyAssets = false;

    public static bool $shouldInjectSkywalkerLabsAssets = false;

    public static function provide(): void
    {
        static::$shouldInjectSkywalkerLabsAssets = config('livewire-tables.inject_core_assets_enabled', true);
        static::$shouldInjectSkywalkerLabsThirdPartyAssets = config('livewire-tables.inject_third_party_assets_enabled', true);

        on('flush-state', function () {
            static::$hasRenderedAComponentThisRequest = false;
            static::$forceAssetInjection = false;
        });

        if (static::$shouldInjectSkywalkerLabsAssets || static::$shouldInjectSkywalkerLabsThirdPartyAssets) {

            app('events')->listen(RequestHandled::class, function (RequestHandled $handled) {

                if (! static::$shouldInjectSkywalkerLabsAssets && ! static::$shouldInjectSkywalkerLabsThirdPartyAssets) {
                    return;
                }

                // If All Scripts Have Been Rendered - Return
                if (
                    (
                        ! static::$shouldInjectSkywalkerLabsAssets || app(SkywalkerLabsFrontendAssets::class)->hasRenderedRappsoftTableScripts
                    ) &&
                    (
                        ! static::$shouldInjectSkywalkerLabsThirdPartyAssets || app(SkywalkerLabsFrontendAssets::class)->hasRenderedRappsoftTableThirdPartyScripts
                    )
                ) {
                    return;
                }

                if (! str($handled->response->headers->get('content-type'))->contains('text/html')) {
                    return;
                }

                if (! method_exists($handled->response, 'status') || ! method_exists($handled->response, 'getContent') || ! method_exists($handled->response, 'setContent') || ! method_exists($handled->response, 'getOriginalContent') || ! property_exists($handled->response, 'original')) {
                    return;
                }

                if ($handled->response->status() !== 200) {
                    return;
                }

                $html = $handled->response->getContent();

                if (str($html)->contains('</html>')) {
                    $original = $handled->response->getOriginalContent();
                    $handled->response->setContent(static::injectAssets($html));
                    $handled->response->original = $original;
                }
            });
        }
    }

    public function dehydrate(): void
    {
        static::$hasRenderedAComponentThisRequest = true;
    }

    public static function injectAssets(mixed $html): string
    {

        $html = str($html);
        $rappaStyles = ((static::$shouldInjectSkywalkerLabsAssets === true) ? SkywalkerLabsFrontendAssets::tableStyles() : '').' '.((static::$shouldInjectSkywalkerLabsThirdPartyAssets === true) ? SkywalkerLabsFrontendAssets::tableThirdPartyStyles() : '');
        $rappaScripts = ((static::$shouldInjectSkywalkerLabsAssets === true) ? SkywalkerLabsFrontendAssets::tableScripts() : '').' '.((static::$shouldInjectSkywalkerLabsThirdPartyAssets === true) ? SkywalkerLabsFrontendAssets::tableThirdPartyScripts() : '');

        if ($html->test('/<\s*head(?:\s|\s[^>])*>/i') && $html->test('/<\s*\/\s*body\s*>/i')) {
            static::$shouldInjectSkywalkerLabsAssets = static::$shouldInjectSkywalkerLabsThirdPartyAssets = false;

            return $html
                ->replaceMatches('/(<\s*head(?:\s|\s[^>])*>)/i', '$1'.$rappaStyles)
                ->replaceMatches('/(<\s*\/\s*head\s*>)/i', $rappaScripts.'$1')
                ->toString();
        }
        static::$shouldInjectSkywalkerLabsAssets = static::$shouldInjectSkywalkerLabsThirdPartyAssets = false;

        return $html
            ->replaceMatches('/(<\s*html(?:\s[^>])*>)/i', '$1'.$rappaStyles)
            ->replaceMatches('/(<\s*\/\s*head\s*>)/i', $rappaScripts.'$1')
            ->toString();
    }
}

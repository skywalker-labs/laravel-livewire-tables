<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns\Mechanisms;

use Livewire\Drawer\Utils;

trait WithSkywalkerLabsTableThirdPartyScripts
{
    /** SkywalkerLabs Third Party Scripts */
    public bool $hasRenderedRappsoftTableThirdPartyScripts = false;

    public mixed $SkywalkerLabsTableScriptThirdPartyRoute;

    public array $SkywalkerLabsTableScriptThirdPartyTagAttributes = [];

    /**
     * SkywalkerLabs Third Party Scripts
     */
    /**
     * Used if Injection Is Used
     */
    public function setSkywalkerLabsTableThirdPartyScriptRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnSkywalkerLabsTableThirdPartyJavaScriptAsFile']);

        $this->SkywalkerLabsTableScriptThirdPartyRoute = $route;
    }

    public function returnSkywalkerLabsTableThirdPartyJavaScriptAsFile(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->pretendResponseIsJs(__DIR__.'/../../../resources/js/laravel-livewire-tables-thirdparty.min.js');
    }

    /**
     *  Used If Injection is Disabled
     */
    public static function SkywalkerLabsTableThirdPartyScripts(mixed $expression): string
    {
        return '{!! \SkywalkerLabs\LaravelLivewireTables\Assets\SkywalkerLabsFrontendAssets::tableThirdPartyScripts('.$expression.') !!}';
    }

    public static function tableThirdPartyScripts(array $options = []): ?string
    {
        app(static::class)->hasRenderedRappsoftTableThirdPartyScripts = true;

        $debug = config('app.debug');

        $scripts = static::tableThirdpartyJs($options);

        // HTML Label.
        $html = $debug ? ['<!-- SkywalkerLabs Third Party Scripts -->'] : [];

        $html[] = $scripts;

        return implode("\n", $html);
    }

    public static function tableThirdpartyJs(array $options = []): string
    {
        // Use the default endpoint...
        $url = app(static::class)->SkywalkerLabsTableScriptThirdPartyRoute->uri;

        $url = rtrim($url, '/');

        $url = (string) str($url)->start('/');

        // Add the build manifest hash to it...

        $nonce = isset($options['nonce']) ? "nonce=\"{$options['nonce']}\"" : '';

        $extraAttributes = Utils::stringifyHtmlAttributes(
            app(static::class)->SkywalkerLabsTableScriptTagAttributes,
        );

        return <<<HTML
        <script src="{$url}" {$nonce} {$extraAttributes}></script>
        HTML;
    }
}

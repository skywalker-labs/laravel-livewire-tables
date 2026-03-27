<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns\Mechanisms;

use Livewire\Drawer\Utils;
use Symfony\Component\HttpFoundation\Response;

trait WithSkywalkerLabsTableScripts
{
    /** SkywalkerLabs Scripts */
    public bool $hasRenderedRappsoftTableScripts = false;

    public mixed $SkywalkerLabsTableScriptRoute;

    public array $SkywalkerLabsTableScriptTagAttributes = [];

    public function useSkywalkerLabsTableScriptTagAttributes(array $attributes): void
    {
        $this->SkywalkerLabsTableScriptTagAttributes = [...$this->SkywalkerLabsTableScriptTagAttributes, ...$attributes];
    }

    /**
     *  Used If Injection is Enabled
     */
    public function setSkywalkerLabsTableScriptRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnSkywalkerLabsTableJavaScriptAsFile']);

        $this->SkywalkerLabsTableScriptRoute = $route;
    }

    public function returnSkywalkerLabsTableJavaScriptAsFile(): Response
    {
        return $this->pretendResponseIsJs(__DIR__.'/../../../resources/js/laravel-livewire-tables.min.js');
    }

    /**
     *  Used if Injection is disabled
     */
    public static function SkywalkerLabsTableScripts(mixed $expression): string
    {
        return '{!! \SkywalkerLabs\LaravelLivewireTables\Assets\SkywalkerLabsFrontendAssets::tableScripts('.$expression.') !!}';
    }

    public static function tableScripts(array $options = []): ?string
    {
        app(static::class)->hasRenderedRappsoftTableScripts = true;

        $debug = config('app.debug');

        $scripts = static::tableJs($options);

        // HTML Label.
        $html = $debug ? ['<!-- SkywalkerLabs Core Table Scripts -->'] : [];

        $html[] = $scripts;

        return implode("\n", $html);
    }

    public static function tableJs(array $options = []): string
    {
        // Use the default endpoint...
        $url = app(static::class)->SkywalkerLabsTableScriptRoute->uri;

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

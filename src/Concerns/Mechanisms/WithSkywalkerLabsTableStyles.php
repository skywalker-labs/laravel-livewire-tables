<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns\Mechanisms;

use Symfony\Component\HttpFoundation\Response;

trait WithSkywalkerLabsTableStyles
{
    /** SkywalkerLabs Styles */
    public bool $hasRenderedRappsoftTableStyles = false;

    public mixed $SkywalkerLabsTableStylesRoute;

    public array $SkywalkerLabsTableStyleTagAttributes = [];

    /**
     *  Used If Injection is Enabled
     */
    public function setSkywalkerLabsTableStylesRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnSkywalkerLabsTableStylesAsFile']);

        $this->SkywalkerLabsTableStylesRoute = $route;
    }

    public function returnSkywalkerLabsTableStylesAsFile(): Response
    {
        return $this->pretendResponseIsCSS(__DIR__.'/../../../resources/css/laravel-livewire-tables.min.css');
    }

    /**
     *  Used If Injection is Disabled
     */
    public static function SkywalkerLabsTableStyles(mixed $expression): string
    {
        return '{!! \SkywalkerLabs\LaravelLivewireTables\Assets\SkywalkerLabsFrontendAssets::tableStyles('.$expression.') !!}';
    }

    public static function tableStyles(array $options = []): array|string|null
    {
        app(static::class)->hasRenderedRappsoftTableStyles = true;

        $debug = config('app.debug');

        $styles = static::tableCss($options);

        // HTML Label.
        $html = $debug ? ['<!-- SkywalkerLabs Core Table Styles -->'] : [];

        $html[] = $styles;

        return implode("\n", $html);

    }

    public static function tableCss(array $options = []): ?string
    {
        $styleUrl = app(static::class)->SkywalkerLabsTableStylesRoute->uri;
        $styleUrl = rtrim($styleUrl, '/');

        $styleUrl = (string) str($styleUrl)->start('/');

        return <<<HTML
            <link href="{$styleUrl}" rel="stylesheet" />
        HTML;
    }
}

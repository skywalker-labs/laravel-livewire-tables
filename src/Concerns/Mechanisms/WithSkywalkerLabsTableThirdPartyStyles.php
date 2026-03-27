<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns\Mechanisms;

trait WithSkywalkerLabsTableThirdPartyStyles
{
    /** SkywalkerLabs Third Party Styles */
    public bool $hasRenderedRappsoftTableThirdPartyStyles = false;

    public mixed $SkywalkerLabsTableThirdPartyStyleRoute;

    public array $SkywalkerLabsTableThirdPartyStyleTagAttributes = [];

    /**
     *  Used If Injection is Enabled
     */
    public function setSkywalkerLabsTableThirdPartyStylesRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnSkywalkerLabsTableThirdPartyStylesAsFile']);

        $this->SkywalkerLabsTableThirdPartyStyleRoute = $route;
    }

    public function returnSkywalkerLabsTableThirdPartyStylesAsFile(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->pretendResponseIsCSS(__DIR__.'/../../../resources/css/laravel-livewire-tables-thirdparty.min.css');
    }

    /**
     *  Used If Injection is Disabled
     */
    public static function SkywalkerLabsTableThirdPartyStyles(mixed $expression): string
    {
        return '{!! \SkywalkerLabs\LaravelLivewireTables\Assets\SkywalkerLabsFrontendAssets::tableThirdPartyStyles('.$expression.') !!}';
    }

    public static function tableThirdPartyStyles(array $options = []): array|string|null
    {
        app(static::class)->hasRenderedRappsoftTableThirdPartyStyles = true;

        $debug = config('app.debug');

        $styles = static::tableThirdPartyCss($options);

        // HTML Label.
        $html = $debug ? ['<!-- SkywalkerLabs Table Third Party Styles -->'] : [];

        $html[] = $styles;

        return implode("\n", $html);

    }

    public static function tableThirdPartyCss(array $options = []): ?string
    {
        $styleUrl = app(static::class)->SkywalkerLabsTableThirdPartyStyleRoute->uri;
        $styleUrl = rtrim($styleUrl, '/');

        $styleUrl = (string) str($styleUrl)->start('/');

        return <<<HTML
            <link href="{$styleUrl}" rel="stylesheet" />
        HTML;
    }
}

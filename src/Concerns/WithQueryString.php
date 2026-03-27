<?php

namespace SkywalkerLabs\LaravelLivewireTables\Concerns;

use Livewire\Attributes\Locked;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Configuration\QueryStringConfiguration;
use SkywalkerLabs\LaravelLivewireTables\Concerns\Helpers\QueryStringHelpers;

trait WithQueryString
{
    use QueryStringConfiguration,
        QueryStringHelpers;

    #[Locked]
    public ?bool $queryStringStatus;

    protected ?string $queryStringAlias;

    /**
     * Set the custom query string array for this specific table
     *
     * @return array<mixed>
     */
    protected function queryStringWithQueryString(): array
    {

        if ($this->queryStringIsEnabled()) {
            return [
                $this->getTableName() => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias()],
            ];
        }

        return [];
    }
}

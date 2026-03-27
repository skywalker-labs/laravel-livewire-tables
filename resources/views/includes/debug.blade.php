<div>
    @if ($this->debugIsEnabled())
        <p><strong>@lang('Debugging Values'):</strong></p>

        @if (! app()->runningInConsole())
            <div class="mb-4">@dump((new \SkywalkerLabs\LaravelLivewireTables\Support\DataTransferObjects\DebuggableData($this))->toArray())</div>
        @endif
    @endif
</div>

@aware(['component', 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
<div @class([
        'ml-0 ml-md-2' => $this->isBootstrap4,
        'ms-0 ms-md-2' => $this->isBootstrap5,
    ])
>
    <select wire:model.live="perPage" id="{{ $tableName }}-perPage"
        {{ 
            $attributes->merge($component->perPageFieldAttributes)
            ->class([
                'form-control' => $this->isBootstrap4 && $component->perPageFieldAttributes['default-styling'],
                'form-select' => $this->isBootstrap5 && $component->perPageFieldAttributes['default-styling'],
                'block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50' => $this->isTailwind && $component->perPageFieldAttributes['default-styling'],
                'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600' => $this->isTailwind && $component->perPageFieldAttributes['default-colors'],
            ])
            ->except(['default','default-styling','default-colors']) 
        }}
    >
        @foreach ($component->perPageAccepted as $item)
            <option
                value="{{ $item }}"
                wire:key="{{ $tableName }}-per-page-{{ $item }}"
            >
                {{ $item === -1 ? __('All') : $item }}
            </option>
        @endforeach
    </select>
</div>

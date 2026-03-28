<?php

return [
    /**
     * Options: tailwind | bootstrap-4 | bootstrap-5.
     */
    'theme' => 'tailwind',

    /**
     * Filter Frontend Asset Options
     */

    /**
     * Cache SkywalkerLabs Frontend Assets
     */
    'cache_assets' => false,

    /**
     * Enable or Disable automatic injection of core assets
     */
    'inject_core_assets_enabled' => true,

    /**
     * Enable or Disable automatic injection of third-party assets
     */
    'inject_third_party_assets_enabled' => true,

    /**
     * Enable Blade Directives (Not required if automatically injecting or using bundler approaches)
     */
    'enable_blade_directives' => false,

    /**
     * Customise Script & Styles Paths
     */
    'script_base_path' => '/SkywalkerLabs/laravel-livewire-tables',

    /**
     * Filter Default Configuration Options
     *
     * */

    /**
     * Configuration options for DateFilter
     */
    'date_filter' => [
        'default_config' => [
            'format' => 'Y-m-d',
            'pill_format' => 'd M Y', // Used to display in the Filter Pills
        ],
    ],

    /**
     * Configuration options for DateTimeFilter
     */
    'date_time_filter' => [
        'default_config' => [
            'format' => 'Y-m-d\TH:i',
            'pill_format' => 'd M Y - H:i', // Used to display in the Filter Pills
        ],
    ],

    /**
     * Configuration options for DateRangeFilter
     */
    'date_range' => [
        'default_options' => [],
        'default_config' => [
            'allow_input' => true,   // Allow manual input of dates
            'alt_format' => 'F j, Y', // Date format that will be displayed once selected
            'aria_date_format' => 'F j, Y', // An aria-friendly date format
            'date_format' => 'Y-m-d', // Date format that will be received by the filter
            'earliest_date' => null, // The earliest acceptable date
            'latest_date' => null, // The latest acceptable date
            'locale' => 'en', // The default locale
        ],
    ],

    /**
     * Configuration options for NumberRangeFilter
     */
    'number_range' => [
        'default_options' => [
            'min' => 0, // The default start value
            'max' => 100, // The default end value
        ],
        'default_config' => [
            'min_range' => 0, // The minimum possible value
            'max_range' => 100, // The maximum possible value
            'suffix' => '', // A suffix to append to the values when displayed
            'prefix' => '', // A prefix to prepend to the values when displayed
        ],
    ],
    /**
     * Configuration options for SelectFilter
     */
    'select_filter' => [
        'default_options' => [],
        'default_config' => [],
    ],
    /**
     * Configuration options for MultiSelectFilter
     */
    'multi_select_filter' => [
        'default_options' => [],
        'default_config' => [],
    ],

    /**
     * Configuration options for MultiSelectDropdownFilter
     */
    'multi_select_dropdown_filter' => [
        'default_options' => [],
        'default_config' => [],
    ],

];

/*jshint esversion: 6 */

function fpf() {
    Alpine.data('flatpickrFilter', (wire, filterKey, filterConfig, refLocation, locale) => ({
        wireValues: wire.entangle('filterComponents.' + filterKey),
        flatpickrInstance: flatpickr(refLocation, {
            mode: 'range',
            altFormat: filterConfig['alt_format'] ?? "F j, Y",
            altInput: filterConfig['alt_input'] ?? false,
            allowInput: filterConfig['allow_input'] ?? false,
            allowInvalidPreload: filterConfig['allow_invalid_preload'] ?? true,
            ariaDateFormat: filterConfig['aria_date_format'] ?? "F j, Y",
            clickOpens: true,
            dateFormat: filterConfig['date_format'] ?? "Y-m-d",
            defaultDate: filterConfig['default_date'] ?? null,
            defaultHour: filterConfig['default_hour'] ?? 12,
            defaultMinute: filterConfig['default_minute'] ?? 0,
            enableTime: filterConfig['enable_time'] ?? false,
            enableSeconds: filterConfig['enable_seconds'] ?? false,
            hourIncrement: filterConfig['hour_increment'] ?? 1,
            locale: filterConfig['locale'] ?? 'en',
            minDate: filterConfig['earliest_date'] ?? null,
            maxDate: filterConfig['latest_date'] ?? null,
            minuteIncrement: filterConfig['minute_increment'] ?? 5,
            shorthandCurrentMonth: filterConfig['shorthand_current_month'] ?? false,
            time_24hr: filterConfig['time_24hr'] ?? false,
            weekNumbers: filterConfig['week_numbers'] ?? false,
            onOpen: function () {
                window.childElementOpen = true;
            },
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 1) {
                    var dates = dateStr.split(' ');

                    var wireDateArray = {};
                    window.childElementOpen = false;
                    window.filterPopoverOpen = false;
                    wireDateArray = { 'minDate': dates[0], 'maxDate': (typeof dates[2] === "undefined") ? dates[0] : dates[2] };
                    wire.set('filterComponents.' + filterKey, wireDateArray);
                }

            },
        }),
        setupWire() {
            if (this.wireValues !== undefined) {
                if (this.wireValues.minDate !== undefined && this.wireValues.maxDate !== undefined) {
                    let initialDateArray = [this.wireValues.minDate, this.wireValues.maxDate];
                    this.flatpickrInstance.setDate(initialDateArray);
                }
                else {
                    this.flatpickrInstance.setDate([]);
                }
            }
            else {
                this.flatpickrInstance.setDate([]);
            }
        },
        init() {
            this.setupWire();
            this.$watch('wireValues', value => this.setupWire());
        }
    
    
    }));

}

export default fpf;
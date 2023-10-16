@props([
    /** @var \BoredProgrammers\LaraGrid\Components\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme */
    'theme',
])

<div
        wire:ignore
        x-data="LGDatePicker()"
        x-init="init()"
>
    <input
            x-ref="datePicker"
            type="text"
            wire:model="filter.{{ $column->getModelField() }}"
            class="{{ $theme->getFilterDate() }}"
    >
</div>

<script src="https://npmcdn.com/flatpickr/dist/l10n/{{ config('laragrid.locale') }}.js" defer></script>

<script>
  function LGDatePicker() {
    return {
      dataField: @js($column->getModelField()),
      element: null,
      selectedDates: null,

      init() {
        window.addEventListener(`LGdatePickerClear`, () => {
          if (this.$refs.datePicker && this.element) {
            this.element.clear()
          }
        })

        const options = this.getOptions();

        if (this.$refs && this.$refs.datePicker) {
          this.element = flatpickr(this.$refs.datePicker, options);

          this.selectedDates = this.$wire.get(`filters.${this.dataField}`);

          this.element.setDate(this.selectedDates);
        }
      },
      getOptions() {
        const options = {
          mode: 'range',
          defaultHour: 0,
          dateFormat: @js(config('laragrid.dateFormat')),
          locale: @js(config('laragrid.locale')),
        };

        options.onClose = (selectedDates, dateStr, instance) => {
          selectedDates = selectedDates.map(date => this.element.formatDate(date, 'Y-m-d'));

          if (selectedDates.length > 0 && (this.selectedDates !== dateStr)) {
            Livewire.dispatch('LGdatePickerChanged', {
              selectedDates: selectedDates,
              dateFormatted: dateStr,
              field: this.dataField,
            });
          }
        };

        return options;
      }
    }
  }
</script>

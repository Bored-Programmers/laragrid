@props([
    /** @var \BoredProgrammers\LaraGrid\Components\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme */
    'theme',
])

<div wire:ignore x-data="LGDatePicker()" x-init="init()">
    <input
            type="hidden"
            name="filter.{{ $column->getModelField() }}.from"
            wire:model.live="filter.{{ $column->getModelField() }}.from"
    >
    <input
            type="hidden"
            name="filter.{{ $column->getModelField() }}.to"
            wire:model.live="filter.{{ $column->getModelField() }}.to"
    >
    <input x-ref="datePicker" type="text" class="{{ $theme->getFilterDate() }}">
</div>

<script src="https://npmcdn.com/flatpickr/dist/l10n/{{ config('laragrid.locale') }}.js" defer></script>

<script>
  function LGDatePicker() {
    return {
      dataField: @js($column->getModelField()),
      element: null,

      init() {
        window.addEventListener(`LGdatePickerClear`, () => {
          if (this.$refs.datePicker && this.element) {
            this.element.clear()
          }
        })

        if (this.$refs && this.$refs.datePicker) {
          this.element = flatpickr(this.$refs.datePicker, this.getOptions());
        }
      },

      getOptions() {
        return {
          mode: 'range',
          defaultHour: 0,
          dateFormat: @js(config('laragrid.dateFormat')),
          locale: @js(config('laragrid.locale')),
          onClose: function (selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
              let from = moment(selectedDates[0]).format('YYYY-MM-DD');
              let to = moment(selectedDates[1]).format('YYYY-MM-DD');

              document.querySelector('input[name="filter.{{ $column->getModelField() }}.from"]').value = from;
              document.querySelector('input[name="filter.{{ $column->getModelField() }}.to"]').value = to;

              document.querySelector('input[name="filter.{{ $column->getModelField() }}.from"]').dispatchEvent(new Event('input'));
              document.querySelector('input[name="filter.{{ $column->getModelField() }}.to"]').dispatchEvent(new Event('input'));
            }
          }
        };
      }
    }
  }
</script>

@props([
    /** @var \BoredProgrammers\LaraGrid\Components\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme */
    'theme',
])

<div wire:ignore x-data="LGDatePicker()" x-init="init()">
    <input
            type="hidden"
            x-ref="filter.{{ $column->getModelField() }}.from"
            name="filter.{{ $column->getModelField() }}.from"
            wire:model.live="filter.{{ $column->getModelField() }}.from"
    >
    <input
            type="hidden"
            x-ref="filter.{{ $column->getModelField() }}.to"
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
          defaultDate: [
            '{{ $this->filter[$column->getModelField()]['from'] ?? null }}',
            '{{ $this->filter[$column->getModelField()]['to'] ?? null }}',
          ],
          dateFormat: @js(config('laragrid.date_format')),
          locale: @js(config('laragrid.locale')),
          onClose: function (selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
              console.log(selectedDates[0])
              let from = moment(selectedDates[0]).format('{{ config('laragrid.js_date_format') }}');
              let to = moment(selectedDates[1]).format('{{ config('laragrid.js_date_format') }}');

              elementFrom = document.querySelector(`input[name="filter.{{ $column->getModelField() }}.from"]`);
              elementTo = document.querySelector(`input[name="filter.{{ $column->getModelField() }}.to"]`);

              elementFrom.value = from;
              elementTo.value = to;

              elementFrom.dispatchEvent(new Event('input'));
              elementTo.dispatchEvent(new Event('input'));
            }
          }
        };
      }
    }
  }
</script>

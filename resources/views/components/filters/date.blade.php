@php use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column; @endphp
@php use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme; @endphp
@props([
    /** @var Column $column */
    'column',
    /** @var BaseLaraGridTheme $theme */
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
  <input x-ref="datePicker" type="text" class="{{ $theme->getFilterDateClass() }}">
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
        let defaultFrom = @this.
        get('filter.{{ $column->getModelField() }}.from');
        let defaultTo = @this.
        get('filter.{{ $column->getModelField() }}.to');

        return {
          mode: 'range',
          defaultHour: 0,
          defaultDate: [defaultFrom, defaultTo],
          dateFormat: @js(config('laragrid.date_format')),
          locale: @js(config('laragrid.locale')),
          onClose: function (selectedDates) {
            if (selectedDates.length === 2) {
              let from = moment(selectedDates[0]).format('{{ config('laragrid.js_date_format') }}');
              let to = moment(selectedDates[1]).format('{{ config('laragrid.js_date_format') }}');

              let elementFrom = document.querySelector(`input[name="filter.{{ $column->getModelField() }}.from"]`);
              let elementTo = document.querySelector(`input[name="filter.{{ $column->getModelField() }}.to"]`);

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

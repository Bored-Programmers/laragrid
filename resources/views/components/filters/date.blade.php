@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Theme\FilterTheme)

@props([
    /** @var Column $column */
    'column',
    /** @var FilterTheme $filterTheme */
    'filterTheme',
])

<div
        wire:ignore
        x-data="LGDatePicker(
            @js($column->getRecordField()),
            @js(config('laragrid.flatpickr.js_date_format')),
            @js(config('laragrid.flatpickr.date_format')),
            @js(config('laragrid.flatpickr.locale')),
            @js($this->filter[$column->getRecordField()]['from'] ?? null),
            @js($this->filter[$column->getRecordField()]['to'] ?? null)
        )"
        x-init="init()"
>
    <input
            type="hidden"
            x-ref="filter.{{ $column->getRecordField() }}.from"
            name="filter.{{ $column->getRecordField() }}.from"
            wire:model.live="filter.{{ $column->getRecordField() }}.from"
    >
    <input
            type="hidden"
            x-ref="filter.{{ $column->getRecordField() }}.to"
            name="filter.{{ $column->getRecordField() }}.to"
            wire:model.live="filter.{{ $column->getRecordField() }}.to"
    >
    <input x-ref="datePicker" type="text" class="{{ $filterTheme->getFilterDateClass() }}">
</div>

@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme)

@props([
    /** @var Column $column */
    'column',
    /** @var BaseLaraGridTheme $theme */
    'theme',
])

<div
        wire:ignore
        x-data="LGDatePicker(
            @js($column->getModelField()),
            @js(config('laragrid.flatpickr.js_date_format')),
            @js(config('laragrid.flatpickr.date_format')),
            @js(config('laragrid.flatpickr.locale')),
            @js($this->filter[$column->getModelField()]['from'] ?? null),
            @js($this->filter[$column->getModelField()]['to'] ?? null)
        )"
        x-init="init()"
>
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

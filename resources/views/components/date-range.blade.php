@props([
    /** @var \BoredProgrammers\LaraGrid\Components\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme */
    'theme',
])

@php($filter = $column->getFilter())

@if ($filter instanceof \BoredProgrammers\LaraGrid\Filters\DateRangeFilter && $filter->isOneInput())
    <input
            type="text"
            wire:model.live="filter.{{ $column->getModelField() }}"
            class="{{ $theme->getFilterDate() }}"
    >
@else
    <input
            type="text"
            wire:model.live="filter.{{ $column->getModelField() }}.from"
            class="{{ $theme->getFilterDate() }}"
    > -
    <input
            type="text"
            wire:model.live="filter.{{ $column->getModelField() }}.to"
            class="{{ $theme->getFilterDate() }}"
    >
@endif

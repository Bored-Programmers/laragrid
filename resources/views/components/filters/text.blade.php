@php use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column; @endphp
@php use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme; @endphp
@props([
    /** @var Column $column */
    'column',
    /** @var BaseLaraGridTheme $theme */
    'theme'
])

<input type="text" class="{{ $theme->getFilterTextClass() }}" wire:model.live="filter.{{ $column->getModelField() }}">

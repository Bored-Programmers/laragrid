@props([
    /** @var \BoredProgrammers\LaraGrid\Components\ColumnComponents\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme */
    'theme'
])

<input type="text" class="{{ $theme->getFilterTextClass() }}" wire:model.live="filter.{{ $column->getModelField() }}">

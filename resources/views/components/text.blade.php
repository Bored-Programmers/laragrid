@props([
    /** @var \BoredProgrammers\LaraGrid\Components\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseTheme $theme */
    'theme'
])

<input type="text" class="{{ $theme->getFilterText() }}" wire:model.live="filter.{{ $column->getModelField() }}">

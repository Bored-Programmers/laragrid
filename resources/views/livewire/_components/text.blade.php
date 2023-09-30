@props([
    /** @var \BoredProgrammers\LaraGrid\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme $theme */
    'theme'
])

<input type="text" class="{{ $theme->getFilterText() }}" wire:model.live="filter.{{ $column->getModelField() }}">

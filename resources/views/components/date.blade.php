@props([
    /** @var \BoredProgrammers\LaraGrid\Components\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseTheme $theme */
    'theme',
])

<input type="text" wire:model.live="filter.{{ $column->getModelField() }}" class="{{ $theme->getFilterDate() }}">

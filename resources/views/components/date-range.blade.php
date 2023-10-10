@props([
    /** @var \BoredProgrammers\LaraGrid\Components\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseTheme $theme */
    'theme',
])

<input type="text" wire:model.live="filter.{{ $column->getModelField() }}.from" class="{{ $theme->getFilterDate() }}"> -
<input type="text" wire:model.live="filter.{{ $column->getModelField() }}.to" class="{{ $theme->getFilterDate() }}">

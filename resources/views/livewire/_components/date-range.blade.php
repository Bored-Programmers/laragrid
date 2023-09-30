@props([
    /** @var \BoredProgrammers\LaraGrid\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme $theme */
    'theme',
])

<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.from"> -
<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.to">

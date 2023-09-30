@props([
    /** @var \BoredProgrammers\Laragrid\Livewire\Column $column */
    'column',
    /** @var \BoredProgrammers\Laragrid\Livewire\Theme $theme */
    'theme'
])

<input type="text" class="{{ $theme->getFilterText() }}" wire:model.live="filter.{{ $column->getModelField() }}">

@props([
    /** @var \BoredProgrammers\LaraGrid\Livewire\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Livewire\Theme $theme */
    'theme'
])

<input type="text" class="{{ $theme->getFilterText() }}" wire:model.live="filter.{{ $column->getModelField() }}">

@props([
    /** @var \BoredProgrammers\LaraGrid\Livewire\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Livewire\Theme $theme */
    'theme',
])

<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.from"> -
<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.to">

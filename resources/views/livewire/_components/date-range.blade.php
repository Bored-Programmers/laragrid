@props([
    /** @var \BoredProgrammers\Laragrid\Livewire\Column $column */
    'column',
    /** @var \BoredProgrammers\Laragrid\Livewire\Theme $theme */
    'theme',
])

<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.from"> -
<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.to">

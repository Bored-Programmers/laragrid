@props([
    /** @var \App\Livewire\LaraGrid\Column $column */
    'column',
])

<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.from"> -
<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.to">

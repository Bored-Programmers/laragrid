@props([
    /** @var \App\Livewire\BaseColumn $column */
    'column',
])

<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.from"> -
<input type="date" wire:model.live="filter.{{ $column->getModelField() }}.to">

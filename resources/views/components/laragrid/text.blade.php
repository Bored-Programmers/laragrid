@props([
    /** @var \App\Livewire\BaseColumn $column */
    'column',
])

<input type="text" wire:model.live="filter.{{ $column->getModelField() }}">

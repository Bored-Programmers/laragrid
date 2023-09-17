@props([
    /** @var \App\Livewire\Column $column */
    'column',
])

<input type="text" wire:model.live="filter.{{ $column->getModelField() }}">

@props([
    /** @var \App\Livewire\LaraGrid\Column $column */
    'column',
])

<input type="text" wire:model.live="filter.{{ $column->getModelField() }}">

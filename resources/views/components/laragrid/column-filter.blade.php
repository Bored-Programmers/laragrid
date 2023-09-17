@props([
    /** @var \App\Livewire\Column $column */
    'column',
    'sortColumn',
    'sortDirection',
])

<span wire:click="sort('{{ $column->getModelField() }}')">
    @lang($column->getLabel())

    @if ($sortColumn === $column->getModelField())
        <span>
            @if ($sortDirection === 'asc')
                &uarr;
            @else
                &darr;
            @endif
        </span>
    @endif
</span>

@switch($column->getFilter()?->getFilterType())
    @case(\App\Livewire\Enums\FilterType::TEXT)
        <x-laragrid.text :column="$column"/>
        @break

    @case(\App\Livewire\Enums\FilterType::SELECT)
        <x-laragrid.select :column="$column"/>
        @break

    @case(\App\Livewire\Enums\FilterType::DATE)
        <x-laragrid.date-range :column="$column"/>
        @break
@endswitch

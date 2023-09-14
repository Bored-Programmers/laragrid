@props([
    /** @var \App\Livewire\BaseColumn $column */
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

@switch($column->getFilterType())
    @case(\App\Livewire\FilterType::TEXT)
        <x-laragrid.text :column="$column"/>
        @break

    @case(\App\Livewire\FilterType::SELECT)
        <x-laragrid.select :column="$column"/>
        @break

    @case(\App\Livewire\FilterType::DATE)
        <x-laragrid.date-range :column="$column"/>
        @break
@endswitch

@props([
    /** @var \BoredProgrammers\LaraGrid\Livewire\Column $column */
    'column',
    'sortColumn',
    'sortDirection',
    'theme',
])

<div
        @if ($column->isSortable())
            wire:click="sort('{{ $column->getModelField() }}')"
        @endif
>
    @if ($column->isSortable())
        <span>
            @if ($sortColumn !== $column->getModelField())
                &#8597;
            @elseif ($sortDirection === 'asc')
                &uarr;
            @elseif ($sortDirection === 'desc')
                &darr;
            @endif
        </span>
    @endif

    <span>
        @lang($column->getLabel())
    </span>
</div>

@switch($column->getFilter()?->getFilterType())
    @case(\BoredProgrammers\LaraGrid\Enums\FilterType::TEXT)
        <x-laragrid::text :column="$column" :theme="$theme" />
        @break

    @case(\BoredProgrammers\LaraGrid\Enums\FilterType::SELECT)
        <x-laragrid::select :column="$column" :theme="$theme" />
        @break

    @case(\BoredProgrammers\LaraGrid\Enums\FilterType::DATE)
        <x-laragrid::date-range :column="$column" :theme="$theme" />
        @break
@endswitch

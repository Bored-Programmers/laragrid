@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)

@props([
    /** @var Column $column */
    'column',
    'sortColumn',
    'sortDirection',
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

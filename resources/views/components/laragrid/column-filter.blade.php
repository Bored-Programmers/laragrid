@props([
    /** @var \App\Livewire\LaraGrid\Column $column */
    'column',
    'sortColumn',
    'sortDirection',
    'theme',
])

<span
        @if ($column->isSortable())
            class="{{ $theme->getLink() }}"
            wire:click="sort('{{ $column->getModelField() }}')"
        @endif
>
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
    @case(\App\Livewire\LaraGrid\Enums\FilterType::TEXT)
        <x-laragrid.text :column="$column"/>
        @break

    @case(\App\Livewire\LaraGrid\Enums\FilterType::SELECT)
        <x-laragrid.select :column="$column"/>
        @break

    @case(\App\Livewire\LaraGrid\Enums\FilterType::DATE)
        <x-laragrid.date-range :column="$column"/>
        @break
@endswitch

@props([
    /** @var \App\Modules\Admin\Livewire\LaraGrid\Column $column */
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
    @case(App\Modules\Admin\Livewire\LaraGrid\Enums\FilterType::TEXT)
        <x-admin::laragrid.text :column="$column" :theme="$theme" />
        @break

    @case(App\Modules\Admin\Livewire\LaraGrid\Enums\FilterType::SELECT)
        <x-admin::laragrid.select :column="$column" :theme="$theme" />
        @break

    @case(App\Modules\Admin\Livewire\LaraGrid\Enums\FilterType::DATE)
        <x-admin::laragrid.date-range :column="$column" :theme="$theme" />
        @break
@endswitch

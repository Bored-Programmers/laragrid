@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Filters\Enums\FilterType)
@use(BoredProgrammers\LaraGrid\Theme\FilterTheme)

@props([
    /** @var Column $column */
    'column',
    /** @var FilterTheme $filterTheme */
    'filterTheme',
])

@switch($column->getFilter()?->getFilterType())
    @case(FilterType::TEXT)
        <x-laragrid::filters.text
                :$column
                :$filterTheme
        />
        @break

    @case(FilterType::SELECT)
        <x-laragrid::filters.select
                :$column
                :$filterTheme
        />
        @break

    @case(FilterType::DATE)
        <x-laragrid::filters.date
                :$column
                :$filterTheme
        />
        @break
@endswitch

@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme)
@use(BoredProgrammers\LaraGrid\Filters\Enums\FilterType)

@props([
    /** @var Column $column */
    'column',
    /** @var BaseLaraGridTheme $theme */
    'theme',
])

@switch($column->getFilter()?->getFilterType())
    @case(FilterType::TEXT)
        <x-laragrid::filters.text
                :$column
                :$theme
        />
        @break

    @case(FilterType::SELECT)
        <x-laragrid::filters.select
                :$column
                :$theme
        />
        @break

    @case(FilterType::DATE)
        <x-laragrid::filters.date
                :$column
                :$theme
        />
        @break
@endswitch

@php use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column; @endphp
@php use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme; @endphp
@php use BoredProgrammers\LaraGrid\Filters\Enums\FilterType; @endphp
@props([
    /** @var Column $column */
    'column',
    /** @var BaseLaraGridTheme $theme */
    'theme',
])

@switch($column->getFilter()?->getFilterType())
    @case(FilterType::TEXT)
        <x-laragrid::filters.text :column="$column" :theme="$theme"/>
        @break

    @case(FilterType::SELECT)
        <x-laragrid::filters.select :column="$column" :theme="$theme"/>
        @break

    @case(FilterType::DATE)
        <x-laragrid::filters.date :column="$column" :theme="$theme"/>
        @break
@endswitch

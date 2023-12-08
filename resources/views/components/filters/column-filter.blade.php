@props([
    /** @var \BoredProgrammers\LaraGrid\Components\ColumnComponents\Column $column */
    'column',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme */
    'theme',
])

@switch($column->getFilter()?->getFilterType())
    @case(\BoredProgrammers\LaraGrid\Filters\Enums\FilterType::TEXT)
        <x-laragrid::filters.text :column="$column" :theme="$theme"/>
        @break

    @case(\BoredProgrammers\LaraGrid\Filters\Enums\FilterType::SELECT)
        <x-laragrid::filters.select :column="$column" :theme="$theme"/>
        @break

    @case(\BoredProgrammers\LaraGrid\Filters\Enums\FilterType::DATE)
        <x-laragrid::filters.date :column="$column" :theme="$theme"/>
        @break
@endswitch

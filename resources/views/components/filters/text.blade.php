@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Theme\FilterTheme)

@props([
    /** @var Column $column */
    'column',
    /** @var FilterTheme $filterTheme */
    'filterTheme',
])

<input
        type="text"
        class="{{ $filterTheme->getFilterTextClass() }}"
        wire:model.live="filter.{{ $column->getModelField() }}"
>

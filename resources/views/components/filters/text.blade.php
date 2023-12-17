@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme)

@props([
    /** @var Column $column */
    'column',
    /** @var BaseLaraGridTheme $theme */
    'theme'
])

<input type="text" class="{{ $theme->getFilterTextClass() }}" wire:model.live="filter.{{ $column->getModelField() }}">

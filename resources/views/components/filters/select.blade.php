@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Theme\FilterTheme)
@use(BoredProgrammers\LaraGrid\Filters\SelectFilter)

@props([
    /** @var Column $column */
    'column',
    /** @var Filter $filterTheme */
    'filterTheme',
])

@php
    /** @var SelectFilter $filter */
    $filter = $column->getFilter()
@endphp

<select wire:model.live="filter.{{ $column->getRecordField() }}" class="{{ $filterTheme->getFilterSelectClass() }}">
    @if($filter->getPrompt())
        <option wire:key="item-prompt" value="">@lang($filter->getPrompt())</option>
    @endif
    @foreach($filter->getOptions() as $option)
        <option
                wire:key="item-{{ $option->getValue() }}"
                value="{{ $option->getValue() }}"
        >
            @lang($option->getLabel())
        </option>
    @endforeach
</select>

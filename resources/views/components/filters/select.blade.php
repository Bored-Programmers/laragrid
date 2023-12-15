@php use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column; @endphp
@php use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme; @endphp
@php use BoredProgrammers\LaraGrid\Filters\SelectFilter; @endphp
@props([
    /** @var Column $column */
    'column',
    /** @var BaseLaraGridTheme $theme */
    'theme',
])

@php
    /** @var SelectFilter $filter */
    $filter = $column->getFilter()
@endphp

<select wire:model.live="filter.{{ $column->getModelField() }}" class="{{ $theme->getFilterSelectClass() }}">
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

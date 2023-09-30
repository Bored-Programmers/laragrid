@props([
    /** @var \BoredProgrammers\LaraGrid\Livewire\Column $column */
    'column',
])

@php
    /** @var \LaraGrid\Filters\SelectFilter $filter */
    $filter = $column->getFilter()
@endphp

<select wire:model.live="filter.{{ $column->getModelField() }}">
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

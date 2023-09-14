@props([
    /** @var \App\Livewire\BaseColumn $column */
    'column',
])

<select wire:model.live="filter.{{ $column->getModelField() }}">
    @if($column->getPrompt())
        <option wire:key="item-prompt" value="">@lang($column->getPrompt())</option>
    @endif
    @foreach($column->getOptions() as $option)
        <option
                wire:key="item-{{ $option->getValue() }}"
                value="{{ $option->getValue() }}"
        >
            @lang($option->getLabel())
        </option>
    @endforeach
</select>

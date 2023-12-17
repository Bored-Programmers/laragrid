@props([
    /** @var \BoredProgrammers\LaraGrid\Filters\FilterResetButton $filterResetButton */
    'filterResetButton',
])

<{{ $filterResetButton->getColumnTag() }}
    {!! $filterResetButton->callAttributes($record) !!}
    wire:click="resetFilters"
>
    {{ $filterResetButton->callRenderer($record) }}
</{{ $filterResetButton->getColumnTag() }}>
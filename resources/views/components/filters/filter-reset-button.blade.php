@props([
    /** @var \BoredProgrammers\LaraGrid\Filters\FilterResetButton $filterResetButton */
    'filterResetButton',
])

<{{ $filterResetButton->getColumnTag() }}
    {!! $filterResetButton->callAttributes() !!}
    wire:click="resetFilters"
>
    {{ $filterResetButton->callRenderer() }}
</{{ $filterResetButton->getColumnTag() }}>
@props([
    /** @var \BoredProgrammers\LaraGrid\Components\ColumnComponents\Column */
    'column',
    'record',
])

<{{ $column->getColumnTag() }} {!! $column->callAttributes($record) !!}>
    {!! $column->callRenderer($record) !!}
</{{ $column->getColumnTag() }}>
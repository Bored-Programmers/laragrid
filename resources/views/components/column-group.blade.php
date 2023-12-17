@props([
    /** @var \BoredProgrammers\LaraGrid\Components\ColumnComponents\ColumnGroup */
    'column',
    'record',
])

@foreach($column->getColumns() as $childColumn)
    <{{ $childColumn->getColumnTag() }} {!! $childColumn->callAttributes($record) !!}>
    {{ $childColumn->callRenderer($record) }}
    </{{ $childColumn->getColumnTag() }}>
@endforeach
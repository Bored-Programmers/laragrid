@php
    /** @var \App\Livewire\BaseColumn[] $columns */
@endphp

<div>
    <table class="table">
        <a wire:click="resetFilters">
            @lang('laragrid.migrationReset')
        </a>

        <thead>
        <tr>
            @foreach($columns as $column)
                <th>
                    <x-laragrid.column-filter
                            :column="$column"
                            :sort-column="$sortColumn"
                            :sort-direction="$sortColumn"
                    />
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                @foreach($columns as $column)
                    <td>{{ $column->getRecordValue($record) }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $records->links() }}
</div>

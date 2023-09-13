<table class="table">
    <thead>
    <tr>
        @foreach($columns as $column)
            <th>
                {{ $column['label'] }}
                @if($column['sortable'])
                    <button wire:click="sortBy('{{ $column['name'] }}')">Sort</button>
                @endif
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            @foreach($columns as $column)
                <td>{{ $user->{$column['name']} }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

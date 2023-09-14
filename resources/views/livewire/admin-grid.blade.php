<div>
    <table class="table">
        <a wire:click="test">
            @lang('laragrid.migrationReset')
        </a>

        <input type="text" wire:model.live="search">
        {{ $search }}

        <thead>
        <tr>
            @foreach($columns as $columnName => $columnProperties)
                <th>
                    @switch($columnProperties['type'])
                        @case('text')
                            <input type="text" wire:model.live="filter.{{ $columnName }}">
                            @break

                        @case('select')
                            <select wire:model.live="filter.{{ $columnName }}">
                                @if($columnProperties['includePrompt'])
                                    <option wire:key="item-prompt" value="">@lang('laragrid.choose')</option>
                                @endif
                                @foreach($columnProperties['options'] as $value => $label)
                                    <option wire:key="item-{{ $value }}" value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @break

                        @case('date')
                            <input type="date" wire:model.live="filter.{{ $columnName }}.from"> to
                            <input type="date" wire:model.live="filter.{{ $columnName }}.to">
                            @break
                    @endswitch
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                @foreach($columns as $columnName => $columnProperties)
                    @if (is_bool($user->{$columnName}))
                        <td>{{ $columnProperties['options'][$user->{$columnName}] }}</td>
                    @else
                        <td>{{ $user->{$columnName} }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>

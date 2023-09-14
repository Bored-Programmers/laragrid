<div>
    <table class="table">
        <thead>
        <tr>
            @foreach($columns as $columnName => $columnProperties)
                <th>
                    @switch($columnProperties['type'])
                        @case('text')
                            <input type="text" wire:model.live="filter.{{ $columnName }}">
                            @break

                        @case('select')
                            {{-- You'd need to define your select options somehow --}}
                            <select wire:model.live="filter.{{ $columnName }}">
                                <option value="">Select...</option>
                                <option value="example@email.com">example@email.com</option>
                            </select>
                            @break

                        @case('date')
                            <input type="date" wire:model.live="filter.{{ $columnName }}.0"> to
                            <input type="date" wire:model.live="filter.{{ $columnName }}.1">
                            @break

                        @case('boolean')
                            <select wire:model.live="filter.{{ $columnName }}">
                                <option value="">@lang('any')</option>
                                <option value="1">@lang('yes')</option>
                                <option value="0">@lang('no')</option>
                            </select>
                            @break

                        @default
                            <input type="text" wire:model.live="filter.{{ $columnName }}">
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
                        <td>{{ $user->{$columnName} ? __('yes') : __('no') }}</td>
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

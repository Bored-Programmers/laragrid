@use(Illuminate\Contracts\Pagination\LengthAwarePaginator)
@use(BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme)
@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\BaseColumn)
@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\ColumnGroup)
@use(BoredProgrammers\LaraGrid\Filters\FilterResetButton)

@php
    /**
    * @var Column[] $columns
    * @var LengthAwarePaginator $records
    * @var BaseLaraGridTheme $theme
    * @var FilterResetButton $filterResetButton
    */
@endphp

@assets
    <link href="{{ asset('vendor/laragrid/css/flatpickr.min.css') }}" rel="stylesheet"/>
@endassets

<div>
    <table class="{{ $theme->getTableClass() }}">
        <div wire:ignore.self>
            @if($this->filter)
                <x-laragrid::filters.filter-reset-button :$filterResetButton/>
            @endif
        </div>

        <thead class="{{ $theme->getTheadClass() }}">
        <tr class="{{ $theme->getTrClass() }}">
            @foreach($columns as $column)
                @if($column instanceof BaseColumn)
                    <th class="{{ $theme->getThClass() }}">
                        <x-laragrid::column-label
                                :$column
                                :$sortColumn
                                :$sortDirection
                        />
                    </th>
                @elseif($column instanceof ColumnGroup)
                    <th class="{{ $theme->getThClass() }}">
                        <div>
                            <span>
                                @lang($column->getLabel())
                            </span>
                        </div>
                    </th>
                @endif
            @endforeach
        </tr>
        <tr class="{{ $theme->getFilterTrClass() }}">
            @foreach($columns as $column)
                @if($column instanceof Column)
                    <td wire:key="column-filter-{{ $column->getModelField() }}">
                        <x-laragrid::filters.column-filter
                                :$theme
                                :$column
                                :$sortColumn
                                :$sortDirection
                        />
                    </td>
                @endif
            @endforeach
        </tr>
        </thead>
        <tbody class="{{ $theme->getTbodyClass() }}">
        @forelse($records as $record)
            <tr class="{{ $theme->callRecordTrClass($record) }}">
                @foreach($columns as $column)
                    @if($column instanceof BaseColumn)
                        <td class="{{ $theme->getTdClass() }}">
                            <x-laragrid::column :$column :$record/>
                        </td>
                    @elseif($column instanceof ColumnGroup)
                        <td class="{{ $theme->getGroupTdClass() }}">
                            <x-laragrid::column-group :$column :$record/>
                        </td>
                    @endif
                @endforeach
            </tr>
        @empty
            <tr class="{{ $theme->getTrClass() }}">
                <td colspan="{{ count($columns) }}">
                    <div class="{{ $theme->getEmptyMessageClass() }}">
                        @lang('laragrid::translations.empty')
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="{{ $theme->getPaginationClass() }}">
        {{ $records->links() }}
    </div>
</div>

<script src="{{ asset('vendor/laragrid/js/flatpickr.min.js') }}"></script>
<script src="{{ asset('vendor/laragrid/js/dayjs.min.js') }}"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/{{ config('laragrid.flatpickr.locale') }}.js"></script>
<script src="{{ asset('vendor/laragrid/js/date-picker.js') }}"></script>
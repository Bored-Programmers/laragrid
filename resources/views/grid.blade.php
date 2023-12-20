@use(Illuminate\Contracts\Pagination\LengthAwarePaginator)

@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\BaseColumn)
@use(BoredProgrammers\LaraGrid\Components\ColumnComponents\ColumnGroup)

@use(BoredProgrammers\LaraGrid\Filters\FilterResetButton)

@use(BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme)
@use(BoredProgrammers\LaraGrid\Theme\FilterTheme)
@use(BoredProgrammers\LaraGrid\Theme\THeadTheme)
@use(BoredProgrammers\LaraGrid\Theme\TBodyTheme)

@php
    /**
    * @var Column[] $columns
    * @var LengthAwarePaginator $records
    * @var BaseLaraGridTheme $theme
    * @var FilterTheme $filterTheme
    * @var TheadTheme $theadTheme
    * @var TbodyTheme $tbodyTheme
    * @var FilterResetButton $filterResetButton
    */
    $theme = $this->getTheme();
    $filterResetButton = $this->getFilterResetButton();
    $filterTheme = $theme->getFilterTheme();
    $theadTheme = $theme->getTHeadTheme();
    $tbodyTheme = $theme->getTBodyTheme();
@endphp

@assets
<link href="{{ asset('vendor/laragrid/css/flatpickr.min.css') }}" rel="stylesheet" />
@endassets

<div style="overflow-x: auto;padding:1px;"> {{-- padding 1px to prevent border focus issues --}}
    <div class="{{ $theme->getHeaderClass() }}">
        @if(method_exists($this, 'getLayout'))
            {!! $this->getLayout($theme)->callHeaderRenderer() !!}
        @endif
    </div>

    <table class="{{ $theme->getTableClass() }}">
        <div wire:ignore.self>
            @if($this->filter)
                <x-laragrid::filters.filter-reset-button
                        :$filterResetButton
                />
            @endif
        </div>

        <thead class="{{ $theadTheme->getTheadClass() }}">
        <tr class="{{ $theadTheme->getTrClass() }}">
            @foreach($columns as $column)
                @if($column instanceof BaseColumn)
                    <th class="{{ $theadTheme->getThClass() }}">
                        <x-laragrid::column-label
                                :$column
                                :$sortColumn
                                :$sortDirection
                        />
                    </th>
                @elseif($column instanceof ColumnGroup)
                    <th class="{{ $theadTheme->getThClass() }}">
                        <div>
                                <span>
                                    @lang($column->getLabel())
                                </span>
                        </div>
                    </th>
                @endif
            @endforeach
        </tr>
        <tr class="{{ $theadTheme->getTrClass() }}">
            @foreach($columns as $column)
                @if($column instanceof Column)
                    <th
                            wire:key="column-filter-{{ $column->getModelField() }}"
                            class="{{ $theadTheme->getThClass() }}"
                    >
                        <x-laragrid::filters.column-filter
                                :$filterTheme
                                :$column
                                :$sortColumn
                                :$sortDirection
                        />
                    </th>
                @endif
            @endforeach
        </tr>
        </thead>
        <tbody class="{{ $tbodyTheme->getTbodyClass() }}">
        @forelse($records as $record)
            <tr class="{{ $tbodyTheme->callRecordTrClass($record) }}">
                @foreach($columns as $column)
                    @if($column instanceof BaseColumn)
                        <td class="{{ $tbodyTheme->getTdClass() }}">
                            <x-laragrid::column
                                    :$column
                                    :$record
                            />
                        </td>
                    @elseif($column instanceof ColumnGroup)
                        <td class="{{ $tbodyTheme->getGroupTdClass() }}">
                            <x-laragrid::column-group
                                    :$column
                                    :$record
                            />
                        </td>
                    @endif
                @endforeach
            </tr>
        @empty
            <tr class="{{ $tbodyTheme->getTrClass() }}">
                <td colspan="{{ count($columns) }}">
                    <div class="{{ $tbodyTheme->getEmptyMessageClass() }}">
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

    <select wire:model.live="perPage" class="{{ $theme->getPerPageClass() }}">
        @foreach($this->perPageOptions as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>

    <div class="{{ $theme->getFooterClass() }}">
        @if(method_exists($this, 'getLayout'))
            {!! $this->getLayout($theme)->callFooterRenderer() !!}
        @endif
    </div>
</div>

<script src="{{ asset('vendor/laragrid/js/flatpickr.min.js') }}"></script>
<script src="{{ asset('vendor/laragrid/js/dayjs.min.js') }}"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/{{ config('laragrid.flatpickr.locale') }}.js"></script>
<script src="{{ asset('vendor/laragrid/js/date-picker.js') }}"></script>
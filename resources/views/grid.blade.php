@php use Illuminate\Contracts\Pagination\LengthAwarePaginator; @endphp
@php use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme; @endphp
@php use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column; @endphp
@php use BoredProgrammers\LaraGrid\Components\ColumnComponents\BaseColumn; @endphp
@php use BoredProgrammers\LaraGrid\Components\ColumnComponents\ColumnGroup; @endphp
@php
    /**
    * @var Column[] $columns
    * @var LengthAwarePaginator $records
    * @var BaseLaraGridTheme $theme
    */
@endphp
<div>
    <table class="{{ $theme->getTableClass() }}">
        @if($this->filter)
            <a class="{{ $theme->getFilterResetButtonClass() }}" wire:click="resetFilters">
                {!! $theme->callFilterResetButtonRenderer() !!}
            </a>
        @endif

        <thead class="{{ $theme->getTheadClass() }}">
        <tr class="{{ $theme->getTrClass() }}">
            @foreach($columns as $column)
                @if($column instanceof BaseColumn)
                    <th
                            wire:key="column-label-{{ $column->getModelField() }}"
                            class="{{ $theme->getThClass() }}"
                    >
                        <x-laragrid::column-label
                                :column="$column"
                                :sort-column="$sortColumn"
                                :sort-direction="$sortDirection"
                        />
                    </th>
                @elseif($column instanceof ColumnGroup)
                    <th
                            wire:key="column-actions-label-{{ uniqid($column->getLabel()) }}"
                            class="{{ $theme->getThClass() }}"
                    >
                        <div>
                            <span>
                                @lang($column->getLabel())
                            </span>
                        </div>
                    </th>
                @endif
            @endforeach
        </tr>
        </thead>
        <tbody class="{{ $theme->getTbodyClass() }}">
        <tr class="{{ $theme->getFilterTrClass() }}">
            @foreach($columns as $column)
                @if($column instanceof Column)
                    <td wire:key="column-filter-{{ $column->getModelField() }}">
                        <x-laragrid::filters.column-filter
                                :theme="$theme"
                                :column="$column"
                                :sort-column="$sortColumn"
                                :sort-direction="$sortDirection"
                        />
                    </td>
                @endif
            @endforeach
        </tr>

        @forelse($records as $record)
            <tr class="{{ $theme->callRecordTrClass($record) }}">
                @foreach($columns as $column)
                    @if($column instanceof BaseColumn)
                        <td class="{{ $theme->getTdClass() }}">
                            <{{ $column->getColumnTag() }} {!! $column->callAttributes($record) !!}>
                            {{ $column->callRenderer($record) }}
                        </{{ $column->getColumnTag() }}>
                        </td>
                    @elseif($column instanceof ColumnGroup)
                        <td class="{{ $theme->getGroupTdClass() }}">
                            @foreach($column->getColumns() as $childColumn)
                                <{{ $childColumn->getColumnTag() }} {!! $childColumn->callAttributes($record) !!}>
                                {{ $childColumn->callRenderer($record) }}
                        </{{ $childColumn->getColumnTag() }}>
                        @endforeach
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

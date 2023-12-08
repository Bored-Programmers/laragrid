@php
    /**
    * @var \BoredProgrammers\LaraGrid\Components\ColumnComponents\Column[] $columns
    * @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme
    */
@endphp
<div>
    <table class="{{ $theme->getTable() }}">
        @if($this->filter)
            <a class="{{ $theme->getResetLink() }}" wire:click="resetFilters">
                @lang('laragrid::translations.filter.reset')
            </a>
        @endif

        <thead class="{{ $theme->getThead() }}">
        <tr class="{{ $theme->getTr() }}">
            @foreach($columns as $column)
                @if($column instanceof \BoredProgrammers\LaraGrid\Components\BaseComponents\BaseColumn)
                    <th
                            wire:key="column-label-{{ $column->getModelField() }}"
                            class="{{ $theme->getTh() }}"
                    >
                        <x-laragrid::column-label
                                :column="$column"
                                :sort-column="$sortColumn"
                                :sort-direction="$sortDirection"
                        />
                    </th>
                @elseif($column instanceof \BoredProgrammers\LaraGrid\Components\ColumnComponents\ColumnGroup)
                    <th
                            wire:key="column-actions-label-{{ uniqid($column->getLabel()) }}"
                            class="{{ $theme->getTh() }}"
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
        <tbody class="{{ $theme->getTbody() }}">
        <tr>
            @foreach($columns as $column)
                @if($column instanceof \BoredProgrammers\LaraGrid\Components\ColumnComponents\Column)
                    <td wire:key="column-filter-{{ $column->getModelField() }}">
                        <x-laragrid::column-filter
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
            <tr class="{{ $theme->getTr() }}">
                @foreach($columns as $column)
                    @if($column instanceof \BoredProgrammers\LaraGrid\Components\BaseComponents\BaseColumn)
                        <td class="{{ $theme->getTd() }}">
                            <{{ $column->getColumnTag() }} {!! $column->getAttributes($record) !!}>
                            {{ $column->callRenderer($record) }}
                        </{{ $column->getColumnTag() }}>
                        </td>
                    @elseif($column instanceof \BoredProgrammers\LaraGrid\Components\ColumnComponents\ColumnGroup)
                        <td class="{{ $theme->getGroupTd() }}">
                            @foreach($column->getColumns() as $childColumn)
                                <{{ $childColumn->getColumnTag() }} {!! $childColumn->getAttributes($record) !!}>
                                {{ $childColumn->callRenderer($record) }}
                        </{{ $childColumn->getColumnTag() }}>
                        @endforeach
                        </td>
                    @endif
                @endforeach
            </tr>
        @empty
            <tr class="{{ $theme->getTr() }}">
                <td colspan="{{ count($columns) }}">
                    <div class="{{ $theme->getEmptyMessage() }}">
                        @lang('laragrid::translations.empty')
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="{{ $theme->getPagination() }}">
        {{ $records->links() }}
    </div>
</div>

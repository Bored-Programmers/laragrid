@php
    /**
    * @var \BoredProgrammers\LaraGrid\Components\Column[] $columns
    * @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme
    */
@endphp
<div>
    <table class="{{ $theme->getTable() }}">
        <a class="{{ $theme->getResetLink() }}" wire:click="resetFilters">
            @lang('laragrid::translations.filter.reset')
        </a>

        <thead class="{{ $theme->getThead() }}">
        <tr class="{{ $theme->getTr() }}">
            @foreach($columns as $column)
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
            @endforeach
        </tr>
        </thead>
        <tbody class="{{ $theme->getTbody() }}">
        <tr>
            @foreach($columns as $column)
                @if($column instanceof \BoredProgrammers\LaraGrid\Components\Column)
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

        @foreach($records as $record)
            <tr class="{{ $theme->getTr() }}">
                @foreach($columns as $column)
                    <td class="{{ $theme->getTd() }}">
                        <a {!! $column->getAttributes($record) !!}>
                            {{ $column->callRenderer($record) }}
                        </a>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="{{ $theme->getPagination() }}">
        {{ $records->links() }}
    </div>
</div>

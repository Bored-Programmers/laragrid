@php
    /**
    * @var \BoredProgrammers\LaraGrid\Components\Column[] $columns
    * @var \BoredProgrammers\LaraGrid\Components\ActionButton[] $actionButtons
    * @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme
    */
@endphp
<div>
    <table class="{{ $theme->getTable() }}">
        <a class="{{ $theme->getResetLink() }}" wire:click="resetFilters">
            @lang('laraGrid.migrationReset')
        </a>

        <thead class="{{ $theme->getThead() }}">
        <tr class="{{ $theme->getTr() }}">
            @foreach($columns as $column)
                @if($column instanceof \BoredProgrammers\LaraGrid\Components\Column)
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
                @endif
            @endforeach
            <th>
                @lang('laraGrid.actions')
            </th>
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
                    @if($column instanceof \BoredProgrammers\LaraGrid\Components\Column)
                        <td class="{{ $theme->getTd() }}">
                            {{ $column->callRenderer($record) }}
                        </td>
                    @endif

                    @if($column instanceof \BoredProgrammers\LaraGrid\Components\ActionButton)
                        <td class="{{ $theme->getTd() }}">
                            <x-laragrid::action-button
                                    :theme="$theme"
                                    :action-button="$column"
                                    :record="$record"
                            />
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="{{ $theme->getPagination() }}">
        {{ $records->links() }}
    </div>
</div>

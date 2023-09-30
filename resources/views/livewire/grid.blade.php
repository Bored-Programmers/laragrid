@php
    /**
    * @var \BoredProgrammers\LaraGrid\Column[] $columns
    * @var \BoredProgrammers\LaraGrid\Theme $theme
 */
    $theme = new $theme(); // fixme - jde to jinak? Nejak mi to blblo a nechtel se objekt passnout z gridu
@endphp
<div>
    <table class="{{ $theme->getTable() }}">
        <a class="{{ $theme->getResetLink() }}" wire:click="resetFilters">
            @lang('laraGrid.migrationReset')
        </a>

        <thead class="{{ $theme->getThead() }}">
        <tr class="{{ $theme->getTr() }}">
            @foreach($columns as $column)
                <th
                        wire:key="column-filter-{{ $column->getModelField() }}"
                        class="{{ $theme->getTh() }}"
                >
                    <x-laragrid::column-filter
                            :theme="$theme"
                            :column="$column"
                            :sort-column="$sortColumn"
                            :sort-direction="$sortDirection"
                    />
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody class="{{ $theme->getTbody() }}">
        @foreach($records as $record)
            <tr class="{{ $theme->getTr() }}">
                @foreach($columns as $column)
                    <td class="{{ $theme->getTd() }}">
                        {{ $column->callRenderer($record) }}
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

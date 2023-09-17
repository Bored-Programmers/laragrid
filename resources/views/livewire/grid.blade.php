@php
    /**
    * @var \App\Livewire\LaraGrid\Column[] $columns
    * @var \App\Livewire\LaraGrid\Themes\Theme $theme
 */
    $theme = new $theme(); // fixme - jde to jinak? Nejak mi to blblo a nechtel se objekt passnout z gridu
@endphp
<div>
    <table class="{{ $theme->getTable() }}">
        <a class="{{ $theme->getLink() }}" wire:click="resetFilters">
            @lang('laragrid.migrationReset')
        </a>

        <thead class="{{ $theme->getThead() }}">
        <tr class="{{ $theme->getTr() }}">
            @foreach($columns as $column)
                <th class="{{ $theme->getTh() }}">
                    <x-laragrid.column-filter
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
                        {{ $column->getRecordValue($record) }}
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

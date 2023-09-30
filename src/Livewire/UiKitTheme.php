<?php

namespace BoredProgrammers\Laragrid\Livewire;

class UiKitTheme extends Theme
{

    public function __construct()
    {
        $this->setTable(
            'table uk-table uk-table-divider uk-table uk-table-responsive
                uk-table uk-table-hover form__table'
        )
            ->setThead('')
            ->setTr('row-group-actions')
            ->setTh('ublaboo-datagrid-th-form-inline')
            ->setTbody('grid-sortable')
            ->setTd('')
            ->setPagination('uk-pagination')
            ->setFilterText('uk-input uk-form-small');
    }

}

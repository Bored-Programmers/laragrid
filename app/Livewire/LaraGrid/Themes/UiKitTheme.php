<?php

namespace App\Livewire\LaraGrid\Themes;

class UiKitTheme extends Theme
{

    public function __construct()
    {
        $this->setTable('uk-table uk-table-divider')
            ->setLink('uk-link')
            ->setThead('')
            ->setTr('')
            ->setTh('uk-table-header')
            ->setTbody('')
            ->setTd('')
            ->setPagination('uk-pagination');
    }

}

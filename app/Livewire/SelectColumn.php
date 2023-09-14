<?php

namespace App\Livewire;

use App\Livewire\BaseColumn;

class SelectColumn extends BaseColumn
{

    public static function make(string $modelField, string $label): self
    {
        $column = new static($modelField, $label);
        $column->setFiltrationType(FiltrationType::EQUAL);
        $column->setFilterType(FilterType::SELECT);

        return $column;
    }

}

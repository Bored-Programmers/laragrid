<?php

namespace App\Livewire;

class DateRangeColumn extends BaseColumn
{

    public static function make(string $modelField, string $label): self
    {
        $column = new static($modelField, $label);
        $column->setFiltrationType(FiltrationType::DATE_BETWEEN);
        $column->setFilterType(FilterType::DATE);

        return $column;
    }

}

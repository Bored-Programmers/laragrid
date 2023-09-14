<?php

namespace App\Livewire;

class TextColumn extends BaseColumn
{

    public static function make(string $modelField, string $label): self
    {
        $column = new static($modelField, $label);
        $column->setFiltrationType(FiltrationType::LIKE);
        $column->setFilterType(FilterType::TEXT);

        return $column;
    }

}

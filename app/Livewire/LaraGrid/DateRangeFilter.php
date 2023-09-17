<?php

namespace App\Livewire\LaraGrid;

use App\Livewire\LaraGrid\Enums\FilterType;
use App\Livewire\LaraGrid\Enums\FiltrationType;

class DateRangeFilter extends BaseFilter
{

    public static function make(): self
    {
        $column = new static();
        $column->setFiltrationType(FiltrationType::DATE_BETWEEN);
        $column->setFilterType(FilterType::DATE);

        return $column;
    }

}

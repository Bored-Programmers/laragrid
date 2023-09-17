<?php

namespace App\Livewire\Filters;

use App\Livewire\Column;
use App\Livewire\Enums\FilterType;
use App\Livewire\Enums\FiltrationType;

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

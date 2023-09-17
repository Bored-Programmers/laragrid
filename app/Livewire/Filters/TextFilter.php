<?php

namespace App\Livewire\Filters;

use App\Livewire\Column;
use App\Livewire\Enums\FilterType;
use App\Livewire\Enums\FiltrationType;

class TextFilter extends BaseFilter
{

    public static function make(): self
    {
        $filter = new static();
        $filter->setFiltrationType(FiltrationType::LIKE);
        $filter->setFilterType(FilterType::TEXT);

        return $filter;
    }

}

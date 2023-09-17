<?php

namespace App\Livewire\LaraGrid\Filters;

use App\Livewire\LaraGrid\Enums\FilterType;
use App\Livewire\LaraGrid\Enums\FiltrationType;

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

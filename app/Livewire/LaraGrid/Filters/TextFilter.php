<?php

namespace App\Livewire\LaraGrid\Filters;

use App\Livewire\LaraGrid\Enums\FilterType;
use App\Livewire\LaraGrid\Enums\FiltrationType;

class TextFilter extends BaseFilter
{

    public static function make(): self
    {
        $column = new static();
        $column->setFiltrationType(FiltrationType::LIKE);
        $column->setFilterType(FilterType::TEXT);

        return $column;
    }

}

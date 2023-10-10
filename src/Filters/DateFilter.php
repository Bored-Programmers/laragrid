<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;

class DateFilter extends BaseFilter
{

    public static function make(): self
    {
        $column = new static();
        $column->setFiltrationType(FiltrationType::DATE_BETWEEN);
        $column->setFilterType(FilterType::DATE);

        return $column;
    }

}

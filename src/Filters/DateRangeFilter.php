<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;

class DateRangeFilter extends BaseFilter
{

    public static function make($isOneInput = false): self
    {
        $column = new static();
        $column->setFiltrationType(FiltrationType::DATE_BETWEEN);
        $column->setFilterType(FilterType::DATE);

        return $column;
    }

}

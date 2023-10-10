<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;

class DateRangeFilter extends BaseFilter
{

    public static function make($isOneInput = false): self
    {
        $filter = new static();
        $filter->setFiltrationType(FiltrationType::DATE_BETWEEN);
        $filter->setFilterType(FilterType::DATE_RANGE);

        return $filter;
    }

}

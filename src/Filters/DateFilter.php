<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;

class DateFilter extends BaseFilter
{

    public static function make(): static
    {
        $filter = new static();
        $filter->setFiltrationType(FiltrationType::DATE_BETWEEN);
        $filter->setFilterType(FilterType::DATE);

        return $filter;
    }

}

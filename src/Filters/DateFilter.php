<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;

class DateFilter extends BaseFilter
{

    public static function make(): self
    {
        $filter = new static();
        $filter->setFiltrationType(FiltrationType::DATE_BETWEEN);
        $filter->setFilterType(FilterType::DATE);

        return $filter;
    }

}

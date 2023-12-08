<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;

class TextFilter extends BaseFilter
{

    public static function make(): static
    {
        $filter = new static();
        $filter->setFiltrationType(FiltrationType::LIKE);
        $filter->setFilterType(FilterType::TEXT);

        return $filter;
    }

}

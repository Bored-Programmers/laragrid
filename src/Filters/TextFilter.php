<?php

namespace LaraGrid\Filters;

use LaraGrid\Enums\FilterType;
use LaraGrid\Enums\FiltrationType;

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

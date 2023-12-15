<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Traits\HasOptions;
use BoredProgrammers\LaraGrid\Traits\HasPrompt;
use Illuminate\Support\Collection;

class SelectFilter extends BaseFilter
{

    use HasPrompt, HasOptions;

    public static function make(): static
    {
        $filter = new static();
        $filter->setFiltrationType(FiltrationType::EQUAL);
        $filter->setFilterType(FilterType::SELECT);

        return $filter;
    }

}

<?php

namespace BoredProgrammers\LaraGrid\Traits;

use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;

trait HasFilterType
{

    private FilterType $filterType;

    public function getFilterType(): FilterType
    {
        return $this->filterType;
    }

    public function setFilterType(FilterType $filterType): static
    {
        $this->filterType = $filterType;

        return $this;
    }

}
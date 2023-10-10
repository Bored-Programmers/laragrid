<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;

class DateRangeFilter extends BaseFilter
{

    protected bool $isOneInput = false;

    public static function make($isOneInput = false): self
    {
        $filter = new static();
        $filter->setFiltrationType(FiltrationType::DATE_BETWEEN);
        $filter->setFilterType(FilterType::DATE_RANGE);
        $filter->setIsOneInput($isOneInput);

        return $filter;
    }

    public function isOneInput(): bool
    {
        return $this->isOneInput;
    }

    public function setIsOneInput(bool $isOneInput): DateRangeFilter
    {
        $this->isOneInput = $isOneInput;

        return $this;
    }

}

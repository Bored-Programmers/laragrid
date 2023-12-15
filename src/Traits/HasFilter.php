<?php

namespace BoredProgrammers\LaraGrid\Traits;

use BoredProgrammers\LaraGrid\Filters\BaseFilter;

trait HasFilter
{

    private ?BaseFilter $filter = null;

    public function getFilter(): ?BaseFilter
    {
        return $this->filter;
    }

    public function setFilter(BaseFilter $filter): static
    {
        $this->filter = $filter;

        return $this;
    }

}
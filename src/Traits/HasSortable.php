<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasSortable
{

    private bool $sortable = true;

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function setSortable($isSortable = true): static
    {
        $this->sortable = $isSortable;

        return $this;
    }

}
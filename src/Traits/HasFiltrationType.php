<?php

namespace BoredProgrammers\LaraGrid\Traits;

use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;

trait HasFiltrationType
{

    private FiltrationType $filtrationType;

    public function getFiltrationType(): FiltrationType
    {
        return $this->filtrationType;
    }

    public function setFiltrationType(FiltrationType $filtrationType): static
    {
        $this->filtrationType = $filtrationType;

        return $this;
    }

}
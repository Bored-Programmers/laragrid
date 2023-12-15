<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasDateFormatter
{

    private string $dateFormat = 'Y-m-d H:i';

    public function getDateFormat(): string
    {
        return $this->dateFormat;
    }

    public function setDateFormat(string $dateFormat): static
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

}
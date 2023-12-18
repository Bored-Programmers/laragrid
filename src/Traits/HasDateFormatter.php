<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasDateFormatter
{

    private string $dateFormat = 'Y-m-d H:i';

    public function bootHasDateFormatter(): void
    {
        $this->dateFormat = config('laragrid.flatpickr.date_format', $this->dateFormat);
    }

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
<?php

namespace BoredProgrammers\LaraGrid\Traits;

use BoredProgrammers\LaraGrid\Filters\SelectFilterOption;

trait HasOptions
{

    /** @var SelectFilterOption[] */
    protected array $options = [];

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array|Collection $options): static
    {
        $selectOptions = [];

        foreach ($options as $value => $label) {
            $selectOptions[] = SelectFilterOption::make($value, $label);
        }

        $this->options = $selectOptions;

        return $this;
    }

}
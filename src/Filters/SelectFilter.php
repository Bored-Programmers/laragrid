<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;
use Illuminate\Support\Collection;

class SelectFilter extends BaseFilter
{

    /** @var SelectFilterOption[] */
    protected array $options;

    protected string $prompt;

    public static function make(): self
    {
        $filter = new static();
        $filter->setFiltrationType(FiltrationType::EQUAL);
        $filter->setFilterType(FilterType::SELECT);
        $filter->setPrompt('laraGrid.choose');

        return $filter;
    }

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

    public function getPrompt(): string
    {
        return $this->prompt;
    }

    public function setPrompt(string $prompt): SelectFilter
    {
        $this->prompt = $prompt;

        return $this;
    }

}

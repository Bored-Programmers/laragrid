<?php

namespace App\Livewire\Filters;

use App\Livewire\Column;
use App\Livewire\Enums\FilterType;
use App\Livewire\Enums\FiltrationType;
use Illuminate\Support\Collection;

class SelectFilter extends BaseFilter
{

    /** @var SelectFilterOption[] */
    protected array $options;

    protected string $prompt;

    public static function make(): self
    {
        $column = new static();
        $column->setFiltrationType(FiltrationType::EQUAL);
        $column->setFilterType(FilterType::SELECT);

        return $column;
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

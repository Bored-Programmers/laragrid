<?php

namespace App\Livewire\LaraGrid;

use App\Livewire\LaraGrid\Enums\FilterType;
use App\Livewire\LaraGrid\Enums\FiltrationType;
use Illuminate\Support\Collection;

class SelectFilter extends BaseFilter
{

    /** @var SelectFilterOption[] */
    protected array $options;

    protected string $prompt;

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

    public static function make(): self
    {
        $column = new static();
        $column->setFiltrationType(FiltrationType::EQUAL);
        $column->setFilterType(FilterType::SELECT);

        return $column;
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

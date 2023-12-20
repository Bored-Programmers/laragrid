<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Traits\HasBootableTrait;
use BoredProgrammers\LaraGrid\Traits\HasBuilder;
use BoredProgrammers\LaraGrid\Traits\HasFilterType;
use BoredProgrammers\LaraGrid\Traits\HasFiltrationType;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

abstract class BaseFilter
{

    use HasBuilder, HasFilterType, HasFiltrationType, HasBootableTrait;

    public function __construct()
    {
        $this->bootTraits();
    }

    public function defaultBuilder(
        \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|Collection $query,
        string $field,
        mixed $value
    ): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|Collection
    {
        if ($query instanceof \Illuminate\Database\Eloquent\Builder || $query instanceof Builder) {
            match ($this->getFiltrationType()) {
                FiltrationType::LIKE => $query->whereLike($field, $value),
                FiltrationType::EQUAL => $query->whereEqual($field, $value),
                FiltrationType::DATE_BETWEEN => $query->whereDateBetween(
                    $field,
                    $value['from'] ?? null,
                    $value['to'] ?? null
                ),
            };
        } else {
            $query = match ($this->getFiltrationType()) {
                FiltrationType::LIKE => $query->filter(function ($item) use ($field, $value) {
                    return str_contains($item[$field], $value);
                }),
                FiltrationType::EQUAL => $query->filter(function ($item) use ($field, $value) {
                    return $item[$field] === $value;
                }),
                FiltrationType::DATE_BETWEEN => $query->filter(function ($item) use ($field, $value) {
                    return $item[$field] >= Carbon::parse($value['from'])
                        && $item[$field] <= Carbon::parse($value['to']);
                }),
            };
        }

        return $query;
    }

}

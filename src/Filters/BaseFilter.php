<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Traits\HasBuilder;
use BoredProgrammers\LaraGrid\Traits\HasFilterType;
use BoredProgrammers\LaraGrid\Traits\HasFiltrationType;
use Illuminate\Database\Query\Builder;

abstract class BaseFilter
{

    use HasBuilder, HasFilterType, HasFiltrationType;

    public function defaultBuilder(
        \Illuminate\Database\Eloquent\Builder|Builder $query,
        string $field,
        mixed $value
    ): \Illuminate\Database\Eloquent\Builder|Builder
    {
        match ($this->getFiltrationType()) {
            FiltrationType::LIKE => $query->whereLike($field, $value),
            FiltrationType::EQUAL => $query->whereEqual($field, $value),
            FiltrationType::DATE_BETWEEN => $query->whereDateBetween(
                $field,
                $value['from'] ?? null,
                $value['to'] ?? null
            ),
        };

        return $query;
    }

}

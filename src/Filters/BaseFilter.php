<?php

namespace LaraGrid\Filters;

use LaraGrid\Enums\FilterType;
use LaraGrid\Enums\FiltrationType;
use Closure;
use Illuminate\Database\Query\Builder;

abstract class BaseFilter
{

    protected FilterType $filterType;

    protected FiltrationType $filtrationType;

    protected Closure $builder;

    public function __construct()
    {
        $this->setBuilder(function (\Illuminate\Database\Eloquent\Builder|Builder $query, $field, $value) {
            match ($this->getFiltrationType()) {
                FiltrationType::LIKE => $query->whereLike($field, $value),
                FiltrationType::EQUAL => $query->whereEqual($field, $value),
                FiltrationType::DATE_BETWEEN => $query->whereDateBetween(
                    $field,
                    $value['from'] ?? null,
                    $value['to'] ?? null
                ),
            };
        });
    }

    /*********************************************** GETTERS && SETTERS ***********************************************/

    public function callBuilder(Builder|\Illuminate\Database\Eloquent\Builder $query, $field, $value)
    {
        return ($this->builder)($query, $field, $value);
    }

    public function setBuilder(Closure $builder): BaseFilter
    {
        $this->builder = $builder;

        return $this;
    }

    public function getFilterType(): FilterType
    {
        return $this->filterType;
    }

    public function setFilterType(FilterType $filterType): void
    {
        $this->filterType = $filterType;
    }

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

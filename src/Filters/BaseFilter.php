<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;
use Closure;
use Illuminate\Database\Query\Builder;

abstract class BaseFilter
{

    protected FilterType $filterType;

    protected FiltrationType $filtrationType;

    /** @var callable */
    protected $builder;

    public function __construct()
    {
        $this->setBuilder([$this, 'defaultBuilder']);
    }

    /*********************************************** GETTERS && SETTERS ***********************************************/

    public function callBuilder(Builder|\Illuminate\Database\Eloquent\Builder $query, string $field, $value)
    {
        return call_user_func_array($this->getBuilder(), [$query, $field, $value]);
    }

    public function getBuilder(): callable
    {
        return $this->builder;
    }

    public function setBuilder(callable $builder): static
    {
        $this->builder = $builder;

        return $this;
    }

    public function getFilterType(): FilterType
    {
        return $this->filterType;
    }

    public function setFilterType(FilterType $filterType): static
    {
        $this->filterType = $filterType;

        return $this;
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

    /************************************************ PRIVATE ************************************************/

    protected function defaultBuilder(
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

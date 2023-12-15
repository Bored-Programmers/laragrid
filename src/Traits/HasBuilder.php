<?php

namespace BoredProgrammers\LaraGrid\Traits;

use Illuminate\Database\Query\Builder;

trait HasBuilder
{

    /** @var callable */
    private $builder;

    public abstract function defaultBuilder(
        \Illuminate\Database\Eloquent\Builder|Builder $query,
        string $field,
        mixed $value
    ): \Illuminate\Database\Eloquent\Builder|Builder;

    public function bootHasBuilder()
    {
        $this->setBuilder([$this, 'defaultBuilder']);
    }

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

}
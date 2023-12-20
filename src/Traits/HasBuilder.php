<?php

namespace BoredProgrammers\LaraGrid\Traits;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

trait HasBuilder
{

    /** @var callable */
    private $builder;

    public abstract function defaultBuilder(
        \Illuminate\Database\Eloquent\Builder|Builder|Collection $query,
        string $field,
        mixed $value
    ): \Illuminate\Database\Eloquent\Builder|Builder|Collection;

    public function bootHasBuilder()
    {
        $this->setBuilder([$this, 'defaultBuilder']);
    }

    public function callBuilder(...$args)
    {
        return call_user_func_array($this->getBuilder(), $args);
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
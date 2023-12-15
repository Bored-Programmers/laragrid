<?php

namespace BoredProgrammers\LaraGrid\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasAttributes
{

    /** @var callable */
    private $attributes;

    public abstract function defaultAttributes(Model $model): array;

    public function bootHasAttributes()
    {
        $this->setAttributes([$this, 'defaultAttributes']);
    }

    public function callAttributes(Model $model)
    {
        return collect(call_user_func_array($this->getAttributes(), [$model]))
            ->map(function ($value, $key) {
                return Str::of($key)->append('="', $value, '"');
            })
            ->join(' ');
    }

    public function getAttributes(): callable
    {
        return $this->attributes;
    }

    public function setAttributes(callable|string $attributes): static
    {
        if (is_string($attributes)) {
            $attributes = fn() => $attributes;
        }

        $this->attributes = $attributes;

        return $this;
    }

}
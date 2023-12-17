<?php

namespace BoredProgrammers\LaraGrid\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasAttributes
{

    /** @var callable */
    private $attributes;

    public function bootHasAttributes()
    {
        $this->setAttributes([$this, 'defaultAttributes']);
    }

    public function callAttributes(...$args)
    {
        return collect(call_user_func_array($this->getAttributes(), $args))
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
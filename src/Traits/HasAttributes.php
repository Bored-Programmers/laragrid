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

    public function setAttributes(callable|array $attributes): static
    {
        if (is_array($attributes)) {
            // This is a workaround if you want to pass an array of attributes to the component.
            if (isset($attributes[0]) && is_object($attributes[0]) && method_exists($attributes[0], $attributes[1])) {
                $this->attributes = $attributes;

                return $this;
            } else {
                $attributes = fn() => $attributes;
            }
        }

        $this->attributes = $attributes;

        return $this;
    }

}
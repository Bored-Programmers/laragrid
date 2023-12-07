<?php

namespace BoredProgrammers\LaraGrid\Components;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ActionButton extends BaseColumn
{

    public static function make(string $label): self
    {
        return new static(null, $label);
    }

    public function defaultRender(Model $model): string
    {
        return __($this->getLabel());
    }

}

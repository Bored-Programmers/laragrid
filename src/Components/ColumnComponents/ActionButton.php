<?php

namespace BoredProgrammers\LaraGrid\Components\ColumnComponents;

use BoredProgrammers\LaraGrid\Components\BaseComponents\BaseColumn;
use Illuminate\Database\Eloquent\Model;

class ActionButton extends BaseColumn
{

    public static function make(string $label): self
    {
        return new static(null, $label);
    }

    public function defaultRender(Model $model): string
    {
        return function (Model $model) {
            return __($this->getLabel());
        };
    }

}

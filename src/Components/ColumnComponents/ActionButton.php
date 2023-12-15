<?php

namespace BoredProgrammers\LaraGrid\Components\ColumnComponents;

use Illuminate\Database\Eloquent\Model;

class ActionButton extends BaseColumn
{

    public static function make(string $label): self
    {
        return new static($label);
    }

    public function defaultRender(Model $model): string
    {
        return __($this->getLabel());
    }

    public function defaultAttributes(Model $model): array
    {
        return [];
    }

}

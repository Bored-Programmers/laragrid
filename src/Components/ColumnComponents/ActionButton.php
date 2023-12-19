<?php

namespace BoredProgrammers\LaraGrid\Components\ColumnComponents;

use Illuminate\Database\Eloquent\Model;

class ActionButton extends BaseColumn
{

    public static function make(string $label): static
    {
        $button = new static($label);
        $button->setColumnTag('button');

        return $button;
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

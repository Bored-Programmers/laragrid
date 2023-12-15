<?php

namespace BoredProgrammers\LaraGrid\Components\ColumnComponents;

use BoredProgrammers\LaraGrid\BaseLaraGridClass;
use BoredProgrammers\LaraGrid\Traits\HasColumns;
use BoredProgrammers\LaraGrid\Traits\HasLabel;

class ColumnGroup extends BaseLaraGridClass
{

    use HasLabel, HasColumns;

    public function __construct(string $label)
    {
        $this->setLabel($label);
    }

    public static function make(string $label): static
    {
        return new static($label);
    }

}
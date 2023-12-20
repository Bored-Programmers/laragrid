<?php

namespace BoredProgrammers\LaraGrid\Components;

use BoredProgrammers\LaraGrid\Traits\HasBootableTrait;
use BoredProgrammers\LaraGrid\Traits\HasFooter;
use BoredProgrammers\LaraGrid\Traits\HasHeader;

class Layout
{

    use HasHeader, HasFooter;

    public function __construct()
    {
    }

    public static function make(): static
    {
        return new static();
    }

}
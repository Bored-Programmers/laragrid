<?php

namespace BoredProgrammers\LaraGrid\Components;

use BoredProgrammers\LaraGrid\Traits\HasBootableTrait;
use BoredProgrammers\LaraGrid\Traits\HasFooterRenderer;
use BoredProgrammers\LaraGrid\Traits\HasHeaderRenderer;

class Layout
{

    use HasHeaderRenderer, HasFooterRenderer;

    public function __construct()
    {
        $this->setHeaderRenderer(fn() => '');
        $this->setFooterRenderer(fn() => '');
    }

    public static function make(): static
    {
        return new static();
    }

}
<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Traits\HasAttributes;
use BoredProgrammers\LaraGrid\Traits\HasBootableTrait;
use BoredProgrammers\LaraGrid\Traits\HasColumnTag;
use BoredProgrammers\LaraGrid\Traits\HasRenderer;
use Illuminate\Database\Eloquent\Model;

class FilterResetButton
{

    use HasBootableTrait, HasRenderer, HasAttributes, HasColumnTag;

    public function __construct()
    {
        $this->bootTraits();
    }

    public static function make(): static
    {
        return new static();
    }

    public function defaultRender()
    {
        return __('laragrid::translations.filter.reset');
    }

    public function defaultAttributes(): array
    {
        return [];
    }

}

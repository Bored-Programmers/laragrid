<?php

namespace BoredProgrammers\LaraGrid\Filters;

class BooleanFilter extends SelectFilter
{

    public static function make(): static
    {
        $filter = parent::make();
        $filter->setOptions([
            1 => __('laraGrid.yes'),
            0 => __('laraGrid.no'),
        ]);

        return $filter;
    }

}

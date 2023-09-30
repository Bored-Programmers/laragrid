<?php

namespace BoredProgrammers\LaraGrid\Filters;

class BooleanFilter extends SelectFilter
{

    public static function make(): SelectFilter
    {
        $column = SelectFilter::make();
        $column->setOptions([
            1 => __('laraGrid.yes'),
            0 => __('laraGrid.no'),
        ]);

        return $column;
    }

}

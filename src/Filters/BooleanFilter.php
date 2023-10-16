<?php

namespace BoredProgrammers\LaraGrid\Filters;

class BooleanFilter extends SelectFilter
{

    public static function make(): static
    {
        $filter = parent::make();
        $filter->setOptions([
            1 => __('laragrid::translations.filter.options.yes'),
            0 => __('laragrid::translations.filter.options.no'),
        ]);

        return $filter;
    }

}

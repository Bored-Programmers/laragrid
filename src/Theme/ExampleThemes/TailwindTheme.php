<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraGrid\Theme\ExampleThemes;

use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use BoredProgrammers\LaraGrid\Theme\FilterTheme;
use BoredProgrammers\LaraGrid\Theme\TBodyTheme;
use BoredProgrammers\LaraGrid\Theme\THeadTheme;

class TailwindTheme extends BaseLaraGridTheme
{

    public static function make(): static
    {
        $theme = new static();

        $theme->setTableClass('min-w-full table-auto')
            ->setPaginationClass('mt-6')
            ->setPerPageClass('border border-gray-300 rounded-xl text-gray-500 text-sm mt-2');

        $theme->setTheadTheme(
            THeadTheme::make()
                ->setTheadClass('pb-4')
                ->setTrClass('')
                ->setThClass(
                    'pb-3 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider
                    whitespace-nowrap'
                )
        );

        $theme->setTbodyTheme(
            TBodyTheme::make()
                ->setEmptyMessageClass('text-white')
                ->setRecordTrClass('bg-white odd:bg-gray-100')
                ->setTrClass('')
                ->setTdClass('whitespace-nowrap p-3 text-sm text-gray-500')
                ->setGroupTdClass('whitespace-nowrap flex space-x-2 items-center p-3 text-sm text-gray-500')
        );

        $theme->setFilterTheme(
            FilterTheme::make()
                ->setFilterTextClass('bg-white w-full rounded-xl border border-gray-300')
                ->setFilterSelectClass('bg-white w-full rounded-xl border border-gray-300')
                ->setFilterDateClass('bg-white w-full rounded-xl border border-gray-300')
        );

        return $theme;
    }

}

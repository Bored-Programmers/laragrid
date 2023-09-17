<?php

namespace App\Livewire;

use App\Livewire\LaraGrid\BaseGrid;
use App\Livewire\LaraGrid\Column;
use App\Livewire\LaraGrid\Filters\SelectFilter;
use App\Livewire\LaraGrid\Themes\UiKitTheme;
use App\Models\User;

class AdminGrid extends BaseGrid
{

    public string $model = User::class;
    public string $theme = UiKitTheme::class;

    protected function getColumns(): array
    {
        return [
            Column::make('name', 'name')
                ->setSortable(),

            Column::make('email', 'email')
                ->setSortable()
                ->setFilter(
                    SelectFilter::make()
                        ->setOptions(User::pluck('email', 'email'))
                        ->setPrompt('choose')
                ),

            Column::make('created_at', 'created_at')
                ->setSortable(),

            Column::make('is_active', 'is_active')
                ->setSortable()
                ->setFilter(
                    SelectFilter::make()
                        ->setPrompt('choose')
                        ->setOptions([
                            '1' => 'active',
                            '0' => 'inactive',
                        ])
                ),
        ];
    }

}

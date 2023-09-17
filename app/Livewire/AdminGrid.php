<?php

namespace App\Livewire;

use App\Livewire\Filters\SelectFilter;
use App\Models\User;

class AdminGrid extends BaseGrid
{

    public string $model = User::class;

    protected function getColumns(): array
    {
        return [
            Column::make('name', 'name')
                ->setSortable(),

            Column::make('email', 'email')
                ->setFilter(
                    SelectFilter::make()
                        ->setOptions(User::pluck('email', 'email'))
                        ->setPrompt('choose')
                )
                ->setSortable(),

            Column::make('created_at', 'created_at')
                ->setSortable(),

            Column::make('is_active', 'is_active')
                ->setFilter(
                    SelectFilter::make()
                        ->setOptions([
                            '1' => 'active',
                            '0' => 'inactive',
                        ])
                        ->setPrompt('choose')
                )
                ->setSortable(),
        ];
    }

}

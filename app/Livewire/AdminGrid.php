<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\WithPagination;

class AdminGrid extends BaseGrid
{

    public string $model = User::class;

    protected function getColumns(): array
    {
        return [
            TextColumn::make('name', 'name')
                ->setSortable(),

            SelectColumn::make('email', 'email')
                ->setSortable()
                ->setOptions(User::pluck('email', 'email'))
                ->setPrompt('choose'),

            DateRangeColumn::make('created_at', 'created_at')
                ->setSortable(),

            SelectColumn::make('is_active', 'is_active')
                ->setSortable()
                ->setOptions([
                    '1' => 'active',
                    '0' => 'inactive',
                ])
                ->setPrompt('choose'),
        ];
    }

}

<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminGrid extends Component
{

    use WithPagination;

    public function render()
    {
        $users = User::query();

        return view('livewire.admin-grid', [
            'users' => $users->paginate(10),
        ]);
    }

}

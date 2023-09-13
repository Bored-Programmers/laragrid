<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminGrid extends Component
{

    use WithPagination;

    public $search = '';

    public $sortField = '';

    public $sortDirection = 'asc';

    public $columns = [
        ['name' => 'name', 'label' => 'Name', 'sortable' => true],
        ['name' => 'posts.count', 'label' => 'Posts Count', 'sortable' => true],
    ];

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ? ($this->sortDirection === 'asc' ? 'desc' : 'asc') : 'asc';
        $this->sortField = $field;
    }

    public function render()
    {
        $users = User::query();

        if ($this->search) {
            $users = $users->where('name', 'like', '%' . $this->search . '%'); // Adjust for other fields
        }

        if ($this->sortField) {
            $users = $users->orderBy($this->sortField, $this->sortDirection);
        }

        return view('livewire.admin-grid', [
            'users' => $users->paginate(10),
        ]);
    }

}

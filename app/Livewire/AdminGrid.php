<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AdminGrid extends Component
{

    use WithPagination;

    public string $model = User::class;

    #[Url(history: true)]
    public array $filter = [];

    public array $columns = [
        'name' => [
            'type' => 'text',
            'filtrationType' => 'like',
        ],
        'email' => [
            'type' => 'select',
            'filtrationType' => 'equal',
        ],
        'created_at' => [
            'type' => 'date',
            'filtrationType' => 'dateBetween',
        ],
        'is_active' => [
            'type' => 'boolean',
            'filtrationType' => 'equal',
        ],
    ];

    protected array $filtrationTypes = [
        'like',
        'equal',
        'dateBetween',
    ];

    /**
     * @throws \Exception
     */
    public function render()
    {
        /** @var Builder $users */
        $users = $this->model::query();

        foreach ($this->columns as $columnName => $columnProperties) {
            if (!in_array($columnProperties['filtrationType'], $this->filtrationTypes)) {
                throw new \Exception('Filtration type "' . $columnProperties['filtrationType'] . '" does not exist.');
            }
        }

        foreach ($this->columns as $columnName => $columnProperties) {
            if (array_key_exists($columnName, $this->filter)) {
                match ($columnProperties['filtrationType']) {
                    'like' => $users->whereLike($columnName, $this->filter[$columnName]),
                    'equal' => $users->whereEqual($columnName, $this->filter[$columnName]),
                    'dateBetween' => $users->whereDateBetween($columnName, $this->filter[$columnName][0], $this->filter[$columnName][1]),
                };
            }
        }

        return view('livewire.admin-grid', [
            'users' => $users->paginate(3),
        ]);
    }

}

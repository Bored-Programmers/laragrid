<?php

namespace App\Livewire;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseGrid extends Component
{

    use WithPagination;

    #[Url]
    public array $filter = [];

    public string $sortColumn = 'id';

    public string $sortDirection = 'desc';

    public int $perPage = 25;

    protected string $model;

    protected abstract function getColumns();

    public function resetFilters(): void
    {
        $this->reset();
    }

    public function sort($column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * @throws Exception
     */
    public function render(): View
    {
        /**
         * @var BaseColumn[] $columns
         * @var Builder      $query
         */
        $columns = $this->getColumns();
        $query = $this->model::query();

        foreach ($columns as $column) {
            if (!in_array($column->getFiltrationType(), FiltrationType::cases())) {
                throw new Exception(
                    'Filtration type "'
                    . $column['filtrationType']
                    . ' for column "'
                    . $column->getModelField()
                    . '" does not exist.'
                );
            }
        }

        foreach ($columns as $column) {
            if (array_key_exists($column->getModelField(), $this->filter)) {
                match ($column->getFiltrationType()) {
                    FiltrationType::LIKE => $query->whereLike(
                        $column->getModelField(),
                        $this->filter[$column->getModelField()]
                    ),
                    FiltrationType::EQUAL => $query->whereEqual(
                        $column->getModelField(),
                        $this->filter[$column->getModelField()]
                    ),
                    FiltrationType::DATE_BETWEEN => $query->whereDateBetween(
                        $column->getModelField(),
                        $this->filter[$column->getModelField()]['from'] ?? null,
                        $this->filter[$column->getModelField()]['to'] ?? null
                    ),
                };
            }
        }

        $query->orderBy($this->sortColumn, $this->sortDirection);

        return view('livewire.grid', [
            'records' => $query->paginate($this->perPage),
            'columns' => $columns,
        ]);
    }

}

<?php

namespace BoredProgrammers\LaraGrid\Livewire;

use BoredProgrammers\LaraGrid\Components\Column;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseGrid extends Component
{

    use WithPagination;

    #[Url]
    public array $filter = [];

    #[Url(keep: true)]
    public string $sortColumn = 'id';

    #[Url(keep: true)]
    public string $sortDirection = 'desc';

    public int $perPage = 25;

    public string $theme;

    protected abstract function getColumns();

    protected abstract function getDataSource();

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
        if (!$this->theme) {
            throw new Exception('Theme is not set!');
        }

        /**
         * @var Column[] $columns
         * @var Builder  $query
         */
        $columns = $this->getColumns();
        $query = $this->getDataSource();

        foreach ($columns as $column) {
            $filter = $column->getFilter();

            if ($filter && !in_array($filter->getFiltrationType(), FiltrationType::cases())) {
                throw new Exception(
                    'Filtration type "'
                    . $filter->getFiltrationType()->name
                    . ' for column "'
                    . $column->getModelField()
                    . '" does not exist.'
                );
            }
        }

        foreach ($columns as $column) {
            $activeFilters = Arr::dot($this->filter);

            if (array_key_exists($column->getModelField(), $activeFilters)) {
                $searchedTerm = $activeFilters[$column->getModelField()];

                if ($searchedTerm === null || $searchedTerm === '' || $searchedTerm === 'null') {
                    unset($this->filter[$column->getModelField()]);

                    continue;
                }

                $column->getFilter()->callBuilder(
                    $query,
                    $column->getModelField(),
                    $searchedTerm
                );
            }
        }

        if (str_contains($this->sortColumn, '.')) {
            $query->orderByLeftPowerJoins(
                $this->sortColumn,
                $this->sortDirection
            );
        } else {
            $query->orderBy(
                $this->sortColumn,
                $this->sortDirection
            );
        }

        return view('laragrid::grid', [
            'records' => $query->paginate($this->perPage),
            'columns' => $columns,
            'theme' => $this->theme,
        ]);
    }

}

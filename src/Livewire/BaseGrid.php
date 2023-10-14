<?php

namespace BoredProgrammers\LaraGrid\Livewire;

use BoredProgrammers\LaraGrid\Components\ActionButton;
use BoredProgrammers\LaraGrid\Components\BaseComponent;
use BoredProgrammers\LaraGrid\Components\Column;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Theme\BaseTheme;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
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

    public string $theme = BaseTheme::class;

    /** @return BaseComponent[] */
    protected abstract function getRowColumns(): array;

    protected abstract function getDataSource(): Builder;

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

        if (!class_exists($this->theme)) {
            throw new Exception('Theme class "' . $this->theme . '" does not exist!');
        }

        $query = $this->getDataSource();
        $columns = $this->getColumns();

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
            $query->orderByLeftPowerJoins($this->sortColumn, $this->sortDirection);
        } else {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        return view('laragrid::grid', [
            'records' => $query->paginate($this->perPage),
            'columns' => $columns,
            'actionButtons' => $this->getActionButtons(),
            'theme' => new $this->theme,
        ]);
    }

    /************************************************ PRIVATE ************************************************/

    /** @return Column[] */
    private function getColumns(): array
    {
        $rowColumns = $this->getRowColumns();
        $columns = [];

        foreach ($rowColumns as $column) {
            if ($column instanceof Column) {
                $columns[] = $column;
            }
        }

        return $columns;
    }

    /** @return ActionButton[] */
    private function getActionButtons(): array
    {
        $rowColumns = $this->getRowColumns();
        $actionButtons = [];

        foreach ($rowColumns as $column) {
            if ($column instanceof ActionButton) {
                $actionButtons[] = $column;
            }
        }

        return $actionButtons;
    }

}

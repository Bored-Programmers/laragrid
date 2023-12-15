<?php

namespace BoredProgrammers\LaraGrid\Livewire;

use BoredProgrammers\LaraGrid\Components\BaseComponents\BaseLaraGridComponent;
use BoredProgrammers\LaraGrid\Components\ColumnComponents\BaseColumn;
use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column;
use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseLaraGrid extends Component
{

    use WithPagination;

    #[Url]
    public array $filter = [];

    #[Url]
    public string $sortColumn = 'id';

    #[Url]
    public string $sortDirection = 'desc';

    public int $perPage = 25;

    /** @return BaseColumn[] */
    protected abstract function getColumns(): array;

    protected abstract function getDataSource(): Builder;

    protected abstract function getTheme(): BaseLaraGridTheme;

    public function resetFilters(): void
    {
        $this->dispatch('LGdatePickerClear');
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
        if (!($this->getTheme() instanceof BaseLaraGridTheme)) {
            throw new Exception(
                'Theme class "' . $this->getTheme() . '" is not instance of "' . BaseLaraGridTheme::class . '"!'
            );
        }

        $query = $this->getDataSource();
        $columns = $this->getColumns();

        $this->applyFilters($columns, $query);
        $this->applySorting($query);

        return view('laragrid::grid', [
            'records' => $query->paginate($this->perPage),
            'columns' => $columns,
            'theme' => $this->getTheme(),
        ]);
    }

    /************************************************ PRIVATE ************************************************/

    private function applySorting(Builder $query): void
    {
        if (str_contains($this->sortColumn, '.')) {
            $query->orderByLeftPowerJoins($this->sortColumn, $this->sortDirection);
        } else {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }
    }

    private function applyFilters(array $columns, Builder $query): void
    {
        foreach ($columns as $column) {
            if ($column instanceof Column) {
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

                if (array_key_exists($column->getModelField(), $this->filter)) {
                    if ($column->getFilter()->getFilterType() === FilterType::DATE) {
                        $searchedTerm = [
                            'from' => $activeFilters[$column->getModelField() . '.from'] ?? null,
                            'to' => $activeFilters[$column->getModelField() . '.to'] ?? null,
                        ];
                    } else {
                        $searchedTerm = $activeFilters[$column->getModelField()];
                    }

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
        }
    }

}

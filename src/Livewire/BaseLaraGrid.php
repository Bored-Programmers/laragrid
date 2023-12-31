<?php

namespace BoredProgrammers\LaraGrid\Livewire;

use BoredProgrammers\LaraGrid\Components\BaseComponents\BaseLaraGridComponent;
use BoredProgrammers\LaraGrid\Components\ColumnComponents\BaseColumn;
use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column;
use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Filters\FilterResetButton;
use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use BoredProgrammers\LaraGrid\Theme\ExampleThemes\TailwindTheme;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseLaraGrid extends Component
{

    use WithPagination;

    public array $filter = [];

    public string $sortColumn = 'id';

    public string $sortDirection = 'desc';

    public int $perPage = 25;

    public array $perPageOptions = [25, 50, 100];

    /** @return BaseColumn[] */
    protected abstract function getColumns(): array;

    protected abstract function getDataSource(): Builder|\Illuminate\Database\Query\Builder|Collection|array;

    public function updatingPerPage()
    {
        $this->resetPage();
    }

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

        if (is_array($query)) {
            $query = collect($query);
        }

        $columns = $this->getColumns();

        $this->applyFilters($columns, $query);
        $this->applySorting($query);

        return view('laragrid::grid', [
            'records' => $query->paginate($this->perPage)->onEachSide(2),
            'columns' => $columns,
        ]);
    }

    /************************************************ GETTERS ************************************************/

    public function getFilterResetButton(): FilterResetButton
    {
        return FilterResetButton::make();
    }

    public function getTheme(): BaseLaraGridTheme
    {
        return TailwindTheme::make();
    }

    /************************************************ PRIVATE ************************************************/

    private function applySorting(Builder|\Illuminate\Database\Query\Builder|Collection &$query): void
    {
        if ($query instanceof Collection) {
            $query = $query->sortBy($this->sortColumn,  descending: $this->sortDirection === 'desc')->values();
        } else {
            if (str_contains($this->sortColumn, '.')) {
                $query->orderByLeftPowerJoins($this->sortColumn, $this->sortDirection);
            } else {
                $query->orderBy($this->sortColumn, $this->sortDirection);
            }
        }
    }

    private function applyFilters(
        array $columns,
        Builder|\Illuminate\Database\Query\Builder|Collection &$query
    ): void
    {
        foreach ($columns as $column) {
            if ($column instanceof Column) {
                $filter = $column->getFilter();

                if ($filter && !in_array($filter->getFiltrationType(), FiltrationType::cases())) {
                    throw new Exception(
                        'Filtration type "'
                        . $filter->getFiltrationType()->name
                        . ' for column "'
                        . $column->getRecordField()
                        . '" does not exist.'
                    );
                }

                $activeFilters = Arr::dot($this->filter);

                if (array_key_exists($column->getRecordField(), $this->filter)) {
                    if ($column->getFilter()->getFilterType() === FilterType::DATE) {
                        $searchedTerm = [
                            'from' => $activeFilters[$column->getRecordField() . '.from'] ?? null,
                            'to' => $activeFilters[$column->getRecordField() . '.to'] ?? null,
                        ];
                    } else {
                        $searchedTerm = $activeFilters[$column->getRecordField()];
                    }

                    if ($searchedTerm === null || $searchedTerm === '' || $searchedTerm === 'null') {
                        unset($this->filter[$column->getRecordField()]);

                        continue;
                    }

                    $query = $column->getFilter()->callBuilder(
                        $query,
                        $column->getRecordField(),
                        $searchedTerm
                    );
                }
            }
        }
    }

}

<?php

namespace BoredProgrammers\LaraGrid\Livewire;

use BoredProgrammers\LaraGrid\Components\BaseLaraGridComponent;
use BoredProgrammers\LaraGrid\Components\Column;
use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Filters\BaseFilter;
use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
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

    protected string $theme = BaseLaraGridTheme::class;

    protected abstract function getDataSource(): Builder;

    /** @return BaseLaraGridComponent[] */
    protected abstract function getColumns(): array;

    public function resetFilters(): void
    {
        $this->dispatch('LGdatePickerClear');
        $this->reset();
    }

    public function sort(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[On('LGdatePickerChanged')]
    public function datePickerChanged(
        array $selectedDates,
        string $dateFormatted,
        string $field,
    ): void
    {
        if (!isset($selectedDates[1])) {
            return;
        }

        [$startDate, $endDate] = $selectedDates;

        $startDate = Carbon::parse($startDate)->format('Y-m-d');
        $endDate = Carbon::parse($endDate)->format('Y-m-d');

        $this->filter["$field.from"] = $startDate;
        $this->filter["$field.to"] = $endDate;
        $this->filter[$field] = $dateFormatted;
    }

    /**
     * @throws Exception
     */
    public function render(): View
    {
        $this->validateThemeClass();

        $query = $this->getDataSource();
        $columns = $this->getColumns();

        $this->applyFiltersToQuery($query, $columns);
        $this->applySortToQuery($query);

        return view('laragrid::grid', [
            'records' => $query->paginate($this->perPage),
            'columns' => $columns,
            'theme' => new $this->theme,
        ]);
    }

    /************************************************ PRIVATE ************************************************/

    /**
     * @throws Exception
     */
    private function applyFiltersToQuery(Builder $query, array $columns): void
    {
        foreach ($columns as $column) {
            if (!$column instanceof Column) {
                continue;
            }

            $modelField = $column->getModelField();
            $filter = $column->getFilter();

            $this->validateFilters($filter, $modelField);

            $activeFilters = Arr::dot($this->filter);
            if (!array_key_exists($modelField, $activeFilters)) {
                continue;
            }

            $searchTerm = match ($filter->getFilterType()) {
                FilterType::DATE => [
                    'from' => $activeFilters[$modelField . '.from'] ?? null,
                    'to' => $activeFilters[$modelField . '.to'] ?? null,
                ],
                default => $activeFilters[$modelField],
            };

            if (empty($searchTerm) || $searchTerm === 'null') {
                unset($this->filter[$modelField]);
                continue;
            }

            $filter->callBuilder($query, $modelField, $searchTerm);
        }
    }

    private function applySortToQuery(Builder $query): void
    {
        if (str_contains($this->sortColumn, '.')) {
            $query->orderByLeftPowerJoins($this->sortColumn, $this->sortDirection);
        } else {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }
    }

    /************************************************ VALIDATORS ************************************************/

    /**
     * @throws Exception
     */
    private function validateThemeClass(): void
    {
        if (!$this->theme || !class_exists($this->theme)) {
            throw new Exception('Invalid theme class: ' . $this->theme);
        }
    }

    /**
     * @throws Exception
     */
    private function validateFilters(?BaseFilter $filter, string $modelField): void
    {
        if ($filter && !in_array($filter->getFiltrationType(), FiltrationType::cases())) {
            throw new Exception(
                'Filtration type "'
                . $filter->getFiltrationType()->name
                . ' for column "'
                . $modelField
                . '" does not exist.'
            );
        }
    }

}

<?php

namespace BoredProgrammers\LaraGrid\Livewire;

use BoredProgrammers\LaraGrid\Components\BaseLaraGridComponent;
use BoredProgrammers\LaraGrid\Components\Column;
use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Enums\FiltrationType;
use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use DateTimeZone;
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

    protected $listeners = ['LGdatePickerChanged' => 'datePickerChanged']; // FIXME: why is this needed?

    protected string $theme = BaseLaraGridTheme::class;

    /** @return BaseLaraGridComponent[] */
    protected abstract function getColumns(): array;

    protected abstract function getDataSource(): Builder;

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

    #[On('LGdatePickerChanged')]
    public function datePickerChanged(
        array $selectedDates,
        string $dateFormatted,
        string $field,
        string $timezone = 'UTC',
    ): void
    {
        if (!isset($selectedDates[1])) {
            return;
        }

        $startDate = strval($selectedDates[0]);
        $endDate = strval($selectedDates[1]);

        $appTimeZone = strval(config('app.timezone'));

        $filterTimezone = new DateTimeZone($timezone);

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
        if (!$this->theme) {
            throw new Exception('Theme is not set!');
        }

        if (!class_exists($this->theme)) {
            throw new Exception('Theme class "' . $this->theme . '" does not exist!');
        }

        $query = $this->getDataSource();
        $columns = $this->getColumns();

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

                if (array_key_exists($column->getModelField(), $activeFilters)) {
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

        if (str_contains($this->sortColumn, '.')) {
            $query->orderByLeftPowerJoins($this->sortColumn, $this->sortDirection);
        } else {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        return view('laragrid::grid', [
            'records' => $query->paginate($this->perPage),
            'columns' => $columns,
            'theme' => new $this->theme,
        ]);
    }

}

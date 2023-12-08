<?php

namespace BoredProgrammers\LaraGrid\Components;

use BoredProgrammers\LaraGrid\Filters\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\SelectFilterOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use UnitEnum;

class Column extends BaseColumn
{

    public static function make(string $modelField, string $label): static
    {
        return new static($modelField, $label);
    }

    public function defaultRender(Model $model)
    {
        $value = data_get($model, $this->getModelField());

        if ($value instanceof UnitEnum) {
            $value = $value->name;
        }

        if ($value instanceof Carbon) {
            return $value->format($this->getDateFormat());
        }

        $filter = $this->getFilter();

        if ($filter && $filter->getFilterType() === FilterType::SELECT) {
            return $this->getValueLabelFromSelect($filter, $value);
        }

        return $value;
    }

    /************************************************ PRIVATE ************************************************/

    /**
     * This section here is because when we have for example bool value (0/1),
     * we want to show label instead of value
     */
    private function getValueLabelFromSelect($filter, mixed $value): ?string
    {
        $selectOption = collect($filter->getOptions())
            ->firstWhere(function (SelectFilterOption $option) use ($value) {
                return $option->getValue() == $value;
            });

        return __($selectOption?->getLabel());
    }

}

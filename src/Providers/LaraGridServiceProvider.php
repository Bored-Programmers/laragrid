<?php

namespace BoredProgrammers\LaraGrid\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class LaraGridServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'laragrid');

        Builder::macro('whereLike', function ($attributes, $searchTerm) {
            if ($searchTerm === null || $searchTerm === '') {
                return $this;
            }

            $this->whereOrWhereRelation($attributes, $searchTerm, 'LIKE', "%{$searchTerm}%");

            return $this;
        });

        Builder::macro('whereEqual', function ($attributes, $value) {
            if ($value === null || $value === '') {
                return $this;
            }

            $this->whereOrWhereRelation($attributes, $value);

            return $this;
        });

        Builder::macro('whereDateBetween', function ($attribute, $startDate = null, $endDate = null) {
            if (!$startDate && !$endDate) {
                return $this;
            }

            $startDate = Carbon::parse($startDate)->setTime(0, 0, 0);
            $endDate = Carbon::parse($endDate)->setTime(23, 59, 59);

            $this->where(function (Builder $query) use ($attribute, $startDate, $endDate) {
                $query->when(
                    Str::contains($attribute, '.'),
                    function (Builder $query) use ($attribute, $startDate, $endDate) {
                        [$relationName, $relationAttribute] = explode('.', $attribute);
                        $query->orWhereHas(
                            $relationName,
                            function (Builder $query) use ($relationAttribute, $startDate, $endDate) {
                                $query->whereBetween($relationAttribute, [$startDate, $endDate]);
                            }
                        );
                    },
                    function (Builder $query) use ($attribute, $startDate, $endDate) {
                        $query->orWhereBetween($attribute, [$startDate, $endDate]);
                    }
                );
            });

            return $this;
        });

        Builder::macro('whereOrWhereRelation', function ($attributes, $value, $operator = '=', $formattedValue = null) {
            $this->where(function (Builder $query) use ($attributes, $value, $operator, $formattedValue) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $value, $operator, $formattedValue) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);
                            $query->orWhereHas(
                                $relationName,
                                function (Builder $query) use ($relationAttribute, $value, $operator, $formattedValue) {
                                    $query->where($relationAttribute, $operator, $formattedValue ?: $value);
                                }
                            );
                        },
                        function (Builder $query) use ($formattedValue, $attribute, $value, $operator) {
                            $query->orWhere($attribute, $operator, $formattedValue ?: $value);
                        }
                    );
                }
            });
        });
    }

}

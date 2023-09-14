<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            if (!$searchTerm) {
                return $this;
            }

            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas(
                                $relationName,
                                function (Builder $query) use ($relationAttribute, $searchTerm) {
                                    $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                                }
                            );
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

        Builder::macro('whereEqual', function ($attributes, $value) {
            if (!$value) {
                return $this;
            }

            $this->where(function (Builder $query) use ($attributes, $value) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $value) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);
                            $query->orWhereHas(
                                $relationName,
                                function (Builder $query) use ($relationAttribute, $value) {
                                    $query->where($relationAttribute, '=', $value);
                                }
                            );
                        },
                        function (Builder $query) use ($attribute, $value) {
                            $query->orWhere($attribute, '=', $value);
                        }
                    );
                }
            });

            return $this;
        });

        Builder::macro('whereDateBetween', function ($attribute, $startDate = null, $endDate = null) {
            if (!$startDate && !$endDate) {
                return $this;
            }

            $startDate = $startDate ?: Carbon::today();
            $endDate = $endDate ?: Carbon::today();

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

}

<?php

namespace BoredProgrammers\LaraGrid\Providers;

use Illuminate\Support\ServiceProvider;

class LaraGridServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'laragrid');
    }

}

<?php

namespace BoredProgrammers\Laragrid\Providers;

use BoredProgrammers\Laragrid\Livewire\BaseGrid;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LaraGridServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        //Livewire::component('laragrid', BaseGrid::class);
    }

}

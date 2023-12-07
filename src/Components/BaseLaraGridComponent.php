<?php

namespace BoredProgrammers\LaraGrid\Components;

use Illuminate\Database\Eloquent\Model;

abstract class BaseLaraGridComponent
{

    public abstract function callRenderer(Model $model);

}

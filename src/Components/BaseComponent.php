<?php

namespace BoredProgrammers\LaraGrid\Components;

use Illuminate\Database\Eloquent\Model;

abstract class BaseComponent
{

    public abstract function callRenderer(Model $model);

}

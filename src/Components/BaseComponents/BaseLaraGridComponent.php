<?php

namespace BoredProgrammers\LaraGrid\Components\BaseComponents;

use Illuminate\Database\Eloquent\Model;

abstract class BaseLaraGridComponent
{

    public abstract function callRenderer(Model $model);

}

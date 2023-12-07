<?php

namespace BoredProgrammers\LaraGrid\Components;

use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use Illuminate\Database\Eloquent\Model;

abstract class BaseLaraGridComponent
{

    public abstract function callRenderer(Model $model, BaseLaraGridTheme $theme);

}

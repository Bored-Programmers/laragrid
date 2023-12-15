<?php

namespace BoredProgrammers\LaraGrid\Components\ColumnComponents;

use BoredProgrammers\LaraGrid\BaseLaraGridClass;
use BoredProgrammers\LaraGrid\Traits\HasAttributes;
use BoredProgrammers\LaraGrid\Traits\HasColumnTag;
use BoredProgrammers\LaraGrid\Traits\HasLabel;
use BoredProgrammers\LaraGrid\Traits\HasRenderer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use function BoredProgrammers\LaraGrid\Components\BaseComponents\collect;

abstract class BaseColumn extends BaseLaraGridClass
{

    use HasRenderer, HasAttributes, HasLabel, HasColumnTag;

    public function __construct(?string $label = null)
    {
        $this->setLabel($label);
    }

}

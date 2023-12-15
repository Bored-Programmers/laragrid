<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasModelField
{

    private ?string $modelField;

    public function getModelField(): ?string
    {
        return $this->modelField;
    }

    public function setModelField(?string $modelField): void
    {
        $this->modelField = $modelField;
    }

}
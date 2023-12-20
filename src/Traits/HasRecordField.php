<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasRecordField
{

    private ?string $recordField;

    public function getRecordField(): ?string
    {
        return $this->recordField;
    }

    public function setRecordField(?string $recordField): void
    {
        $this->recordField = $recordField;
    }

}
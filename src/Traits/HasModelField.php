<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasModelField
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
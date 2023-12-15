<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasColumnTag
{

    private string $columnTag = 'span';

    public function getColumnTag(): string
    {
        return $this->columnTag;
    }

    public function setColumnTag(string $columnTag): static
    {
        $this->columnTag = $columnTag;

        return $this;
    }

}
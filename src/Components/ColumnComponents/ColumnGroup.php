<?php

namespace BoredProgrammers\LaraGrid\Components\ColumnComponents;

use BoredProgrammers\LaraGrid\Components\BaseComponents\BaseColumn;

class ColumnGroup
{

    private array $columns = [];

    private string $label;

    public function __construct(string $label)
    {
        $this->setLabel($label);
    }

    public static function make(string $label): static
    {
        return new static($label);
    }

    /**
     * @return BaseColumn[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    public function setColumns(array $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    public function addColumn(BaseColumn $column): static
    {
        $this->columns[] = $column;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

}
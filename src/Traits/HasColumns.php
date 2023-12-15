<?php

namespace BoredProgrammers\LaraGrid\Traits;

use BoredProgrammers\LaraGrid\Components\ColumnComponents\BaseColumn;

trait HasColumns
{

    /** @var BaseColumn[] */
    protected array $columns = [];

    /**
     * @return BaseColumn[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @param BaseColumn[] $columns
     *
     * @return $this
     */
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

}
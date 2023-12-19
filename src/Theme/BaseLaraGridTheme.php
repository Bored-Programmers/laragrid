<?php

namespace BoredProgrammers\LaraGrid\Theme;

use Illuminate\Database\Eloquent\Model;

abstract class BaseLaraGridTheme
{

    private ?string $tableClass = null;

    private ?string $paginationClass = null;

    private ?string $perPageClass = null;

    private ?FilterTheme $filterTheme;

    private ?THeadTheme $theadTheme;

    private ?TBodyTheme $tbodyTheme;

    public function __construct()
    {
        $this->filterTheme = FilterTheme::make();
        $this->theadTheme = THeadTheme::make();
        $this->tbodyTheme = TBodyTheme::make();
    }

    public abstract static function make(): static;

    public function getTableClass(): ?string
    {
        return $this->tableClass;
    }

    public function setTableClass(?string $tableClass): static
    {
        $this->tableClass = $tableClass;

        return $this;
    }

    public function getPaginationClass(): ?string
    {
        return $this->paginationClass;
    }

    public function setPaginationClass(?string $paginationClass): static
    {
        $this->paginationClass = $paginationClass;

        return $this;
    }

    public function getPerPageClass(): ?string
    {
        return $this->perPageClass;
    }

    public function setPerPageClass(?string $perPageClass): static
    {
        $this->perPageClass = $perPageClass;

        return $this;
    }

    public function getFilterTheme(): ?FilterTheme
    {
        return $this->filterTheme;
    }

    public function setFilterTheme(?FilterTheme $filterTheme): static
    {
        $this->filterTheme = $filterTheme;

        return $this;
    }

    public function getTHeadTheme(): ?THeadTheme
    {
        return $this->theadTheme;
    }

    public function setTHeadTheme(?THeadTheme $theadTheme): static
    {
        $this->theadTheme = $theadTheme;

        return $this;
    }

    public function getTBodyTheme(): ?TBodyTheme
    {
        return $this->tbodyTheme;
    }

    public function setTBodyTheme(?TBodyTheme $tbodyTheme): static
    {
        $this->tbodyTheme = $tbodyTheme;

        return $this;
    }

}

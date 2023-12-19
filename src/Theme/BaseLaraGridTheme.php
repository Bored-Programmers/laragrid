<?php

namespace BoredProgrammers\LaraGrid\Theme;

use Illuminate\Database\Eloquent\Model;

abstract class BaseLaraGridTheme
{

    private ?string $tableClass = null;

    private ?string $paginationClass = null;

    private ?FilterTheme $filterTheme = null;

    private ?THeadTheme $theadTheme = null;

    private ?TBodyTheme $tbodyTheme = null;

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

    public function setTableClass(?string $tableClass): BaseLaraGridTheme
    {
        $this->tableClass = $tableClass;

        return $this;
    }

    public function getPaginationClass(): ?string
    {
        return $this->paginationClass;
    }

    public function setPaginationClass(?string $paginationClass): BaseLaraGridTheme
    {
        $this->paginationClass = $paginationClass;

        return $this;
    }

    public function getFilterTheme(): ?FilterTheme
    {
        return $this->filterTheme;
    }

    public function setFilterTheme(?FilterTheme $filterTheme): BaseLaraGridTheme
    {
        $this->filterTheme = $filterTheme;

        return $this;
    }

    public function getTHeadTheme(): ?THeadTheme
    {
        return $this->theadTheme;
    }

    public function setTHeadTheme(?THeadTheme $theadTheme): BaseLaraGridTheme
    {
        $this->theadTheme = $theadTheme;

        return $this;
    }

    public function getTBodyTheme(): ?TBodyTheme
    {
        return $this->tbodyTheme;
    }

    public function setTBodyTheme(?TBodyTheme $tbodyTheme): BaseLaraGridTheme
    {
        $this->tbodyTheme = $tbodyTheme;

        return $this;
    }
    
}

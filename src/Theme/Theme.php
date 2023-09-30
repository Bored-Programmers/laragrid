<?php

namespace BoredProgrammers\LaraGrid\Theme;

class Theme
{

    private ?string $table = null;
    private ?string $resetLink = null;
    private ?string $thead = null;
    private ?string $tr = null;
    private ?string $th = null;
    private ?string $tbody = null;
    private ?string $td = null;
    private ?string $pagination = null;
    private ?string $filterText = null;

    public function getTable(): ?string
    {
        return $this->table;
    }

    public function setTable(?string $table): Theme
    {
        $this->table = $table;

        return $this;
    }

    public function getResetLink(): ?string
    {
        return $this->resetLink;
    }

    public function setResetLink(?string $resetLink): Theme
    {
        $this->resetLink = $resetLink;

        return $this;
    }

    public function getThead(): ?string
    {
        return $this->thead;
    }

    public function setThead(?string $thead): Theme
    {
        $this->thead = $thead;

        return $this;
    }

    public function getTr(): ?string
    {
        return $this->tr;
    }

    public function setTr(?string $tr): Theme
    {
        $this->tr = $tr;

        return $this;
    }

    public function getTh(): ?string
    {
        return $this->th;
    }

    public function setTh(?string $th): Theme
    {
        $this->th = $th;

        return $this;
    }

    public function getTbody(): ?string
    {
        return $this->tbody;
    }

    public function setTbody(?string $tbody): Theme
    {
        $this->tbody = $tbody;

        return $this;
    }

    public function getTd(): ?string
    {
        return $this->td;
    }

    public function setTd(?string $td): Theme
    {
        $this->td = $td;

        return $this;
    }

    public function getPagination(): ?string
    {
        return $this->pagination;
    }

    public function setPagination(?string $pagination): Theme
    {
        $this->pagination = $pagination;

        return $this;
    }

    public function getFilterText(): ?string
    {
        return $this->filterText;
    }

    public function setFilterText(?string $filterText): Theme
    {
        $this->filterText = $filterText;

        return $this;
    }

}

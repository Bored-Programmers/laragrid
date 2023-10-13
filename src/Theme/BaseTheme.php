<?php

namespace BoredProgrammers\LaraGrid\Theme;

class BaseTheme
{

    private ?string $table = null;
    private ?string $resetLink = null;
    private ?string $thead = null;
    private ?string $tr = null;
    private ?string $th = null;
    private ?string $tbody = null;
    private ?string $td = null;
    private ?string $actionContainer = null;
    private ?string $pagination = null;
    private ?string $filterText = null;
    private ?string $filterSelect = null;
    private ?string $filterDate = null;
    private ?string $actionButton = null;

    public function getTable(): ?string
    {
        return $this->table;
    }

    public function setTable(?string $table): BaseTheme
    {
        $this->table = $table;

        return $this;
    }

    public function getResetLink(): ?string
    {
        return $this->resetLink;
    }

    public function setResetLink(?string $resetLink): BaseTheme
    {
        $this->resetLink = $resetLink;

        return $this;
    }

    public function getThead(): ?string
    {
        return $this->thead;
    }

    public function setThead(?string $thead): BaseTheme
    {
        $this->thead = $thead;

        return $this;
    }

    public function getTr(): ?string
    {
        return $this->tr;
    }

    public function setTr(?string $tr): BaseTheme
    {
        $this->tr = $tr;

        return $this;
    }

    public function getTh(): ?string
    {
        return $this->th;
    }

    public function setTh(?string $th): BaseTheme
    {
        $this->th = $th;

        return $this;
    }

    public function getTbody(): ?string
    {
        return $this->tbody;
    }

    public function setTbody(?string $tbody): BaseTheme
    {
        $this->tbody = $tbody;

        return $this;
    }

    public function getTd(): ?string
    {
        return $this->td;
    }

    public function setTd(?string $td): BaseTheme
    {
        $this->td = $td;

        return $this;
    }

    public function getPagination(): ?string
    {
        return $this->pagination;
    }

    public function setPagination(?string $pagination): BaseTheme
    {
        $this->pagination = $pagination;

        return $this;
    }

    public function getFilterText(): ?string
    {
        return $this->filterText;
    }

    public function setFilterText(?string $filterText): BaseTheme
    {
        $this->filterText = $filterText;

        return $this;
    }

    public function getFilterSelect(): ?string
    {
        return $this->filterSelect;
    }

    public function setFilterSelect(?string $filterSelect): BaseTheme
    {
        $this->filterSelect = $filterSelect;

        return $this;
    }

    public function getFilterDate(): ?string
    {
        return $this->filterDate;
    }

    public function setFilterDate(?string $filterDate): BaseTheme
    {
        $this->filterDate = $filterDate;

        return $this;
    }

    public function getActionContainer(): ?string
    {
        return $this->actionContainer;
    }

    public function setActionContainer(?string $actionContainer): BaseTheme
    {
        $this->actionContainer = $actionContainer;

        return $this;
    }

    public function getActionButton(): ?string
    {
        return $this->actionButton;
    }

    public function setActionButton(?string $actionButton): BaseTheme
    {
        $this->actionButton = $actionButton;

        return $this;
    }

}

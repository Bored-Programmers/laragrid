<?php

namespace BoredProgrammers\LaraGrid\Theme;

use Closure;

class BaseLaraGridTheme
{

    private ?string $table = null;

    private ?string $resetLink = null;

    private ?string $thead = null;

    private ?string $tr = null;

    private ?string $th = null;

    private ?string $tbody = null;

    private ?string $td = null;

    private ?string $groupTd = null;

    private ?string $actionContainer = null;

    private ?string $pagination = null;

    private ?string $filterText = null;

    private ?string $filterSelect = null;

    private ?string $filterDate = null;

    private ?string $actionButton = null;

    private ?string $paginationMaxResults = null;

    private ?string $paginationMaxResultsContainer = null;

    private ?string $paginationContainer = null;

    private ?string $emptyMessage = null;

    private ?Closure $resetFilterButton = null;

    public function __construct()
    {
        $this->setResetFilterButton(fn() => __('laragrid::translations.filter.reset'));
    }

    public function make(): static
    {
        return new static();
    }

    public function getTable(): ?string
    {
        return $this->table;
    }

    public function setTable(?string $table): static
    {
        $this->table = $table;

        return $this;
    }

    public function getResetLink(): ?string
    {
        return $this->resetLink;
    }

    public function setResetLink(?string $resetLink): static
    {
        $this->resetLink = $resetLink;

        return $this;
    }

    public function getThead(): ?string
    {
        return $this->thead;
    }

    public function setThead(?string $thead): static
    {
        $this->thead = $thead;

        return $this;
    }

    public function getTr(): ?string
    {
        return $this->tr;
    }

    public function setTr(?string $tr): static
    {
        $this->tr = $tr;

        return $this;
    }

    public function getTh(): ?string
    {
        return $this->th;
    }

    public function setTh(?string $th): static
    {
        $this->th = $th;

        return $this;
    }

    public function getTbody(): ?string
    {
        return $this->tbody;
    }

    public function setTbody(?string $tbody): static
    {
        $this->tbody = $tbody;

        return $this;
    }

    public function getTd(): ?string
    {
        return $this->td;
    }

    public function setTd(?string $td): static
    {
        $this->td = $td;

        return $this;
    }

    public function getGroupTd(): ?string
    {
        return $this->groupTd;
    }

    public function setGroupTd(?string $groupTd): BaseLaraGridTheme
    {
        $this->groupTd = $groupTd;

        return $this;
    }

    public function getPagination(): ?string
    {
        return $this->pagination;
    }

    public function setPagination(?string $pagination): static
    {
        $this->pagination = $pagination;

        return $this;
    }

    public function getFilterText(): ?string
    {
        return $this->filterText;
    }

    public function setFilterText(?string $filterText): static
    {
        $this->filterText = $filterText;

        return $this;
    }

    public function getFilterSelect(): ?string
    {
        return $this->filterSelect;
    }

    public function setFilterSelect(?string $filterSelect): static
    {
        $this->filterSelect = $filterSelect;

        return $this;
    }

    public function getFilterDate(): ?string
    {
        return $this->filterDate;
    }

    public function setFilterDate(?string $filterDate): static
    {
        $this->filterDate = $filterDate;

        return $this;
    }

    public function getActionContainer(): ?string
    {
        return $this->actionContainer;
    }

    public function setActionContainer(?string $actionContainer): static
    {
        $this->actionContainer = $actionContainer;

        return $this;
    }

    public function getActionButton(): ?string
    {
        return $this->actionButton;
    }

    public function setActionButton(?string $actionButton): static
    {
        $this->actionButton = $actionButton;

        return $this;
    }

    public function getPaginationMaxResults(): ?string
    {
        return $this->paginationMaxResults;
    }

    public function setPaginationMaxResults(?string $paginationMaxResults): static
    {
        $this->paginationMaxResults = $paginationMaxResults;

        return $this;
    }

    public function getPaginationMaxResultsContainer(): ?string
    {
        return $this->paginationMaxResultsContainer;
    }

    public function setPaginationMaxResultsContainer(?string $paginationMaxResultsContainer): static
    {
        $this->paginationMaxResultsContainer = $paginationMaxResultsContainer;

        return $this;
    }

    public function getPaginationContainer(): ?string
    {
        return $this->paginationContainer;
    }

    public function setPaginationContainer(?string $paginationContainer): static
    {
        $this->paginationContainer = $paginationContainer;

        return $this;
    }

    public function getEmptyMessage(): ?string
    {
        return $this->emptyMessage;
    }

    public function setEmptyMessage(?string $emptyMessage): BaseLaraGridTheme
    {
        $this->emptyMessage = $emptyMessage;

        return $this;
    }

    public function getResetFilterButton(): Closure
    {
        return $this->resetFilterButton;
    }

    public function setResetFilterButton($resetFilterButton): static
    {
        $this->resetFilterButton = $resetFilterButton;

        return $this;
    }

}

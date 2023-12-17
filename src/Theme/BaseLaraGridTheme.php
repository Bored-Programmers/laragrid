<?php

namespace BoredProgrammers\LaraGrid\Theme;

use Illuminate\Database\Eloquent\Model;

abstract class BaseLaraGridTheme
{

    protected ?string $tableClass = null;

    protected ?string $filterResetButtonClass = null;

    protected ?string $theadClass = null;

    protected ?string $trClass = null;

    protected ?string $filterTrClass = null;

    protected ?string $thClass = null;

    protected ?string $tbodyClass = null;

    protected ?string $tdClass = null;

    protected ?string $groupTdClass = null;

    protected ?string $paginationClass = null;

    protected ?string $filterTextClass = null;

    protected ?string $filterSelectClass = null;

    protected ?string $filterDateClass = null;

    protected ?string $emptyMessageClass = null;

    /** @var callable */
    protected $filterResetButtonRenderer;

    /** @var callable */
    protected $recordTrClass;

    public function __construct()
    {
        $this->setFilterResetButtonRenderer(fn() => __('laragrid::translations.filter.reset'));
    }

    public abstract static function make(): static;

    public function callFilterResetButtonRenderer()
    {
        return call_user_func($this->getFilterResetButtonRenderer());
    }

    public function getFilterResetButtonRenderer(): callable
    {
        return $this->filterResetButtonRenderer;
    }

    public function setFilterResetButtonRenderer(callable $filterResetButtonRenderer): static
    {
        $this->filterResetButtonRenderer = $filterResetButtonRenderer;

        return $this;
    }

    public function callRecordTrClass(Model $model)
    {
        return call_user_func_array($this->getRecordTrClass(), [$model]);
    }

    public function getRecordTrClass(): callable
    {
        return $this->recordTrClass ?: fn() => '';
    }

    public function setRecordTrClass(callable|string $recordTrClass): static
    {
        if (is_string($recordTrClass)) {
            $recordTrClass = fn() => $recordTrClass;
        }

        $this->recordTrClass = $recordTrClass;

        return $this;
    }

    public function getTableClass(): ?string
    {
        return $this->tableClass;
    }

    public function setTableClass(?string $tableClass): BaseLaraGridTheme
    {
        $this->tableClass = $tableClass;

        return $this;
    }

    public function getFilterResetButtonClass(): ?string
    {
        return $this->filterResetButtonClass;
    }

    public function setFilterResetButtonClass(?string $filterResetButtonClass): BaseLaraGridTheme
    {
        $this->filterResetButtonClass = $filterResetButtonClass;

        return $this;
    }

    public function getTheadClass(): ?string
    {
        return $this->theadClass;
    }

    public function setTheadClass(?string $theadClass): BaseLaraGridTheme
    {
        $this->theadClass = $theadClass;

        return $this;
    }

    public function getTrClass(): ?string
    {
        return $this->trClass;
    }

    public function setTrClass(?string $trClass): BaseLaraGridTheme
    {
        $this->trClass = $trClass;

        return $this;
    }

    public function getFilterTrClass(): ?string
    {
        return $this->filterTrClass;
    }

    public function setFilterTrClass(?string $filterTrClass): BaseLaraGridTheme
    {
        $this->filterTrClass = $filterTrClass;

        return $this;
    }

    public function getThClass(): ?string
    {
        return $this->thClass;
    }

    public function setThClass(?string $thClass): BaseLaraGridTheme
    {
        $this->thClass = $thClass;

        return $this;
    }

    public function getTbodyClass(): ?string
    {
        return $this->tbodyClass;
    }

    public function setTbodyClass(?string $tbodyClass): BaseLaraGridTheme
    {
        $this->tbodyClass = $tbodyClass;

        return $this;
    }

    public function getTdClass(): ?string
    {
        return $this->tdClass;
    }

    public function setTdClass(?string $tdClass): BaseLaraGridTheme
    {
        $this->tdClass = $tdClass;

        return $this;
    }

    public function getGroupTdClass(): ?string
    {
        return $this->groupTdClass;
    }

    public function setGroupTdClass(?string $groupTdClass): BaseLaraGridTheme
    {
        $this->groupTdClass = $groupTdClass;

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

    public function getFilterTextClass(): ?string
    {
        return $this->filterTextClass;
    }

    public function setFilterTextClass(?string $filterTextClass): BaseLaraGridTheme
    {
        $this->filterTextClass = $filterTextClass;

        return $this;
    }

    public function getFilterSelectClass(): ?string
    {
        return $this->filterSelectClass;
    }

    public function setFilterSelectClass(?string $filterSelectClass): BaseLaraGridTheme
    {
        $this->filterSelectClass = $filterSelectClass;

        return $this;
    }

    public function getFilterDateClass(): ?string
    {
        return $this->filterDateClass;
    }

    public function setFilterDateClass(?string $filterDateClass): BaseLaraGridTheme
    {
        $this->filterDateClass = $filterDateClass;

        return $this;
    }

    public function getEmptyMessageClass(): ?string
    {
        return $this->emptyMessageClass;
    }

    public function setEmptyMessageClass(?string $emptyMessageClass): BaseLaraGridTheme
    {
        $this->emptyMessageClass = $emptyMessageClass;

        return $this;
    }

}

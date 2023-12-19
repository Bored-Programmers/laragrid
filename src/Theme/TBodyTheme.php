<?php

namespace BoredProgrammers\LaraGrid\Theme;

class TBodyTheme
{

    private ?string $tbodyClass = null;

    private ?string $trClass = null;

    private ?string $tdClass = null;

    private ?string $emptyMessageClass = null;

    private ?string $groupTdClass = null;

    /** @var callable */
    private $recordTrClass;

    public function __construct()
    {
    }

    public static function make(): static
    {
        return new static();
    }

    public function getTbodyClass(): ?string
    {
        return $this->tbodyClass;
    }

    public function setTbodyClass(?string $tbodyClass): TBodyTheme
    {
        $this->tbodyClass = $tbodyClass;

        return $this;
    }

    public function getTrClass(): ?string
    {
        return $this->trClass;
    }

    public function setTrClass(?string $trClass): TBodyTheme
    {
        $this->trClass = $trClass;

        return $this;
    }

    public function getTdClass(): ?string
    {
        return $this->tdClass;
    }

    public function setTdClass(?string $tdClass): TBodyTheme
    {
        $this->tdClass = $tdClass;

        return $this;
    }

    public function getEmptyMessageClass(): ?string
    {
        return $this->emptyMessageClass;
    }

    public function setEmptyMessageClass(?string $emptyMessageClass): TBodyTheme
    {
        $this->emptyMessageClass = $emptyMessageClass;

        return $this;
    }

    public function getGroupTdClass(): ?string
    {
        return $this->groupTdClass;
    }

    public function setGroupTdClass(?string $groupTdClass): TBodyTheme
    {
        $this->groupTdClass = $groupTdClass;

        return $this;
    }

    public function callRecordTrClass(...$args)
    {
        return call_user_func_array($this->getRecordTrClass(), $args);
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

}
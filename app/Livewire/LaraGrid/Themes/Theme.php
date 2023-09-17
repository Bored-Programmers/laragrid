<?php

namespace App\Livewire\LaraGrid\Themes;

class Theme
{

    private $table = '';

    private $link = '';

    private $thead = '';

    private $tr = '';

    private $th = '';

    private $tbody = '';

    private $td = '';

    private $pagination = '';

    // Setters
    public function setTable($style)
    {
        $this->table = $style;

        return $this;
    }

    public function setLink($style)
    {
        $this->link = $style;

        return $this;
    }

    public function setThead($style)
    {
        $this->thead = $style;

        return $this;
    }

    public function setTr($style)
    {
        $this->tr = $style;

        return $this;
    }

    public function setTh($style)
    {
        $this->th = $style;

        return $this;
    }

    public function setTbody($style)
    {
        $this->tbody = $style;

        return $this;
    }

    public function setTd($style)
    {
        $this->td = $style;

        return $this;
    }

    public function setPagination($style)
    {
        $this->pagination = $style;

        return $this;
    }

    // Getters
    public function getTable()
    {
        return $this->table;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getThead()
    {
        return $this->thead;
    }

    public function getTr()
    {
        return $this->tr;
    }

    public function getTh()
    {
        return $this->th;
    }

    public function getTbody()
    {
        return $this->tbody;
    }

    public function getTd()
    {
        return $this->td;
    }

    public function getPagination()
    {
        return $this->pagination;
    }

}

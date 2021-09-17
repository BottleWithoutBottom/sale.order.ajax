<?php

namespace Letsrock\Actions;
use Bitrock\View\View;

abstract class AbstractAction
{
    /** @property View $view */
    protected $view;
    protected $data;

    public function __construct()
    {
        $this->view = new View();
    }

    abstract public function modify($data);
    abstract public function getHtml($data);
}
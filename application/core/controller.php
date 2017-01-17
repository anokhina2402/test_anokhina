<?php

/** class of controller **/
class Controller
{

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    /** default action **/
    function action_index()
    {
        // todo
    }
}

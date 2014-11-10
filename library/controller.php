<?php

class Controller
{
    protected $view;
    protected $model;

    public function __construct()
    {
        $modelName = str_replace('Controller', '', get_class($this));
        $this->view = new View();
        $this->model = new $modelName();
    }

    public function sessionInit()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function isLoggedIn()
    {
        if (!empty($_SESSION['username'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isAdmin()
    {
        if ($_SESSION['permission'] == 'admin') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
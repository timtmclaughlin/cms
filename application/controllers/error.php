<?php

class Error extends Controller
{

    public function __construct($error)
    {
        parent::construct();
        $this->view->errors = array($error);
    }

    public function index()
    {
        $this->view->render('error/index');
    }
}

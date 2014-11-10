<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->sessionInit();
        $this->view->render('index/index');
    }
}


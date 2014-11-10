<?php

class Model extends DB
{
    protected $model;

    public function __construct()
    {
        $this->dbconnect();
        $this->model = get_class($this);
        $this->table = strtolower($this->model);
    }

    public function __destruct()
    {
        $this->disconnect();
    }

}
	
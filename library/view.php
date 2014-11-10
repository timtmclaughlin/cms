<?php

class View
{
    public $data = array();

    public function set($key, $value)
    {
        $this->data[$key] = ($value);
    }

    public function get($key)
    {
        return $this->data[$key];
    }

    public function render($viewName)
    {
        $this->blocks = new BlocksController();
        $this->blocks->loadblocks();

        extract($this->data);
        ob_start();

        require ROOT . DS . 'application' . DS . 'views' . DS . 'header.php';
        require ROOT . DS . 'application' . DS . 'views' . DS . $viewName . '.php';
        require ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php';

        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

    public function displayblock($blockname)
    {
        $block = $this->blocks->block[$blockname];
        require ROOT . DS . 'application' . DS . 'views' . DS . 'blocks' . DS . 'index.php';
        return $block;
    }

    public function displayAdminBar()
    {
        if (isset($_SESSION['username'])) {
            include_once(ADMINTOOLBAR);
        }
    }

    public function ifAdminBar()
    {
        if (isset($_SESSION['username'])) {
            $class = 'class="adminbar"';
            echo $class;
        }
    }
}
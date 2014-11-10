<?php

class Blocks extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBlocks($id = null)
    {
        if ($id == null) {
            $blocks = $this->selectAll();
        } else {
            $blocks = $this->selectById($id);
        }
        return $blocks;
    }
}

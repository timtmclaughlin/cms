<?php

class Posts extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPosts($id = null)
    {
        if ($id == null) {
            $posts = $this->selectAll();
        } else {
            $posts = $this->selectById($id);
        }
        return $posts;
    }
}

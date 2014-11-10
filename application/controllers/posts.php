<?php

class PostsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->sessionInit();

        $posts = $this->model->getPosts();
        foreach ($posts as $key => $value) {
            $this->view->set($key, $value);
        }
        $this->view->render('posts/index');
    }

    public function show($url)
    {
        $this->sessionInit();

        // Get post by ID and show
        $id = isset($url[2]) && is_numeric($url[2]) ? $url[2] : null;
        $post = $this->model->getPosts($id);

        if ($post != null && $id != null) {
            foreach ($post as $key => $value) {
                $this->view->set($key, $value);
            }
            $this->view->render('posts/show');
        } else {
            $this->view->render('error/index');
        }
    }

}

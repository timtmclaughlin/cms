<?php

class AdminController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            $this->view->render('admin/index');
        } elseif (isset($_POST['submitted'])) {
            $un = isset($_POST['username']) ? $_POST['username'] : null;
            $pw = isset($_POST['password']) ? sha1($_POST['password']) : null;
            $this->model->authenticateUser($un, $pw);
            $this->login();
        } else {
            $this->view->render('admin/login');
        }
    }

    public function login()
    {
        $this->sessionInit();

        if (isset($this->model->user)) {
            $_SESSION['username'] = $this->model->user['username'];
            $_SESSION['nickname'] = $this->model->user['nickname'];
            ob_start();
            header('Location: /admin');
            ob_end_flush();
        } else {
            $_POST['warning'] = 'There was an issue with that username/password combination, please try again...';
            $this->view->render('admin/login');
        }
    }

    public function logout()
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            session_unset();
            session_destroy();
            ob_start();
            header('Location: /admin');
            ob_end_flush();
        } else {
            echo 'no work';
        }
    }

    public function registeruser()
    {
        $this->sessionInit();

        if (!isset($_SESSION['username'])) {

            if (!isset($_POST['submitted'])) {
                $this->view->render('admin/registration');
            }

            // If everything is in order, add user
            if (!empty($_POST['submitted'])
                && !empty($_POST['username'])
                && !empty($_POST['password'])
                && !empty($_POST['confirmpw'])
                && ($_POST['password'] == $_POST['confirmpw'])
                && ($this->model->isUsernameAvailable($_POST['username']))
            ) {
                $un = $_POST['username'];
                $pw = sha1($_POST['password']);
                $this->model->addUser($un, $pw);
                $_POST['warning'] = 'User Account successfully created. Feel free to log in.';
                $this->view->render('admin/login');
            } elseif (isset($_POST['submitted']) && (($_POST['password']) != $_POST['confirmpw'])) {
                $_POST['warning'] = 'Passwords did not match';
                $this->view->render('admin/registration');
            } elseif (isset($_POST['submitted']) && ($this->model->isUsernameAvailable($_POST['username']) == FALSE)) {
                $_POST['warning'] = 'That username is already taken';
                $this->view->render('admin/registration');
            } elseif (isset($_POST['submitted'])) {
                $_POST['warning'] = 'Please fill out all the fields.';
                $this->view->render('admin/registration');
            }

        } else {
            // They're already logged in and shouldn't register
        }
    }

    public function viewusers()
    {
        $this->sessionInit();

        if (isset($_SESSION)) {

            $users = $this->model->getUsers();
            foreach ($users as $key => $value) {
                $this->view->set($key, $value);
            }
            $this->view->render('admin/viewusers');

        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function edituser($url)
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            // Get User ID
            $id = isset($url[2]) && is_numeric($url[2]) ? $url[2] : null;

            if (isset($_POST['submitted'])
                && !empty($_POST['password'])
                && !empty($_POST['confpassword'])
                && ($_POST['password'] == $_POST['confpassword'])
                && !empty($_POST['permissions'])
            ) {
                // If everything checks out, get form data and update database
                $pw = sha1($_POST['password']);
                $perm = $_POST['permissions'];
                $this->model->updateUser($pw, $perm, $id);
                $_POST['warning'] = 'User account successfully updated.';
            } elseif (isset($_POST['submitted']) && (($_POST['password']) != $_POST['confpassword'])) {
                $_POST['warning'] = 'Passwords did not match.';
            } elseif (isset($_POST['submitted'])) {
                $_POST['warning'] = 'Please fill out all the fields.';
            }

            // Get user by ID, set data, and render
            $user = $this->model->getSingleUser($id);
            foreach ($user as $key => $value) {
                $this->view->set($key, $value);
            }
            $this->view->render('admin/edituser');

        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function deleteuser($url)
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            // Get User ID
            $id = isset($url[2]) && is_numeric($url[2]) ? $url[2] : null;
            $this->model->deleteUser($id);
            ob_start();
            header('Location: /admin/viewusers');
            ob_end_flush();
        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function viewposts()
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            $posts = $this->model->getAllPosts();
            foreach ($posts as $key => $value) {
                $this->view->set($key, $value);
            }
            $this->view->render('admin/viewposts');
        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function editpost($url)
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            // Get Post ID
            $id = isset($url[2]) && is_numeric($url[2]) ? $url[2] : null;

            if (isset($_POST['submitted'])) {
                // If update submitted, get form data and update database
                $title = isset($_POST['title']) ? ($_POST['title']) : null;
                $content = isset($_POST['content']) ? ($_POST['content']) : null;
                $this->model->updatePost($title, $content, $id);
            }

            // Get post by ID, set data, and render
            $post = $this->model->getSinglePost($id);
            foreach ($post as $key => $value) {
                $this->view->set($key, $value);
            }
            $this->view->render('admin/editpost');

        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function addpost()
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {

            if (isset($_POST['submitted'])) {
                // If content submitted, get form data and insert into database
                $title = isset($_POST['title']) ? $_POST['title'] : null;
                $content = isset($_POST['content']) ? $_POST['content'] : null;
                $this->model->addPost($title, $content);
                ob_start();
                header('Location: /admin/viewposts');
                ob_end_flush();
            }

            $this->view->render('admin/addpost');
        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function deletepost($url)
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            // Get Post ID
            $id = isset($url[2]) && is_numeric($url[2]) ? $url[2] : null;
            $this->model->deletePost($id);
            ob_start();
            header('Location: /admin/viewposts');
            ob_end_flush();
        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function viewblocks()
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            $blocks = $this->model->getAllBlocks();
            foreach ($blocks as $key => $value) {
                $this->view->set($key, $value);
            }
            $this->view->render('admin/viewblocks');
        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function editblock($url)
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            // Get Block ID
            $id = isset($url[2]) && is_numeric($url[2]) ? $url[2] : null;

            if (isset($_POST['submitted'])) {
                // If update submitted, get form data and update database
                $name = isset($_POST['name']) ? ($_POST['name']) : null;
                $content = isset($_POST['content']) ? ($_POST['content']) : null;
                $this->model->updateBlock($name, $content, $id);
            }

            // Get block by ID, set data, and render
            $block = $this->model->getSingleBlock($id);
            foreach ($block as $key => $value) {
                $this->view->set($key, $value);
            }
            $this->view->render('admin/editblock');

        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function addblock()
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {

            if (isset($_POST['submitted'])) {
                // If content submitted, get form data and insert into database
                $name = isset($_POST['name']) ? $_POST['name'] : null;
                $content = isset($_POST['content']) ? $_POST['content'] : null;
                $this->model->addBlock($name, $content);
                ob_start();
                header('Location: /admin/viewblocks');
                ob_end_flush();
            }

            $this->view->render('admin/addblock');
        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

    public function deleteblock($url)
    {
        $this->sessionInit();

        if (isset($_SESSION['username'])) {
            // Get Post ID
            $id = isset($url[2]) && is_numeric($url[2]) ? $url[2] : null;
            $this->model->deleteBlock($id);
            ob_start();
            header('Location: /admin/viewblocks');
            ob_end_flush();
        } else {
            $_POST['warning'] = 'Oops, you must be logged in to access that';
            $this->view->render('admin/login');
        }
    }

}
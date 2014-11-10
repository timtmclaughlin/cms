<?php

class Admin extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->user = null;
    }

    public function authenticateUser($un, $pw)
    {
        $un = $this->db->real_escape_string($un);
        $pw = $this->db->real_escape_string($pw);
        $this->user = $this->selectUser($un, $pw);
        return $this->user;
    }

    public function isUsernameAvailable($un)
    {
        $un = $this->db->real_escape_string($un);
        $query = "SELECT username FROM users WHERE username = '" . $un . "'";
        $res = $this->selectCustom($query);
        if (empty($res)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function addUser($un, $pw)
    {
        $un = $this->db->real_escape_string($un);
        $pw = $this->db->real_escape_string($pw);
        $query = "INSERT INTO users (username, pswd, permission) VALUES ('$un', '$pw', 'subscriber')";
        $this->updateQuery($query);
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users ORDER BY username";
        $users = $this->selectCustom($query);
        return $users;
    }

    public function getSingleUser($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM users WHERE id = " . $id;
        $user = $this->selectCustom($query);
        return $user;
    }

    public function updateUser($pw, $perm, $id)
    {
        $pw = $this->db->real_escape_string($pw);
        $perm = $this->db->real_escape_string($perm);
        $id = $this->db->real_escape_string($id);
        $query = "UPDATE users SET pswd = '" . $pw . "', permission = '" . $perm . "' WHERE id = " . $id;
        $this->updateQuery($query);
    }

    public function deleteUser($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "DELETE FROM users WHERE id = " . $id . " LIMIT 1";
        $this->updateQuery($query);
    }

    public function getAllPosts()
    {
        $query = "SELECT * FROM posts ORDER BY title";
        $posts = $this->selectCustom($query);
        return $posts;
    }

    public function getSinglePost($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM posts WHERE id = " . $id;
        $post = $this->selectCustom($query);
        return $post;
    }

    public function updatePost($title, $content, $id)
    {
        $title = $this->db->real_escape_string($title);
        $content = $this->db->real_escape_string($content);
        $id = $this->db->real_escape_string($id);
        $query = "UPDATE posts SET title = '" . $title . "', content = '" . $content . "' WHERE id = " . $id;
        $this->updateQuery($query);
    }

    public function addPost($title, $content)
    {
        $title = $this->db->real_escape_string($title);
        $content = $this->db->real_escape_string($content);
        $query = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
        $this->updateQuery($query);
    }

    public function deletePost($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "DELETE FROM posts WHERE id = " . $id . " LIMIT 1";
        $this->updateQuery($query);
    }

    public function getAllBlocks()
    {
        $query = "SELECT * FROM blocks ORDER BY name";
        $blocks = $this->selectCustom($query);
        return $blocks;
    }

    public function getSingleBlock($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * FROM blocks WHERE id = " . $id;
        $block = $this->selectCustom($query);
        return $block;
    }

    public function updateBlock($name, $content, $id)
    {
        $name = $this->db->real_escape_string($name);
        $content = $this->db->real_escape_string($content);
        $id = $this->db->real_escape_string($id);
        $query = "UPDATE blocks SET name = '" . $name . "', content = '" . $content . "' WHERE id = " . $id;
        $this->updateQuery($query);
    }

    public function addBlock($name, $content)
    {
        $name = $this->db->real_escape_string($name);
        $content = $this->db->real_escape_string($content);
        $query = "INSERT INTO blocks (name, content) VALUES ('$name', '$content')";
        $this->updateQuery($query);
    }

    public function deleteBlock($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "DELETE FROM blocks WHERE id = " . $id . " LIMIT 1";
        $this->updateQuery($query);
    }



}
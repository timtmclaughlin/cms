<?php

class DB
{
    protected $dbconnect;
    protected $result;

    // Connect to database
    public function dbconnect()
    {
        $this->db = new mysqli;
        $this->db->connect('localhost', 'root', '', 'mycms');
    }

    // Disconnect db
    public function disconnect()
    {
        $this->db->close();
    }

    // Select All Rows
    public function selectAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQL_ASSOC);
    }

    // Select Row by id
    public function selectById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = " . $id;
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    // Select User
    public function selectUser($un, $pw)
    {
        $query = "SELECT * FROM users WHERE username = '" . $un . "' AND pswd = '" . $pw . "'";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    // Custom Query
    public function selectCustom($query)
    {
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQL_ASSOC);
    }

    // Update Query
    public function updateQuery($query)
    {
        $result = $this->db->query($query);
        return true;
    }

    // Get number of rows
    public function getNumRows()
    {

    }

    // Free Resources allocated by a query
    public function freeResult()
    {

    }

    // Get error string
    public function getError()
    {

    }

}
	
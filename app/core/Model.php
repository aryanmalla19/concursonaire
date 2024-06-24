<?php

class Model {
    protected $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', '23189617');

        if ($this->db->connect_error) {
            die('Connection failed: ' . $this->db->connect_error);
        }
    }
}
?>

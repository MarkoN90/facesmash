<?php

class Database {

    private $config; 
    public $connection;

    public function __construct() {

        $this->config = require_once('../config.php');
        $this->connect();
    }

    /**
     * Method for connecting to database.
     * 
     * @return void
     */
    public function connect() {
        try {
            $this->connection = new PDO($this->getDns(), $this->config['db']['db_user'], $this->config['db']['password']);
        } catch (Exception $e) {
            die('Database connection lost.');
        }
    }

    /**
     * Method for generating dns from config file.
     * 
     * @return string
     */
    public function getDns() {
        return $this->config['db']['dbms'] . ':' . 'dbname=' . $this->config['db']['db_name'] . ';host=' . $this->config['db']['host'];
    }


}

$db = new Database();
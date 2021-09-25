<?php



class Database {

    private $config; 
    public $connection;

    public function __construct() {

        $this->config = require_once('../config.php');
        $this->connect();


    }


    public function connect() {

        new PDO($dsn, $this->config['db']['db_user'], $this->config['db']['password']);

    }




}
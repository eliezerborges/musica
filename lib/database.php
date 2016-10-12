<?php
/**
* Classe Database implementa Singleton
**/
class Database {
    private $host='localhost';
    private $db = 'projeto';
    private $username = 'postgres';
    private $password = 'admin';

    private $conn = null;

    static private $instance;

    private function __construct() {
        $dsn = 'pgsql:host='. $this->host . ';port=5432;dbname='. $this->db . ';' .
                'user=' . $this->username . ';password= ' . $this->password .';';
        try{
             // create a PostgreSQL database connection
             $conn = new PDO($dsn);

             // display a message if connected to the PostgreSQL successfully
             if($conn){
                 $this->conn = $conn;
             }
        }catch (PDOException $e){
            $this->conn = null;
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

<?php
class DB_Connect {

    private $conn;

    // Connecting to database
    public function connect() {
        require_once 'db_config.php';

        // Connecting to mysql database
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // return database handler
        return $this->conn;
    }

    // Closing database connection
    public function close() {
        $this->conn->close();
    }

}

?>
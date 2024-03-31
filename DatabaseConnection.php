<?php
class DatabaseConnection {
    private $conn;

    public function __construct($host, $username, $password, $database) {
        $this->conn = new mysqli($host, $username, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error executing query: " . $this->conn->error);
        }
        return $result;
    }

    public function close() {
        $this->conn->close();
    }
}

?>

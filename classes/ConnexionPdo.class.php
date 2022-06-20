<?php
class ConnexionPdo

{
    /* Properties */
    public $conn;
    private $dsn = 'mysql:dbname=check_tricks;host=127.0.0.1';
    private $user = 'root';
    private $password = 'root';
    /* Creates database connection */
    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "";
            die();
        }

        return $this->conn;
    }

    public function getmyDB()
    {
        if ($this->conn instanceof PDO) {
            return $this->conn;
        }
    }
}

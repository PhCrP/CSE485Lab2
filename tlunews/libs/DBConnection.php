<?php

class DBConnection
{
    private $DB_host;
    private $DB_user;
    private $DB_pass;
    private $DB_daba;
    private $DB_port;
    private $conn;

    public function __construct()
    {
        $this->DB_host = host;
        $this->DB_user = user;
        $this->DB_pass = pass;
        $this->DB_daba = daba;
        $this->DB_port = port;

        try {
            $conn = new PDO("mysql:host={$this->DB_host}};dbname={$this->DB_daba}", $this->DB_user, $this->DB_pass, [$this->DB_port]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo"skjdfbgujhsdbgjn";
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage() . "<br>";
        }
    }

    public function getCon(){
        return $this->conn;
    }

}

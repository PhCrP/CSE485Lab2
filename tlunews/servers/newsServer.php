<?php
require_once(APP_ROOT . "/libs/DBConnection.php");
class newsServer
{
    public function getAllNews()
    {
        $sqlAllNews = "SELECT * FROM news;";
        $DB_con = new DBConnection();
        $st = null;

        try {
            $con = $DB_con->getCon();
            $st = $con->prepare($sqlAllNews);
            $st->execute();

            $rs = $st->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage() . "<br>";
        } finally {
            try {
                $con = null;
                $st = null;
            } catch (PDOException $e) {
                echo "Lỗi: " . $e->getMessage() . "<br>";
            }
        }
    }
}

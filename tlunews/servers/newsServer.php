<?php

namespace App\servers;

use PDO;
use PDOException;
use App\libs\DBConnection;

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

    public function getAllNewsCate()
    {
        $sqlAllNewsCate = "SELECT n.id, title, content, name, image FROM news n INNER JOIN categories c WHERE n.category_id = c.id;";
        $DB_con = new DBConnection();
        $st = null;

        try {
            $con = $DB_con->getCon();
            $st = $con->prepare($sqlAllNewsCate);
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

    public function getNewsById($id)
    {
        // Kết nối cơ sở dữ liệu
        $DB_con = new DBConnection();

        $sql = "SELECT * FROM news WHERE id = :id";

        try {
            $conn = $DB_con->getCon();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $news = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($news) {
                return $news;
            } else {
                return null; // Trả về null nếu không tìm thấy tin tức
            }
        } catch (PDOException $e) {
            echo "Lỗi khi lấy tin tức: " . $e->getMessage();
            return null;
        }
    }


    public function createNews($title, $content, $images, $categoryId)
    {
        $sqlInsert = "INSERT INTO news (title, content, image, category_id) 
                      VALUES (:title, :content, :images, :categoryId)";
        $DB_con = new DBConnection();
        $st = null;
    
        try {
            $con = $DB_con->getCon();
            $st = $con->prepare($sqlInsert);
    
            $st->bindParam(":title", $title, PDO::PARAM_STR);
            $st->bindParam(":content", $content, PDO::PARAM_STR);
            $st->bindParam(":images", $images, PDO::PARAM_STR);
            $st->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
    
            $st->execute();
        } catch (PDOException $e) {
            echo "Lỗi khi thêm tin tức: " . $e->getMessage() . "<br>";
        } finally {
            try {
                $con = null;
                $st = null;
            } catch (PDOException $e) {
                echo "Lỗi khi đóng kết nối: " . $e->getMessage() . "<br>";
            }
        }
    }
    

    public function updateNews($idNews, $title, $content, $image, $idCate)
    {
        $sqlUp = "UPDATE news n SET title = :title, content = :content, category_id = :idCate, image = :image WHERE n.id = :idNews;";
        $DB_con = new DBConnection();
        $st = null;

        try {
            $con = $DB_con->getCon();
            $st = $con->prepare($sqlUp);
            $st->bindParam(":title", $title, PDO::PARAM_STR);
            $st->bindParam(":idNews", $idNews, PDO::PARAM_INT);
            $st->bindParam(":content", $content, PDO::PARAM_STR);
            $st->bindParam(":idCate", $idCate, PDO::PARAM_INT);
            $st->bindParam(":image", $image, PDO::PARAM_STR);
            
            $st->execute();

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

    public function deleteNews($idNews)
    {
        $sqlIst = "DELETE FROM news WHERE id = :idNews;";
        $DB_con = new DBConnection();
        $st = null;

        try {
            $con = $DB_con->getCon();
            $st = $con->prepare($sqlIst);
            $st->bindParam(":idNews", $idNews, PDO::PARAM_INT);
            $st->execute();
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

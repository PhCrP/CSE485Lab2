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


    public function createNews($title, $content, $image)
    { {
            $sqlIst = "INSERT INTO news(title, content, image) VALUES (:title, :content, :image);";
            $DB_con = new DBConnection();
            $st = null;

            try {
                $con = $DB_con->getCon();
                $st = $con->prepare($sqlIst);
                $st->bindParam(":title", $title);
                $st->bindParam(":content", $content);
                $st->bindParam(":image", $image);
                $st->execute();

                echo "Thêm thành công!";
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

    public function updateNews($title, $content, $image, $idNews)
    { {
            $sqlUp = "UPDATE news SET title = :title, content = :content, image = :image WHERE id = :idNews;";
            $DB_con = new DBConnection();
            $st = null;

            try {
                $con = $DB_con->getCon();
                $st = $con->prepare($sqlUp);
                $st->bindParam(":title", $title);
                $st->bindParam(":content", $content);
                $st->bindParam(":image", $image);
                $st->bindParam(":idNews", $idNews, PDO::PARAM_INT);
                $st->execute();

                echo "Update thành công!";
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

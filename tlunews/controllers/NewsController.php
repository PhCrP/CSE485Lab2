<?php

namespace App\controllers;

use App\servers\newsServer;

class NewsController
{
    public function index()
    {
        $newsModel = new newsServer();
        $newsList = $newsModel->getAllNews();
        include "views/admin/news/index.php";
    }

    public function detail()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        if ($id) {
            $newsModel = new newsServer();
            $news = $newsModel->getNewsById($id);
            include "views/news/detail.php";
        } else {
            echo "Bài viết không tồn tại.";
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $categoryId = $_POST['category_id'] ?? null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = "asset/image/";
                $imageName = basename($_FILES['image']['name']);
                $imagePath = $uploadDir . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $newsModel = new newsServer();
                    $newsModel->createNews($title, $content, $imageName, $categoryId);

                    header("Location: " . DOMAIN);
                    exit;
                } else {
                    echo "Không thể tải lên hình ảnh.";
                }
            } else {
                echo "Vui lòng chọn một hình ảnh.";
            }
        }
    }


    public function update()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        if ($id) {
            $newsModel = new newsServer();

            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;
            $image = $_POST['image'];
            $idNews = $_POST['id'];

            $newsModel->updateNews($id, $title, $content, $image, $categoryId);
            header("Location: " . DOMAIN);
            exit;
        } else {
            echo "Not update!!!";
        }
    }

    public function delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;
        if ($id) {
            $newsModel = new newsServer();
            $newsModel->deleteNews($id);
            header("Location: " . DOMAIN);
            exit;
        } else {
            echo "Bài viết không tồn tại.";
        }
    }
}

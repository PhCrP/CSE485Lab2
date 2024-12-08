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

    // public function add()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $title = $_POST['title'];
    //         $content = $_POST['content'];
    //         $image = $_POST['image'];
    //         $category_id = $_POST['category_id'];

    //         $newsModel = new newsServer();
    //         $newsModel->createNews($title, $content, $image, $category_id);
    //         header("Location: " . DOMAIN); 
    //         exit;
    //     }

    //     $categoryModel = new Category();
    //     $categories = $categoryModel->getAllCategories();
    //     include "views/admin/news/add.php";
    // }

    public function update()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        if ($id) {
            $newsModel = new newsServer();
            
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_POST['image'];
            $idNews = $_POST['id'];

            $newsModel->updateNews($title, $content, $image, $idNews);
            header("Location: " . DOMAIN); 
            exit;
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

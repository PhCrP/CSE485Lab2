<?php
class NewsController {
    public function index() {
        $newsModel = new News();
        $newsList = $newsModel->getAllNews();
        include "views/admin/news/index.php";
    }

    public function detail() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $newsModel = new News();
            $news = $newsModel->getNewsById($id);
            include "views/news/detail.php";
        } else {
            echo "Bài viết không tồn tại.";
        }
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_POST['image']; 
            $category_id = $_POST['category_id'];

            $newsModel = new News();
            $newsModel->createNews($title, $content, $image, $category_id);
            header("Location: index.php");
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        include "views/admin/news/add.php";
    }

    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $newsModel = new News();
            $news = $newsModel->getNewsById($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_POST['image']; 
            $category_id = $_POST['category_id'];

            $newsModel->updateNews($id, $title, $content, $image, $category_id);
            header("Location: index.php");
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        include "views/admin/news/edit.php";
    }

    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $newsModel = new News();
            $newsModel->deleteNews($id);
            header("Location: index.php");
        } else {
            echo "Bài viết không tồn tại.";
        }
    }
}
?>

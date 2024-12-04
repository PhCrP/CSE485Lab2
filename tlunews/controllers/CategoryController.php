<?php
class CategoryController {

    public function index() {
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        include "views/admin/categories/index.php";
    }

   
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $categoryModel = new Category();
            $categoryModel->createCategory($name);
            header("Location: index.php?controller=category&action=index");
        }
        include "views/admin/categories/add.php";
    }

   
    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $categoryModel = new Category();
            $category = $categoryModel->getCategoryById($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $categoryModel->updateCategory($id, $name);
            header("Location: index.php?controller=category&action=index");
        }

        include "views/admin/categories/edit.php";
    }

    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $categoryModel = new Category();
            $categoryModel->deleteCategory($id);
            header("Location: index.php?controller=category&action=index");
        } else {
            echo "Chuyên mục không tồn tại.";
        }
    }
}
?>

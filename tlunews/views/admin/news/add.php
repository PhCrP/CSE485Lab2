<?php

namespace App\views\admin\news;

require_once __DIR__ . '/../../../vendor/autoload.php';

use PDO;
use App\servers\newsServer;
use App\controllers\NewsController;

$newsController = new NewsController();
$newsServer = new newsServer();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;

    if ($categoryId === null || $categoryId <= 0) {
        echo "Vui lòng chọn danh mục hợp lệ.";
        exit;
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__  . "/../../../asset/image/";
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $newsServer->createNews($title, $content, $imageName, $categoryId);
            header("Location: " . DOMAIN);
            exit;
        } else {
            echo "Không thể tải lên hình ảnh.";
        }
    } else {
        echo "Vui lòng chọn một hình ảnh.";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <link rel="stylesheet" href="<?= DOMAIN . "asset/style/main.css"; ?>">
    <script src="<?= DOMAIN . "asset/js/bootstrap.bundle.min.js"; ?>"></script>
    <style>
        img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <h1>Add news</h1>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="content">Content:</label>
        <textarea name="content" id="content" required></textarea>

        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" required>
            <?php
            $dbCon = new \App\libs\DBConnection();
            $conn = $dbCon->getCon();
            $stmt = $conn->query("SELECT id, name FROM categories");
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $category) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select>


        <label for="image">Hình ảnh:</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit" name="add">Add news</button>
    </form>

</body>

</html>
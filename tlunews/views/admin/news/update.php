<?php

namespace App\views\admin\news;

require_once __DIR__ . '/../../../vendor/autoload.php';

use PDO;
use App\libs\DBConnection;
use App\servers\newsServer;
use App\controllers\NewsController;

$newsController = new NewsController();
$newsServer = new newsServer();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $news = $newsServer->getNewsById($id);
    if (!$news) {
        echo "Tin tức không tồn tại.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;

    if ($categoryId === null || $categoryId <= 0) {
        echo "Vui lòng chọn danh mục hợp lệ.";
        exit;
    }

    // Kiểm tra nếu có ảnh được tải lên
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . "/../../../asset/image/";
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        // Di chuyển file tải lên vào thư mục đích
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $image = $imageName; // Cập nhật tên ảnh mới
        } else {
            echo "Lỗi khi tải lên ảnh.";
            exit;
        }
    } else {
        $image = $_POST['old_image']; // Sử dụng ảnh cũ nếu không tải lên ảnh mới
    }

    $newsServer->updateNews($id, $title, $content, $image, $categoryId); // Hàm xử lý cập nhật tin tức
    header("Location: " . DOMAIN); // Quay lại danh sách tin tức
    exit;
} else {
    echo "Yêu cầu không hợp lệ.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật tin tức</title>
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
    <h1>Cập nhật tin tức</h1>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $news['id'] ?>">
        <input type="hidden" name="old_image" value="<?= $news['image'] ?>">

        <label for="title">Tiêu đề:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($news['title']) ?>" required><br>

        <label for="content">Nội dung:</label>
        <textarea id="content" name="content" required><?= htmlspecialchars($news['content']) ?></textarea><br>

        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" required>
            <?php
            $dbCon = new DBConnection();
            $conn = $dbCon->getCon();
            $stmt = $conn->query("SELECT id, name FROM categories");
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categories as $category) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select>

        <label for="image">Hình ảnh:</label>
        <input type="file" id="image" name="image" accept="asset/image/*" onchange="previewImage(event)"><br>

        <p>Ảnh hiện tại:</p>
        <img id="preview" src="<?= DOMAIN . "asset/image/" . $news['image']; ?>" alt="Preview" width="100"><br>



        <button type="submit">Cập nhật</button>
    </form>
    <a href="<?= DOMAIN ?>">Quay lại danh sách</a>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result; // Cập nhật src ảnh xem trước
                };

                reader.readAsDataURL(file); // Đọc file ảnh và chuyển đổi thành URL
            } else {
                preview.src = "<?= DOMAIN . 'asset/image/' . $news['image']; ?>"; // Quay về ảnh cũ nếu không chọn
            }
        }
    </script>

</body>

</html>
<?php
define("APP_ROOT", dirname(__FILE__, 4));
define("DOMAIN", "http://localhost:8080/");

define("host", "mysql");
define("user", "root");
define("pass", "123456789");
define("daba", "tintuc");
define("port", 3306);

require_once APP_ROOT . "/servers/newsServer.php";
require_once APP_ROOT . "/controllers/NewsController.php";

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
    $image = $_FILES['image']['name'];

    if (!empty($image)) {
        $targetDir = APP_ROOT . "/asset/image/";
        $targetFile = $targetDir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile); // Upload file ảnh mới
    } else {
        $image = $_POST['old_image']; // Giữ nguyên ảnh cũ nếu không chọn ảnh mới
    }

    $newsController->update($title, $content, $image, $id); // Hàm xử lý cập nhật tin tức
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

        <label for="image">Hình ảnh:</label>
        <input type="file" id="image" name="image"><br>
        <p>Ảnh hiện tại: <img src="<?= DOMAIN . "asset/image/" . $news['image']; ?>" alt="<?= $news['image']; ?>" width="100"></p>

        <button type="submit">Cập nhật</button>
    </form>
    <a href="<?= DOMAIN ?>">Quay lại danh sách</a>
</body>

</html>
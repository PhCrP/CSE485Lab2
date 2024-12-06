<?php

require_once APP_ROOT . "/servers/newsServer.php";
require_once APP_ROOT . "/controllers/NewsController.php";
$new = new newsServer();
$newsList = $new->getAllNews();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['delete'])) {
        $id = intval($_POST['id']);
        $newsModel = new newsServer();
        $newsModel->deleteNews($id);
    } else {
        echo "Bài viết không tồn tại.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= DOMAIN . "asset/style/main.css"; ?>">
    <script src="<?= DOMAIN . "asset/js/bootstrap.bundle.min.js"; ?>"></script>
</head>

<body>
    <h1>Danh sách tin tức</h1>
    <a href="<?= DOMAIN . "views/admin/news/add.php" ?>">Thêm mới tin tức</a>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($newsList as $news): ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?php echo $news['title']; ?></td>
                    <td>
                        <a href="index.php?controller=news&action=edit&id=<?= $news['id']; ?>">Sửa</a>
                    </td>
                    <td>
                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <input type="hidden" name="id" value="<?= $news['id'] ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>


</body>

</html>
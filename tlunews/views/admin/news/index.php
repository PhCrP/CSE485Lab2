<?php

namespace App\views\admin\news;

use App\servers\newsServer;
use App\controllers\NewsController;

$new = new newsServer();
$newsList = $new->getAllNewsCate();

$newsController = new NewsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $newsController->delete();
    }

    if (isset($_POST['update'])) {
        $newsController->update();
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
    <style>
        img{
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <h1>List News</h1>
    <a href="<?= DOMAIN . "views/admin/news/add.php" ?>">Add News</a>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Image</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($newsList as $news): ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $news['title']; ?></td>
                    <td><?= $news['content']; ?></td>
                    <td><?= $news['name']; ?></td>
                    <td><img class="imgs" src="<?= DOMAIN . "asset/image/" . $news['image']; ?>" alt="<?= $news['image']; ?>"></img></td>
                    <td>
                        <form action="<?= DOMAIN."views/admin/news/update.php" ?>" method="GET">
                            <input type="hidden" name="id" value="<?= $news['id'] ?>">
                            <button type="submit" name="update">Update</button>
                        </form>
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
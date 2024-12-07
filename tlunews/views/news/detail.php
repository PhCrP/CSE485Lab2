<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>

<body>
    <h1><?php echo $news['title']; ?></h1>
    <p><?php echo $news['content']; ?></p>
    <img src="<?php echo $news['image']; ?>" alt="Image">
</body>

</html>
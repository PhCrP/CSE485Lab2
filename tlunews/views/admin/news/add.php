<h1>Thêm mới tin tức</h1>
<form method="POST">
    <label for="title">Tiêu đề</label>
    <input type="text" name="title" id="title" required>
    
    <label for="content">Nội dung</label>
    <textarea name="content" id="content" required></textarea>
    
    <label for="image">Ảnh</label>
    <input type="text" name="image" id="image">

    <label for="category_id">Chuyên mục</label>
    <select name="category_id" id="category_id">
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Thêm</button>
</form>

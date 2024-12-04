<h1>Danh sách chuyên mục</h1>
<a href="index.php?controller=category&action=add">Thêm mới chuyên mục</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên chuyên mục</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category['id']; ?></td>
                <td><?php echo $category['name']; ?></td>
                <td>
                    <a href="index.php?controller=category&action=edit&id=<?php echo $category['id']; ?>">Sửa</a>
                    <a href="index.php?controller=category&action=delete&id=<?php echo $category['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

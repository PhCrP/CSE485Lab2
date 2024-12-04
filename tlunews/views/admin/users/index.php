<h1>Danh sách người dùng</h1>
<a href="index.php?controller=user&action=add">Thêm mới người dùng</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Vai trò</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['role'] == 0 ? 'Người dùng' : 'Quản trị viên'; ?></td>
                <td>
                    <a href="index.php?controller=user&action=edit&id=<?php echo $user['id']; ?>">Sửa</a>
                    <a href="index.php?controller=user&action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

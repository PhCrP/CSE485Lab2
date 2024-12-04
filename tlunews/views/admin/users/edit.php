<h1>Sửa người dùng</h1>
<form method="POST">
    <label for="username">Tên người dùng</label>
    <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" required>

    <label for="password">Mật khẩu</label>
    <input type="password" name="password" id="password" required>

    <label for="role">Vai trò</label>
    <select name="role" id="role" required>
        <option value="0" <?php echo $user['role'] == 0 ? 'selected' : ''; ?>>Người dùng</option>
        <option value="1" <?php echo $user['role'] == 1 ? 'selected' : ''; ?>>Quản trị viên</option>
    </select>

    <button type="submit">Cập nhật</button>
</form>

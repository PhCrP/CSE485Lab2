<h1>Thêm người dùng mới</h1>
<form method="POST">
    <label for="username">Tên người dùng</label>
    <input type="text" name="username" id="username" required>

    <label for="password">Mật khẩu</label>
    <input type="password" name="password" id="password" required>

    <label for="role">Vai trò</label>
    <select name="role" id="role" required>
        <option value="0">Người dùng</option>
        <option value="1">Quản trị viên</option>
    </select>

    <button type="submit">Thêm</button>
</form>

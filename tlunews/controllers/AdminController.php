<?php
class UserController {
    // Xem danh sách người dùng
    public function index() {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        include "views/admin/users/index.php";
    }

    // Thêm người dùng mới
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu
            $role = $_POST['role'];

            $userModel = new User();
            $userModel->createUser($username, $password, $role);
            header("Location: index.php?controller=user&action=index");
        }
        include "views/admin/users/add.php";
    }

    // Sửa người dùng
    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $userModel = new User();
            $user = $userModel->getUserById($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu
            $role = $_POST['role'];

            $userModel->updateUser($id, $username, $password, $role);
            header("Location: index.php?controller=user&action=index");
        }

        include "views/admin/users/edit.php";
    }

    // Xóa người dùng
    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $userModel = new User();
            $userModel->deleteUser($id);
            header("Location: index.php?controller=user&action=index");
        } else {
            echo "Người dùng không tồn tại.";
        }
    }
}
?>

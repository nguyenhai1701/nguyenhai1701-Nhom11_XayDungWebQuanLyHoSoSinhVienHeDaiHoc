<?php
session_start();
require_once __DIR__ . '/../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, mat_khau, vai_tro FROM NguoiDung WHERE ten_dang_nhap = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['mat_khau']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['vai_tro'];
            $_SESSION['username'] = $username;

            if ($user['vai_tro'] === 'admin') {
                // Sửa đường dẫn tuyệt đối tại đây
                header("Location: http://localhost/khmt1701/index.php?page=manage_students");
            } else if ($user['vai_tro'] === 'student') {
                header("Location: http://localhost/khmt1701/index.php?page=student_profile");
            }
            exit();
        } else {
            $_SESSION['login_error'] = "Tên đăng nhập hoặc mật khẩu không đúng.";
            header("Location: http://localhost/khmt1701/index.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Tên đăng nhập hoặc mật khẩu không đúng.";
        header("Location: http://localhost/khmt1701/index.php");
        exit();
    }
}
?>
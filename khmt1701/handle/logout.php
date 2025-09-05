<?php
// Bắt đầu phiên làm việc
session_start();

// Hủy toàn bộ các biến trong phiên
$_SESSION = array();

// Nếu phiên làm việc được quản lý bằng cookie, hãy xóa cookie phiên làm việc đó
// Lưu ý: Thao tác này sẽ hủy cả cookie phiên làm việc, không chỉ dữ liệu session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hủy phiên làm việc
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập
header("Location: ../index.php");
exit;
?>
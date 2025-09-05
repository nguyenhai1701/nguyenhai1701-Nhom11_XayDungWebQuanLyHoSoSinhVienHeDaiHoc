<?php
session_start();
require_once '../functions/db_connect.php';

if (isset($_GET['ma_sv'])) {
    $ma_sv = $_GET['ma_sv'];

    // Chuẩn bị câu lệnh SQL để xóa sinh viên
    $sql = "DELETE FROM SinhVien WHERE ma_sinh_vien = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ma_sv);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Xóa sinh viên thành công!";
    } else {
        $_SESSION['error'] = "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
// Chuyển hướng về trang quản lý sinh viên
header("Location: ../index.php?page=manage_students");
exit();
?>
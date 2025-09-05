<?php
session_start();
require_once __DIR__ . '/../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Xử lý thêm lớp mới
    if ($action == 'add') {
        $ten_lop = $_POST['ten_lop'];
        $id_khoa = $_POST['id_khoa'];
        
        $sql = "INSERT INTO Lop (ten_lop, id_khoa) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
             $_SESSION['error'] = "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        } else {
            $stmt->bind_param("si", $ten_lop, $id_khoa);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Thêm lớp thành công!";
            } else {
                $_SESSION['error'] = "Lỗi: " . $stmt->error;
            }
        }
    }
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Xử lý xóa lớp
    if ($action == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "DELETE FROM Lop WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $_SESSION['error'] = "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        } else {
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Xóa lớp thành công!";
            } else {
                $_SESSION['error'] = "Lỗi: " . $stmt->error;
            }
        }
    }
}

// Chuyển hướng người dùng về trang quản lý lớp
header("Location: ../index.php?page=manage_classes");
exit();
?>
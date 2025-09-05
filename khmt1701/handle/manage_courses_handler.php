<?php
session_start();
require_once __DIR__ . '/../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $ma_mon_hoc = $_POST['ma_mon_hoc'];
        $ten_mon_hoc = $_POST['ten_mon_hoc'];
        $so_tin_chi = $_POST['so_tin_chi'];
        
        $sql = "INSERT INTO MonHoc (ma_mon_hoc, ten_mon_hoc, so_tin_chi) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
             $_SESSION['error'] = "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        } else {
            $stmt->bind_param("ssi", $ma_mon_hoc, $ten_mon_hoc, $so_tin_chi);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Thêm môn học thành công!";
            } else {
                $_SESSION['error'] = "Lỗi: " . $stmt->error;
            }
        }
    }
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM MonHoc WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $_SESSION['error'] = "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        } else {
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Xóa môn học thành công!";
            } else {
                $_SESSION['error'] = "Lỗi: " . $stmt->error;
            }
        }
    }
}

$conn->close();
header("Location: ../index.php?page=manage_courses");
exit();
?>
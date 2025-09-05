<?php
session_start();
require_once __DIR__ . '/../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $id_sinh_vien = $_POST['id_sinh_vien'];
        $id_mon_hoc = $_POST['id_mon_hoc'];
        $diem = $_POST['diem'];
        $hoc_ky = $_POST['hoc_ky'];
        $nam_hoc = $_POST['nam_hoc'];
        
        $sql = "INSERT INTO DiemSo (id_sinh_vien, id_mon_hoc, diem, hoc_ky, nam_hoc) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
             $_SESSION['error'] = "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        } else {
            $stmt->bind_param("iidss", $id_sinh_vien, $id_mon_hoc, $diem, $hoc_ky, $nam_hoc);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Thêm điểm thành công!";
            } else {
                $_SESSION['error'] = "Lỗi: " . $stmt->error;
            }
        }
    }
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM DiemSo WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $_SESSION['error'] = "Lỗi chuẩn bị câu lệnh: " . $conn->error;
        } else {
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Xóa điểm thành công!";
            } else {
                $_SESSION['error'] = "Lỗi: " . $stmt->error;
            }
        }
    }
}

$conn->close();
header("Location: ../index.php?page=manage_grades");
exit();
?>
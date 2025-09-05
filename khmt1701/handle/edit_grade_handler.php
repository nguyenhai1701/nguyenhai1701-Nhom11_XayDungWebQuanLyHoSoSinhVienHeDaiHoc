<?php
session_start();
require_once '../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $diem = $_POST['diem'];
    $hoc_ky = $_POST['hoc_ky'];
    $nam_hoc = $_POST['nam_hoc'];
    
    $sql = "UPDATE DiemSo SET diem = ?, hoc_ky = ?, nam_hoc = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $_SESSION['error'] = "Lỗi chuẩn bị câu lệnh: " . $conn->error;
    } else {
        $stmt->bind_param("dssi", $diem, $hoc_ky, $nam_hoc, $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Cập nhật điểm thành công!";
        } else {
            $_SESSION['error'] = "Lỗi: " . $stmt->error;
        }
    }
    
    $stmt->close();
}

$conn->close();
header("Location: ../index.php?page=manage_grades");
exit();
?>
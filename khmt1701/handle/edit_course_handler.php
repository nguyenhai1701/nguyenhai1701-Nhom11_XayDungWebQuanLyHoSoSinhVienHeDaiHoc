<?php
session_start();
require_once '../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $ma_mon_hoc = $_POST['ma_mon_hoc'];
    $ten_mon_hoc = $_POST['ten_mon_hoc'];
    $so_tin_chi = $_POST['so_tin_chi'];
    
    $sql = "UPDATE MonHoc SET ma_mon_hoc = ?, ten_mon_hoc = ?, so_tin_chi = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $_SESSION['error'] = "Lỗi chuẩn bị câu lệnh: " . $conn->error;
    } else {
        $stmt->bind_param("ssii", $ma_mon_hoc, $ten_mon_hoc, $so_tin_chi, $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Cập nhật môn học thành công!";
        } else {
            $_SESSION['error'] = "Lỗi: " . $stmt->error;
        }
    }
    
    $stmt->close();
}

$conn->close();
header("Location: ../index.php?page=manage_courses");
exit();
?>
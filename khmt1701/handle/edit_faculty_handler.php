<?php
session_start();
require_once '../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $ten_khoa = $_POST['ten_khoa'];
    
    $sql = "UPDATE Khoa SET ten_khoa = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $ten_khoa, $id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Cập nhật khoa thành công!";
    } else {
        $_SESSION['error'] = "Lỗi: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
header("Location: ../index.php?page=manage_faculties");
exit();
?>
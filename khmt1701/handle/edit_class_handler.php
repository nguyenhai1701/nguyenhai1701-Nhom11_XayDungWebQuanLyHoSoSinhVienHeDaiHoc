<?php
session_start();
require_once '../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $ten_lop = $_POST['ten_lop'];
    $id_khoa = $_POST['id_khoa'];

    $sql = "UPDATE Lop SET ten_lop = ?, id_khoa = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $ten_lop, $id_khoa, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Cập nhật lớp thành công!";
    } else {
        $_SESSION['error'] = "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: ../index.php?page=manage_classes");
exit();
?>
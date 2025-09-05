<?php
session_start();
require_once __DIR__ . '/../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $ten_khoa = $_POST['ten_khoa'];
        $sql = "INSERT INTO Khoa (ten_khoa) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ten_khoa);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Thêm khoa thành công!";
        } else {
            $_SESSION['error'] = "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM Khoa WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Xóa khoa thành công!";
        } else {
            $_SESSION['error'] = "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
header("Location: ../index.php?page=manage_faculties");
exit();
?>
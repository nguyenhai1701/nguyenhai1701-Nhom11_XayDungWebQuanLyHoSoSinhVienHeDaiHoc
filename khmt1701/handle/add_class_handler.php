<?php
session_start();
require_once __DIR__ . '/../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_lop = $_POST['ten_lop'];
    $id_khoa = $_POST['id_khoa'];

    if (!empty($ten_lop) && !empty($id_khoa)) {
        $sql = "INSERT INTO lop (ten_lop, id_khoa) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $ten_lop, $id_khoa);

        if ($stmt->execute()) {
            // Thêm thành công, chuyển hướng về trang quản lý lớp
            header("Location: ../index.php?page=manage_classes");
            exit();
        } else {
            // Xử lý lỗi
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Vui lòng điền đầy đủ thông tin.";
    }
}
?>
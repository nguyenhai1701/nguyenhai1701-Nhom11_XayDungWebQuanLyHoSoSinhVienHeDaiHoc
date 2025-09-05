<?php
session_start();
require_once '../functions/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_sv_original = $_POST['ma_sv_original']; // Mã SV gốc để tìm sinh viên cần sửa
    $ma_sv = $_POST['ma_sv'];
    $ho_ten = $_POST['ho_ten'];
    $ngaysinh = $_POST['ngaysinh'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $email = $_POST['email'];
    $dien_thoai = $_POST['dien_thoai'];
    $dia_chi = $_POST['dia_chi'];
    $ten_lop = $_POST['ten_lop'];

    // Bước 1: Kiểm tra và lấy id_lop từ ten_lop
    $sql_check_class = "SELECT id FROM Lop WHERE ten_lop = ?";
    $stmt_check = $conn->prepare($sql_check_class);
    $stmt_check->bind_param("s", $ten_lop);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    $id_lop = null;
    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $id_lop = $row['id'];
    } else {
        // Nếu lớp chưa tồn tại, thêm lớp mới vào database
        $sql_insert_class = "INSERT INTO Lop (ten_lop) VALUES (?)";
        $stmt_insert = $conn->prepare($sql_insert_class);
        $stmt_insert->bind_param("s", $ten_lop);
        
        if ($stmt_insert->execute()) {
            $id_lop = $conn->insert_id;
        } else {
            $_SESSION['error'] = "Error adding class: " . $stmt_insert->error;
            header("Location: ../index.php?page=manage_students");
            exit();
        }
        $stmt_insert->close();
    }
    $stmt_check->close();

    // Bước 2: Cập nhật thông tin sinh viên
    $sql = "UPDATE SinhVien SET 
                ma_sinh_vien = ?,
                ho_ten = ?,
                ngaysinh = ?,
                gioi_tinh = ?,
                email = ?,
                dien_thoai = ?,
                dia_chi = ?,
                id_lop = ?
            WHERE ma_sinh_vien = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
    }
    
    $stmt->bind_param("sssssssis", $ma_sv, $ho_ten, $ngaysinh, $gioi_tinh, $email, $dien_thoai, $dia_chi, $id_lop, $ma_sv_original);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Cập nhật sinh viên thành công!";
    } else {
        $_SESSION['error'] = "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: ../index.php?page=manage_students");
exit();
?>
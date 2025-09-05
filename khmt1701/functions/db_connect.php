<?php

// Thông tin kết nối CSDL
$servername = "localhost";
$username = "root"; 
$password = "duydeptrai001";
$dbname = "quanlyhososinhvien"; 

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

// Thiết lập bộ ký tự UTF-8
$conn->set_charset("utf8mb4");

?>
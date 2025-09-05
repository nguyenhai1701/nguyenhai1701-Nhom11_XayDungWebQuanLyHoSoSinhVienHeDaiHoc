<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ Sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .profile-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .profile-table td, .profile-table th {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .profile-table th {
            background-color: #f2f2f2;
            width: 30%;
        }
        .profile-actions {
            margin-top: 20px;
        }
        .profile-actions a {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .profile-actions a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Hồ sơ Sinh viên</h1>
    <a href="handle/logout.php" class="logout-link">Đăng xuất</a>
</div>

<div class="main-container">
    <div class="content">
        <?php
        require_once 'functions/db_connect.php';

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            // Lấy id_sinh_vien từ bảng NguoiDung
            $sql_user = "SELECT id_sinh_vien FROM NguoiDung WHERE id = ?";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->bind_param("i", $user_id);
            $stmt_user->execute();
            $result_user = $stmt_user->get_result();

            if ($result_user->num_rows > 0) {
                $row_user = $result_user->fetch_assoc();
                $id_sinh_vien = $row_user['id_sinh_vien'];

                // Truy vấn thông tin sinh viên bằng JOIN
                $sql_student = "SELECT sv.ma_sinh_vien, sv.ho_ten, sv.ngay_sinh, sv.gioi_tinh, sv.dia_chi, sv.dien_thoai, sv.email, l.ten_lop, k.ten_khoa 
                                FROM SinhVien sv
                                LEFT JOIN Lop l ON sv.id_lop = l.id
                                LEFT JOIN Khoa k ON l.id_khoa = k.id
                                WHERE sv.id = ?";
                $stmt_student = $conn->prepare($sql_student);
                $stmt_student->bind_param("i", $id_sinh_vien);
                $stmt_student->execute();
                $result_student = $stmt_student->get_result();

                if ($result_student->num_rows > 0) {
                    $student = $result_student->fetch_assoc();
        ?>
        <h2>Chào mừng, <?php echo htmlspecialchars($student['ho_ten']); ?>!</h2>
        <p>Đây là trang hồ sơ của bạn. Bạn có thể xem thông tin cá nhân và điểm số tại đây.</p>
        
        <div class="profile-actions">
            <a href="index.php?page=student_grades">Xem bảng điểm</a>
        </div>
        
        <table class="profile-table">
            <tr>
                <th>Mã số sinh viên</th>
                <td><?php echo htmlspecialchars($student['ma_sinh_vien']); ?></td>
            </tr>
            <tr>
                <th>Họ và tên</th>
                <td><?php echo htmlspecialchars($student['ho_ten']); ?></td>
            </tr>
            <tr>
                <th>Ngày sinh</th>
                <td><?php echo htmlspecialchars($student['ngay_sinh']); ?></td>
            </tr>
            <tr>
                <th>Giới tính</th>
                <td><?php echo htmlspecialchars($student['gioi_tinh']); ?></td>
            </tr>
            <tr>
                <th>Lớp</th>
                <td><?php echo htmlspecialchars($student['ten_lop']); ?></td>
            </tr>
            <tr>
                <th>Khoa</th>
                <td><?php echo htmlspecialchars($student['ten_khoa']); ?></td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td><?php echo htmlspecialchars($student['dia_chi']); ?></td>
            </tr>
            <tr>
                <th>Điện thoại</th>
                <td><?php echo htmlspecialchars($student['dien_thoai']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($student['email']); ?></td>
            </tr>
        </table>

        <?php
                } else {
                    echo "<p>Không tìm thấy hồ sơ sinh viên.</p>";
                }
            } else {
                echo "<p>Lỗi: Không tìm thấy ID sinh viên liên kết.</p>";
            }
        } else {
            echo "<p>Vui lòng đăng nhập để xem hồ sơ.</p>";
        }
        ?>
    </div>
</div>

<div class="footer">
    Hệ thống Quản lý Hồ sơ Sinh viên Đại học
</div>

</body>
</html>
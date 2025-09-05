<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điểm Sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .grades-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .grades-table td, .grades-table th {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .grades-table th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Bảng điểm Sinh viên</h1>
    <a href="handle/logout.php" class="logout-link">Đăng xuất</a>
</div>

<div class="main-container">
    <div class="content">
        <h2>Bảng điểm của bạn</h2>
        <a href="index.php?page=student_profile" class="back-link">&lt;&lt; Quay lại hồ sơ</a>
        
        <?php
        require_once 'functions/db_connect.php';

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $sql_user = "SELECT id_sinh_vien FROM NguoiDung WHERE id = ?";
            $stmt_user = $conn->prepare($sql_user);
            $stmt_user->bind_param("i", $user_id);
            $stmt_user->execute();
            $result_user = $stmt_user->get_result();

            if ($result_user->num_rows > 0) {
                $row_user = $result_user->fetch_assoc();
                $id_sinh_vien = $row_user['id_sinh_vien'];

                $sql_grades = "SELECT mh.ma_mon_hoc, mh.ten_mon_hoc, ds.diem, ds.hoc_ky, ds.nam_hoc 
                               FROM DiemSo ds
                               JOIN MonHoc mh ON ds.id_mon_hoc = mh.id
                               WHERE ds.id_sinh_vien = ?
                               ORDER BY ds.nam_hoc DESC, ds.hoc_ky DESC";
                $stmt_grades = $conn->prepare($sql_grades);
                $stmt_grades->bind_param("i", $id_sinh_vien);
                $stmt_grades->execute();
                $result_grades = $stmt_grades->get_result();

                if ($result_grades->num_rows > 0) {
        ?>
        <table class="grades-table">
            <thead>
                <tr>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Điểm</th>
                    <th>Học kỳ</th>
                    <th>Năm học</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result_grades->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['ma_mon_hoc']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ten_mon_hoc']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['diem']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['hoc_ky']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nam_hoc']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
                } else {
                    echo "<p>Bạn chưa có điểm số nào.</p>";
                }
            } else {
                echo "<p>Lỗi: Không tìm thấy ID sinh viên liên kết.</p>";
            }
        } else {
            echo "<p>Vui lòng đăng nhập để xem bảng điểm.</p>";
        }
        ?>
    </div>
</div>

<div class="footer">
    Hệ thống Quản lý Hồ sơ Sinh viên Đại học
</div>

</body>
</html>
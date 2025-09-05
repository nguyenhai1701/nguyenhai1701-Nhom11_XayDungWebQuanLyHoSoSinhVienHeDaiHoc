<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin Sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-buttons {
            text-align: center;
        }
        .form-buttons button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-buttons a {
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Bảng điều khiển Quản trị viên</h1>
    <a href="handle/logout.php" class="logout-link">Đăng xuất</a>
</div>

<div class="main-container">
    <div class="sidebar">
        <a href="index.php?page=admin_dashboard">Trang chính</a>
        <a href="index.php?page=manage_students">Quản lý Sinh viên</a>
        <a href="index.php?page=manage_classes">Quản lý Lớp</a>
        <a href="index.php?page=manage_faculties">Quản lý Khoa</a>
        <a href="index.php?page=manage_courses">Quản lý Môn học</a>
        <a href="index.php?page=manage_grades">Quản lý Điểm</a>
    </div>

    <div class="content">
        <?php
        require_once 'functions/db_connect.php';

        $student = null;
        $lop = null;
        $khoa = null;

        if (isset($_GET['ma_sv'])) {
            $ma_sv = $_GET['ma_sv'];
            $sql = "SELECT s.*, l.ten_lop, k.ten_khoa 
                    FROM SinhVien s
                    LEFT JOIN Lop l ON s.id_lop = l.id
                    LEFT JOIN Khoa k ON l.id_khoa = k.id
                    WHERE s.ma_sinh_vien = ?";
            
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Lỗi chuẩn bị câu lệnh: " . $conn->error);
            }
            $stmt->bind_param("s", $ma_sv);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
            } else {
                echo "<p>Không tìm thấy sinh viên.</p>";
            }
            $stmt->close();
        }

        if ($student) {
        ?>
            <div class="form-container">
                <h2>Sửa thông tin Sinh viên</h2>
                <form action="handle/edit_student_handler.php" method="POST">
                    <input type="hidden" name="ma_sv_original" value="<?php echo htmlspecialchars($student['ma_sinh_vien']); ?>">
                    <div class="form-group">
                        <label for="ma_sv">Mã số sinh viên:</label>
                        <input type="text" id="ma_sv" name="ma_sv" value="<?php echo htmlspecialchars($student['ma_sinh_vien']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ho_ten">Họ và tên:</label>
                        <input type="text" id="ho_ten" name="ho_ten" value="<?php echo htmlspecialchars($student['ho_ten']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ngaysinh">Ngày sinh:</label>
                        <input type="date" id="ngaysinh" name="ngaysinh" value="<?php echo htmlspecialchars($student['ngaysinh']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="gioi_tinh">Giới tính:</label>
                        <select id="gioi_tinh" name="gioi_tinh">
                            <option value="Nam" <?php echo ($student['gioi_tinh'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                            <option value="Nữ" <?php echo ($student['gioi_tinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                            <option value="Khác" <?php echo ($student['gioi_tinh'] == 'Khác') ? 'selected' : ''; ?>>Khác</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="dien_thoai">Điện thoại:</label>
                        <input type="text" id="dien_thoai" name="dien_thoai" value="<?php echo htmlspecialchars($student['dien_thoai']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="dia_chi">Địa chỉ:</label>
                        <input type="text" id="dia_chi" name="dia_chi" value="<?php echo htmlspecialchars($student['dia_chi']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ten_lop">Tên lớp:</label>
                        <input type="text" id="ten_lop" name="ten_lop" value="<?php echo htmlspecialchars($student['ten_lop']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ten_khoa">Khoa:</label>
                        <select id="ten_khoa" name="ten_khoa">
                            <?php
                            $sql_faculties = "SELECT id, ten_khoa FROM Khoa";
                            $result_faculties = $conn->query($sql_faculties);
                            if ($result_faculties->num_rows > 0) {
                                while($row = $result_faculties->fetch_assoc()) {
                                    $selected = ($row['ten_khoa'] == $student['ten_khoa']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($row['ten_khoa']) . "' " . $selected . ">" . htmlspecialchars($row['ten_khoa']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>Chưa có khoa nào</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-buttons">
                        <button type="submit">Cập nhật</button>
                        <a href="index.php?page=manage_students">Hủy</a>
                    </div>
                </form>
            </div>
        <?php
        }
        $conn->close();
        ?>
    </div>
</div>

<div class="footer">
    Hệ thống Quản lý Hồ sơ Sinh viên Đại học
</div>

</body>
</html>
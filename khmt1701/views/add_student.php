<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh viên</title>
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
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
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
        <div class="form-container">
            <h2>Thêm Sinh viên mới</h2>
            <form action="handle/add_student_handler.php" method="POST">
                <div class="form-group">
                    <label for="ma_sv">Mã số sinh viên:</label>
                    <input type="text" id="ma_sv" name="ma_sv" required>
                </div>
                <div class="form-group">
                    <label for="ho_ten">Họ và tên:</label>
                    <input type="text" id="ho_ten" name="ho_ten" required>
                </div>
                <div class="form-group">
                    <label for="ngaysinh">Ngày sinh:</label>
                    <input type="date" id="ngaysinh" name="ngaysinh">
                </div>
                <div class="form-group">
                    <label for="gioi_tinh">Giới tính:</label>
                    <select id="gioi_tinh" name="gioi_tinh">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="dien_thoai">Điện thoại:</label>
                    <input type="text" id="dien_thoai" name="dien_thoai">
                </div>
                <div class="form-group">
                    <label for="dia_chi">Địa chỉ:</label>
                    <input type="text" id="dia_chi" name="dia_chi">
                </div>
                <div class="form-group">
                    <label for="ten_lop">Tên lớp:</label>
                    <input type="text" id="ten_lop" name="ten_lop" required>
                </div>
                <div class="form-group">
                    <label for="id_khoa">Khoa:</label>
                    <select id="id_khoa" name="id_khoa">
                        <?php
                        require_once 'functions/db_connect.php';
                        $sql_faculties = "SELECT id, ten_khoa FROM Khoa";
                        $result_faculties = $conn->query($sql_faculties);
                        if ($result_faculties->num_rows > 0) {
                            while($row = $result_faculties->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['ten_khoa'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Chưa có khoa nào</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-buttons">
                    <button type="submit">Thêm Sinh viên</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="footer">
    Hệ thống Quản lý Hồ sơ Sinh viên Đại học
</div>

</body>
</html>
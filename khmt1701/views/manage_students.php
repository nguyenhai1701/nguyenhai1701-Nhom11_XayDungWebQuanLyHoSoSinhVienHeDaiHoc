<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Quản trị viên</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link text-white">Chào mừng, <?php echo $_SESSION['username']; ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm text-white ms-2" href="handle/logout.php">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="index.php?page=admin_dashboard" class="list-group-item list-group-item-action">Trang chính</a>
                <a href="index.php?page=manage_students" class="list-group-item list-group-item-action active">Quản lý Sinh viên</a>
                <a href="index.php?page=manage_classes" class="list-group-item list-group-item-action">Quản lý Lớp</a>
                <a href="index.php?page=manage_faculties" class="list-group-item list-group-item-action">Quản lý Khoa</a>
                <a href="index.php?page=manage_courses" class="list-group-item list-group-item-action">Quản lý Môn học</a>
                <a href="index.php?page=manage_grades" class="list-group-item list-group-item-action">Quản lý Điểm</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card p-4">
                <h2 class="card-title text-primary text-center">Quản lý Sinh viên</h2>
                
                <div class="d-flex justify-content-end mb-3">
                    <a href="index.php?page=add_student" class="btn btn-success">Thêm Sinh viên mới</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Mã SV</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Lớp</th>
                                <th>Khoa</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT s.ma_sinh_vien, s.ho_ten, s.gioi_tinh, s.ngaysinh, l.ten_lop, k.ten_khoa 
                                    FROM SinhVien s
                                    LEFT JOIN Lop l ON s.id_lop = l.id
                                    LEFT JOIN Khoa k ON l.id_khoa = k.id";
                            
                            $result = $conn->query($sql);
                            
                            if ($result === false) {
                                echo "<tr><td colspan='7'>Lỗi truy vấn: " . $conn->error . "</td></tr>";
                            } else if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['ma_sinh_vien']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['ho_ten']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['gioi_tinh']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['ngaysinh']) . "</td>";
                                    echo "<td>" . ($row['ten_lop'] ?? 'N/A') . "</td>";
                                    echo "<td>" . ($row['ten_khoa'] ?? 'N/A') . "</td>";
                                    echo "<td class='action-buttons'>";
                                    echo "<a href='index.php?page=edit_student&ma_sv=" . htmlspecialchars($row['ma_sinh_vien']) . "' class='btn btn-warning btn-sm me-2'>Sửa</a>";
                                    echo "<a href='handle/delete_student.php?ma_sv=" . htmlspecialchars($row['ma_sinh_vien']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Chưa có sinh viên nào trong hệ thống.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="mt-5 p-3 bg-light text-center">
    <p class="mb-0">Hệ thống Quản lý Hồ sơ Sinh viên Đại học</p>
</footer>

</body>
</html>
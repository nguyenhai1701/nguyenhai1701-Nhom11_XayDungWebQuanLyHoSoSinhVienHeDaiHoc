<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Điểm</title>
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
                <a href="index.php?page=manage_students" class="list-group-item list-group-item-action">Quản lý Sinh viên</a>
                <a href="index.php?page=manage_classes" class="list-group-item list-group-item-action">Quản lý Lớp</a>
                <a href="index.php?page=manage_faculties" class="list-group-item list-group-item-action">Quản lý Khoa</a>
                <a href="index.php?page=manage_courses" class="list-group-item list-group-item-action">Quản lý Môn học</a>
                <a href="index.php?page=manage_grades" class="list-group-item list-group-item-action active">Quản lý Điểm</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card p-4">
                <h2 class="card-title text-primary text-center">Quản lý Điểm</h2>
                
                <div class="form-container mb-4">
                    <h3 class="text-center text-secondary">Nhập Điểm mới</h3>
                    <form action="handle/manage_grades_handler.php" method="POST">
                        <input type="hidden" name="action" value="add">
                        <div class="mb-3">
                            <label for="ma_sinh_vien" class="form-label">Chọn Sinh viên:</label>
                            <select class="form-select" id="ma_sinh_vien" name="id_sinh_vien" required>
                                <option value="">-- Chọn sinh viên --</option>
                                <?php
                                require_once __DIR__ . '/../functions/db_connect.php';
                                $sql_sv = "SELECT id, ma_sinh_vien, ho_ten FROM SinhVien ORDER BY ho_ten";
                                $result_sv = $conn->query($sql_sv);
                                while($row_sv = $result_sv->fetch_assoc()) {
                                    echo "<option value='". $row_sv['id'] ."'>". htmlspecialchars($row_sv['ma_sinh_vien']) ." - ". htmlspecialchars($row_sv['ho_ten']) ."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ma_mon_hoc" class="form-label">Chọn Môn học:</label>
                            <select class="form-select" id="ma_mon_hoc" name="id_mon_hoc" required>
                                <option value="">-- Chọn môn học --</option>
                                <?php
                                $sql_mh = "SELECT id, ma_mon_hoc, ten_mon_hoc FROM MonHoc ORDER BY ten_mon_hoc";
                                $result_mh = $conn->query($sql_mh);
                                while($row_mh = $result_mh->fetch_assoc()) {
                                    echo "<option value='". $row_mh['id'] ."'>". htmlspecialchars($row_mh['ma_mon_hoc']) ." - ". htmlspecialchars($row_mh['ten_mon_hoc']) ."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="diem" class="form-label">Điểm:</label>
                            <input type="number" class="form-control" id="diem" name="diem" step="0.01" min="0" max="10" required>
                        </div>
                        <div class="mb-3">
                            <label for="hoc_ky" class="form-label">Học kỳ:</label>
                            <input type="text" class="form-control" id="hoc_ky" name="hoc_ky" required>
                        </div>
                        <div class="mb-3">
                            <label for="nam_hoc" class="form-label">Năm học:</label>
                            <input type="text" class="form-control" id="nam_hoc" name="nam_hoc" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Lưu Điểm</button>
                        </div>
                    </form>
                </div>

                <div class="table-container mt-4">
                    <h3 class="text-secondary text-center">Danh sách Điểm đã nhập</h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Mã Sinh viên</th>
                                <th>Tên Sinh viên</th>
                                <th>Mã Môn học</th>
                                <th>Tên Môn học</th>
                                <th>Điểm</th>
                                <th>Học kỳ</th>
                                <th>Năm học</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_diem = "SELECT 
                                d.id, 
                                sv.ma_sinh_vien, 
                                sv.ho_ten, 
                                mh.ma_mon_hoc, 
                                mh.ten_mon_hoc, 
                                d.diem, 
                                d.hoc_ky, 
                                d.nam_hoc 
                                FROM DiemSo d
                                INNER JOIN SinhVien sv ON d.id_sinh_vien = sv.id
                                INNER JOIN MonHoc mh ON d.id_mon_hoc = mh.id
                                ORDER BY sv.ho_ten, mh.ten_mon_hoc";
                            $result_diem = $conn->query($sql_diem);
                            if ($result_diem->num_rows > 0) {
                                while($row_diem = $result_diem->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row_diem['ma_sinh_vien']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row_diem['ho_ten']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row_diem['ma_mon_hoc']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row_diem['ten_mon_hoc']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row_diem['diem']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row_diem['hoc_ky']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row_diem['nam_hoc']) . "</td>";
                                    echo "<td>";
                                    echo "<a href='index.php?page=edit_grade&id=" . $row_diem['id'] . "' class='btn btn-warning btn-sm me-2'>Sửa</a>";
                                    echo "<a href='handle/manage_grades_handler.php?action=delete&id=" . $row_diem['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>Chưa có điểm số nào trong hệ thống.</td></tr>";
                            }
                            $conn->close();
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
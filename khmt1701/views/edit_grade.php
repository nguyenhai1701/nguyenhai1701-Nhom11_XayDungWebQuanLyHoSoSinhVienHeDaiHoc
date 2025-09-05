<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Điểm</title>
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
                <?php
                require_once __DIR__ . '/../functions/db_connect.php';
                $grade = null;
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT 
                        d.id, 
                        sv.id as id_sinh_vien,
                        sv.ho_ten,
                        mh.id as id_mon_hoc,
                        mh.ten_mon_hoc,
                        d.diem, 
                        d.hoc_ky, 
                        d.nam_hoc
                        FROM DiemSo d
                        INNER JOIN SinhVien sv ON d.id_sinh_vien = sv.id
                        INNER JOIN MonHoc mh ON d.id_mon_hoc = mh.id
                        WHERE d.id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $grade = $result->fetch_assoc();
                    $stmt->close();
                }

                if ($grade) {
                ?>
                <h2 class="card-title text-primary text-center">Sửa Điểm</h2>
                <form action="handle/edit_grade_handler.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $grade['id']; ?>">
                    <div class="mb-3">
                        <label for="ho_ten_sv" class="form-label">Sinh viên:</label>
                        <input type="text" class="form-control" id="ho_ten_sv" value="<?php echo htmlspecialchars($grade['ho_ten']); ?>" disabled>
                        <input type="hidden" name="id_sinh_vien" value="<?php echo $grade['id_sinh_vien']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ten_mon_hoc" class="form-label">Môn học:</label>
                        <input type="text" class="form-control" id="ten_mon_hoc" value="<?php echo htmlspecialchars($grade['ten_mon_hoc']); ?>" disabled>
                        <input type="hidden" name="id_mon_hoc" value="<?php echo $grade['id_mon_hoc']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="diem" class="form-label">Điểm:</label>
                        <input type="number" class="form-control" id="diem" name="diem" step="0.01" min="0" max="10" value="<?php echo htmlspecialchars($grade['diem']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="hoc_ky" class="form-label">Học kỳ:</label>
                        <input type="text" class="form-control" id="hoc_ky" name="hoc_ky" value="<?php echo htmlspecialchars($grade['hoc_ky']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nam_hoc" class="form-label">Năm học:</label>
                        <input type="text" class="form-control" id="nam_hoc" name="nam_hoc" value="<?php echo htmlspecialchars($grade['nam_hoc']); ?>" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?page=manage_grades" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Cập nhật Điểm</button>
                    </div>
                </form>
                <?php } else { ?>
                    <div class="alert alert-danger">Không tìm thấy điểm số.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<footer class="mt-5 p-3 bg-light text-center">
    <p class="mb-0">Hệ thống Quản lý Hồ sơ Sinh viên Đại học</p>
</footer>

</body>
</html>
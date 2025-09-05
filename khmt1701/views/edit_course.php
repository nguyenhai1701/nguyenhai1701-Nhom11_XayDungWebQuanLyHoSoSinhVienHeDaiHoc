<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Môn học</title>
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
                <a href="index.php?page=manage_courses" class="list-group-item list-group-item-action active">Quản lý Môn học</a>
                <a href="index.php?page=manage_grades" class="list-group-item list-group-item-action">Quản lý Điểm</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card p-4">
                <?php
                require_once __DIR__ . '/../functions/db_connect.php';
                $course = null;
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM MonHoc WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $course = $result->fetch_assoc();
                    $stmt->close();
                }

                if ($course) {
                ?>
                <h2 class="card-title text-primary text-center">Sửa Môn học</h2>
                <form action="handle/edit_course_handler.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                    <div class="mb-3">
                        <label for="ma_mon_hoc" class="form-label">Mã môn học:</label>
                        <input type="text" class="form-control" id="ma_mon_hoc" name="ma_mon_hoc" value="<?php echo htmlspecialchars($course['ma_mon_hoc']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="ten_mon_hoc" class="form-label">Tên môn học:</label>
                        <input type="text" class="form-control" id="ten_mon_hoc" name="ten_mon_hoc" value="<?php echo htmlspecialchars($course['ten_mon_hoc']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="so_tin_chi" class="form-label">Số tín chỉ:</label>
                        <input type="number" class="form-control" id="so_tin_chi" name="so_tin_chi" value="<?php echo htmlspecialchars($course['so_tin_chi']); ?>" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?page=manage_courses" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Cập nhật Môn học</button>
                    </div>
                </form>
                <?php } else { ?>
                    <div class="alert alert-danger">Không tìm thấy môn học.</div>
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
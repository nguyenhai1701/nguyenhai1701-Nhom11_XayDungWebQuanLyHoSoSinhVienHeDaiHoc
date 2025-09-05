<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Khoa</title>
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
                <a href="index.php?page=manage_faculties" class="list-group-item list-group-item-action active">Quản lý Khoa</a>
                <a href="index.php?page=manage_courses" class="list-group-item list-group-item-action">Quản lý Môn học</a>
                <a href="index.php?page=manage_grades" class="list-group-item list-group-item-action">Quản lý Điểm</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card p-4">
                <?php
                require_once __DIR__ . '/../functions/db_connect.php';
                $khoa = null;
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM Khoa WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $khoa = $result->fetch_assoc();
                    $stmt->close();
                }

                if ($khoa) {
                ?>
                <h2 class="card-title text-primary text-center">Sửa Khoa</h2>
                <form action="handle/edit_faculty_handler.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $khoa['id']; ?>">
                    <div class="mb-3">
                        <label for="ten_khoa" class="form-label">Tên Khoa:</label>
                        <input type="text" class="form-control" id="ten_khoa" name="ten_khoa" value="<?php echo htmlspecialchars($khoa['ten_khoa']); ?>" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?page=manage_faculties" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Cập nhật Khoa</button>
                    </div>
                </form>
                <?php } else { ?>
                    <div class="alert alert-danger">Không tìm thấy khoa.</div>
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
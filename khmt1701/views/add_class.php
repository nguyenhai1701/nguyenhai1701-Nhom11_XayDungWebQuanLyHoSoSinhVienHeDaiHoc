<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Lớp</title>
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
                <a href="index.php?page=manage_classes" class="list-group-item list-group-item-action active">Quản lý Lớp</a>
                <a href="index.php?page=manage_faculties" class="list-group-item list-group-item-action">Quản lý Khoa</a>
                <a href="index.php?page=manage_courses" class="list-group-item list-group-item-action">Quản lý Môn học</a>
                <a href="index.php?page=manage_grades" class="list-group-item list-group-item-action">Quản lý Điểm</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card p-4">
                <?php
                require_once __DIR__ . '/../functions/db_connect.php';

                $lop = null;
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM Lop WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $lop = $result->fetch_assoc();
                        $stmt->close();
                    }
                }

                if ($lop) {
                ?>
                <h2 class="card-title text-primary text-center">Sửa Lớp</h2>
                <form action="handle/edit_class_handler.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $lop['id']; ?>">
                    <div class="mb-3">
                        <label for="ten_lop" class="form-label">Tên Lớp:</label>
                        <input type="text" class="form-control" id="ten_lop" name="ten_lop" value="<?php echo htmlspecialchars($lop['ten_lop']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_khoa" class="form-label">Khoa:</label>
                        <select id="id_khoa" name="id_khoa" class="form-select" required>
                            <?php
                            $sql_faculties = "SELECT id, ten_khoa FROM Khoa";
                            $result_faculties = $conn->query($sql_faculties);
                            if ($result_faculties->num_rows > 0) {
                                while($row = $result_faculties->fetch_assoc()) {
                                    $selected = ($row['id'] == $lop['id_khoa']) ? 'selected' : '';
                                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . htmlspecialchars($row['ten_khoa']) . '</option>';
                                }
                            } else {
                                echo '<option value="">Chưa có khoa nào</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?page=manage_classes" class="btn btn-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary">Cập nhật Lớp</button>
                    </div>
                </form>
                <?php } else { ?>
                    <div class="alert alert-danger">Không tìm thấy lớp học.</div>
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
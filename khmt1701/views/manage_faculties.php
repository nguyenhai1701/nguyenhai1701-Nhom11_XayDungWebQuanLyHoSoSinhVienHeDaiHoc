<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Khoa</title>
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
                <h2 class="card-title text-primary text-center">Quản lý Khoa</h2>
                
                <div class="form-container mb-4">
                    <h3 class="text-center text-secondary">Thêm Khoa mới</h3>
                    <form action="handle/manage_faculties_handler.php" method="POST">
                        <input type="hidden" name="action" value="add">
                        <div class="mb-3">
                            <label for="ten_khoa" class="form-label">Tên Khoa:</label>
                            <input type="text" class="form-control" id="ten_khoa" name="ten_khoa" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Thêm Khoa</button>
                        </div>
                    </form>
                </div>

                <div class="table-container mt-4">
                    <h3 class="text-secondary text-center">Danh sách các Khoa</h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Khoa</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once __DIR__ . '/../functions/db_connect.php';
                            $sql = "SELECT id, ten_khoa FROM Khoa";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . htmlspecialchars($row['ten_khoa']) . "</td>";
                                    echo "<td>";
                                    echo "<a href='index.php?page=edit_faculty&id=" . $row['id'] . "' class='btn btn-warning btn-sm me-2'>Sửa</a>";
                                    echo "<a href='handle/manage_faculties_handler.php?action=delete&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Chưa có khoa nào trong hệ thống.</td></tr>";
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
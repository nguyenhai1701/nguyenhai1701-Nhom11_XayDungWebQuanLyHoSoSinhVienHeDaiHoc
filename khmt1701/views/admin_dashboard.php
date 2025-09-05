<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển Admin</title>
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
                <a href="index.php?page=admin_dashboard" class="list-group-item list-group-item-action active">Trang chính</a>
                <a href="index.php?page=manage_students" class="list-group-item list-group-item-action">Quản lý Sinh viên</a>
                <a href="index.php?page=manage_classes" class="list-group-item list-group-item-action">Quản lý Lớp</a>
                <a href="index.php?page=manage_faculties" class="list-group-item list-group-item-action">Quản lý Khoa</a>
                <a href="index.php?page=manage_courses" class="list-group-item list-group-item-action">Quản lý Môn học</a>
                <a href="index.php?page=manage_grades" class="list-group-item list-group-item-action">Quản lý Điểm</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-primary">Bảng điều khiển Admin</h2>
                    
                    <div class="alert alert-info" role="alert">
                      Chào mừng Admin, <?php echo $_SESSION['username']; ?>! Bạn có thể bắt đầu quản lý hệ thống.
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <img src="https://e-pro.vn/wp-content/uploads/2020/10/phan-mem-quan-ly-hoc-sinh-sinh-vien.jpg" class="img-fluid rounded shadow" alt="Phần mềm quản lý sinh viên">
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div>
                                <h4 class="text-secondary">Giới thiệu hệ thống</h4>
                                <p>Hệ thống này được xây dựng để hỗ trợ quản lý hồ sơ sinh viên một cách hiệu quả và tự động. Bạn có thể dễ dàng thêm, sửa, xóa thông tin sinh viên, lớp học, khoa và điểm số.</p>
                                <p>Sử dụng các nút bên trái để điều hướng và thực hiện các tác vụ quản lý.</p>
                            </div>
                        </div>
                    </div>
                    
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
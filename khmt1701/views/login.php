<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        /* Tùy chỉnh CSS nếu cần */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .login-card {
            display: flex;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 900px;
            width: 100%;
        }
        .login-image-col {
            flex: 1;
            background: url('images/images.jpg') no-repeat center center;
            background-size: cover;
            min-height: 400px;
        }
        .login-form-col {
            flex: 1;
            padding: 40px;
            background-color: #fff;
        }
        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
            }
            .login-image-col {
                min-height: 200px;
            }
            .login-form-col {
                padding: 20px;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="login-container">
    <div class="login-card">
        <div class="login-image-col">
            </div>
        <div class="login-form-col">
            <h2 class="card-title text-center text-primary mb-4">Đăng nhập</h2>
            <?php
            if (isset($_SESSION['login_error'])) {
                echo '<div class="alert alert-danger text-center">' . $_SESSION['login_error'] . '</div>';
                unset($_SESSION['login_error']);
            }
            ?>
            <form action="index.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
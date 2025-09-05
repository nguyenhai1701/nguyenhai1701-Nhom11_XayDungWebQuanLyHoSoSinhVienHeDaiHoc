<?php
session_start();
require_once __DIR__ . '/functions/db_connect.php';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>';

if (!isset($_SESSION['user_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once __DIR__ . '/handle/login_handler.php';
    }
    require_once __DIR__ . '/views/login.php';
} else {
    $role = $_SESSION['role'];
    $page = isset($_GET['page']) ? $_GET['page'] : '';

    if ($role === 'admin') {
        $admin_pages = [
            'admin_dashboard',
            'manage_students',
            'add_student',
            'edit_student',
            'manage_classes',
            'edit_class',
            'manage_faculties',
            'edit_faculty',
            'manage_courses',
            'edit_course',
            'manage_grades', // Thêm dòng này
            'edit_grade' // Thêm dòng này
        ];
        
        if (in_array($page, $admin_pages)) {
            require_once __DIR__ . '/views/' . $page . '.php';
        } else {
            require_once __DIR__ . '/views/admin_dashboard.php';
        }
    } else if ($role === 'student') {
        $student_pages = [
            'student_profile',
            'student_grades'
        ];
        if (in_array($page, $student_pages)) {
            require_once __DIR__ . '/views/' . $page . '.php';
        } else {
            require_once __DIR__ . '/views/student_profile.php';
        }
    } else {
        echo "You don't have permission to access!";
        echo '<a href="handle/logout.php">Logout</a>';
    }
}
$conn->close();
?>
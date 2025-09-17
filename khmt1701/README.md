<h2 align="center">
    <a href="https://dainam.edu.vn/vi/khoa-cong-nghe-thong-tin">
    🎓 Faculty of Information Technology (DaiNam University)
    </a>
</h2>
<h2 align="center">
    Open Source Software Development
</h2>
<div align="center">
    <p align="center">
        <img src="docs/logo/aiotlab_logo.png" alt="AIoTLab Logo" width="170"/>
        <img src="docs/logo/fitdnu_logo.png" alt="AIoTLab Logo" width="180"/>
        <img src="docs/logo/dnu_logo.png" alt="DaiNam University Logo" width="200"/>
    </p>

[![AIoTLab](https://img.shields.io/badge/AIoTLab-green?style=for-the-badge)](https://www.facebook.com/DNUAIoTLab)
[![Faculty of Information Technology](https://img.shields.io/badge/Faculty%20of%20Information%20Technology-blue?style=for-the-badge)](https://dainam.edu.vn/vi/khoa-cong-nghe-thong-tin)
[![DaiNam University](https://img.shields.io/badge/DaiNam%20University-orange?style=for-the-badge)](https://dainam.edu.vn)

</div>
<b>## 📖 1. Giới thiệu</b>

Ứng dụng web quản lý hồ sơ sinh viên đại học được xây dựng bằng PHP và sử dụng MySQL làm hệ quản trị cơ sở dữ liệu. Hệ thống hỗ trợ nhà trường và cán bộ quản lý trong việc theo dõi thông tin sinh viên, quá trình học tập, điểm số, lớp học, cũng như các hoạt động đoàn – hội liên quan.Giải pháp này giúp tự động hóa quy trình quản lý, giảm thiểu sai sót, và tăng tính minh bạch trong công tác lưu trữ, tra cứu hồ sơ. Đồng thời, hệ thống cung cấp các báo cáo tổng hợp nhanh chóng và chính xác, góp phần nâng cao hiệu quả quản trị và trải nghiệm của sinh viên.

## 🔧 2. Các công nghệ được sử dụng
<div align="center">

### Hệ điều hành
[![Windows](https://img.shields.io/badge/Windows-0078D6?style=for-the-badge&logo=windows&logoColor=white)](https://www.microsoft.com/en-us/windows/)
[![Ubuntu](https://img.shields.io/badge/Ubuntu-E95420?style=for-the-badge&logo=ubuntu&logoColor=white)](https://ubuntu.com/)
[![macOS](https://img.shields.io/badge/macOS-000000?style=for-the-badge&logo=apple&logoColor=white)](https://www.apple.com/macos/)

### Công nghệ chính
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![Bootstrap](https://img.shields.io/badge/Bootstrap_5.3.3-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

### Web Server & Database
[![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)](https://httpd.apache.org/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)](https://www.apachefriends.org/)
[![MySQL Workbench](https://img.shields.io/badge/MySQL_Workbench-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://dev.mysql.com/downloads/workbench/)

</div>

## ⚙️ 3. Cài đặt và Sử dụng

### 3.1. Yêu cầu hệ thống

- **Web Server**: Apache/Nginx
- **PHP**: Version 7.4 trở lên
- **Database**: MySQL 5.7+ hoặc MariaDB
- **XAMPP** (khuyến nghị cho Windows)
- **MySQL Workbench** (để quản lý database)

3.2. Cài đặt
3.2.1. Tải project
https://github.com/Dragonkin1402/Nhom2-QLHomestay.git
3.2.2. Cài đặt XAMPP (Windows)
Tải và cài đặt XAMPP
Khởi động Apache và MySQL từ XAMPP Control Panel
Sao chép project vào thư mục C:\xampp\htdocs\KHMT1701\
3.2.3. Cài đặt và cấu hình MySQL Workbench
Tải và cài đặt MySQL Workbench
Khởi động MySQL Workbench
Tạo kết nối mới:
Connection Name: Tai
Hostname: 127.0.0.1 hoặc localhost
Port: 3306
Username: root
Password: (để trống nếu chưa đặt mật khẩu)
3.2.4. Cấu hình kết nối database
Chỉnh sửa file functions/db_connection.php:

$servername = "localhost";
$username = "root"; 
$password = ""; // Hoặc mật khẩu MySQL của bạn
$dbname = "homestay_db";
3.3. Chạy ứng dụng
Đảm bảo Apache và MySQL đang chạy trong XAMPP
Truy cập: http://localhost/Tai-KHMT/
Đăng nhập với tài khoản:
Username: admin
Password: 123456

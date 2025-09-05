<h2 align="center">
    <a href="https://dainam.edu.vn/vi/khoa-cong-nghe-thong-tin">
    🎓 Faculty of Information Technology (DaiNam University)
    </a>
</h2>
<h2 align="center">
    HOTEL MANAGEMENT SYSTEM
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

## 📖 1. Giới thiệu
Hệ thống quản lý phòng khách sạn (Hotel Management System) được phát triển bằng PHP và MySQL. Đây là một ứng dụng web hoàn chỉnh giúp quản lý các hoạt động của khách sạn bao gồm quản lý khách hàng, phòng, loại phòng và đặt phòng.

### Tính năng chính:
- 👥 **Quản lý khách hàng**: Thêm, sửa, xóa thông tin khách hàng
- 🏨 **Quản lý loại phòng**: Quản lý các loại phòng với giá và sức chứa khác nhau
- 🚪 **Quản lý phòng**: Theo dõi trạng thái phòng (trống, đã thuê, bảo trì)
- 📅 **Quản lý đặt phòng**: Tạo, cập nhật và theo dõi các đơn đặt phòng
- 📊 **Dashboard**: Thống kê tổng quan về tình hình hoạt động
- 🔍 **Tìm kiếm**: Tìm kiếm nhanh trong tất cả các module 
- 🌙 **Dark Mode**: Chế độ giao diện tối/sáng

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

### 3.2. Cài đặt

#### 3.2.1. Tải project
```bash
git clone https://github.com/1677030156NguyenMinhPhuongKHMT17-01/Nhom5_XayDungWebQuanLyPhongKhachSan.git
cd Nhom5_XayDungWebQuanLyPhongKhachSan
```

#### 3.2.2. Cài đặt XAMPP (Windows)
1. Tải và cài đặt [XAMPP](https://www.apachefriends.org/download.html)
2. Khởi động Apache và MySQL từ XAMPP Control Panel
3. Sao chép project vào thư mục `C:\xampp\htdocs\BTL\`

#### 3.2.3. Cài đặt và cấu hình MySQL Workbench
1. Tải và cài đặt [MySQL Workbench](https://dev.mysql.com/downloads/workbench/)
2. Khởi động MySQL Workbench
3. Tạo kết nối mới:
   - Connection Name: `Hotel Management`
   - Hostname: `127.0.0.1` hoặc `localhost`
   - Port: `3306`
   - Username: `root`
   - Password: (để trống nếu chưa đặt mật khẩu)
4. Kết nối và tạo database mới bằng lệnh:

```sql
-- Tạo database
CREATE DATABASE ql_phongks;
USE ql_phongks;

-- Tạo bảng users
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
);

-- Tạo bảng guests (khách hàng)
CREATE TABLE `guests` (
  `id` int NOT NUL123


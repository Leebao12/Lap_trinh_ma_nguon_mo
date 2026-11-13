-- 1. Xóa cơ sở dữ liệu cũ nếu đã tồn tại để tránh xung đột
DROP DATABASE IF EXISTS `lab3_shop`;

-- 2. Tạo mới cơ sở dữ liệu chuẩn bảng mã utf8mb4
CREATE DATABASE `lab3_shop` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `lab3_shop`;

-- 3. Tạo bảng categories (Danh mục sản phẩm)
CREATE TABLE `categories` (
    `category_id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tạo bảng products (Sản phẩm - Khóa ngoại liên kết categories)
CREATE TABLE `products` (
    `product_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `price` DECIMAL(12,2) NOT NULL,
    `category_id` INT,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Nạp dữ liệu mẫu cho bảng categories
INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Điện thoại thông minh'),
(2, 'Laptop & Máy tính bảng'),
(3, 'Phụ kiện công nghệ');

-- 6. Nạp dữ liệu mẫu cho bảng products (10 sản phẩm phong phú để test phân trang và tìm kiếm)
INSERT INTO `products` (`name`, `price`, `category_id`) VALUES
('iPhone 15 Pro Max 256GB', 31990000.00, 1),
('Samsung Galaxy S24 Ultra', 27990000.00, 1),
('MacBook Air M2 13 inch', 24890000.00, 2),
('Dell XPS 13 Plus', 26500000.00, 2),
('Tai nghe AirPods Pro 2 USB-C', 5390000.00, 3),
('Chuột công thái học Logitech MX Master 3S', 2350000.00, 3),
('iPad Pro M4 11 inch Wi-Fi', 27490000.00, 2),
('Bàn phím cơ không dây Keychron K2 Pro', 2250000.00, 3),
('Xiaomi 14 Ultra 5G', 21990000.00, 1),
('Củ sạc nhanh Anker GaNPrime 65W', 950000.00, 3);

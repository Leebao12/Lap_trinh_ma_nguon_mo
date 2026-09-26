<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'test';      
$user = 'root';   
$pass = '';        

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ thông tin."]);
            exit;
        }

        $stmt_check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt_check->execute([$username]);
        if ($stmt_check->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "Tên đăng nhập đã được sử dụng!"]);
            exit;
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashed_password])) {
            echo json_encode(["status" => "success", "message" => "Đăng ký thành công!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Lỗi lưu dữ liệu."]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Lỗi kết nối CSDL: " . $e->getMessage()]);
}
?>
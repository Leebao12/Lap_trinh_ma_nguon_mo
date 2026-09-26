<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
    // Lưu cookie 'username' trong 1 giờ (3600 giây)
    setcookie('username', $_POST['name'], time() + 3600, '/');
    header('Location: bai20.php');
    exit;
}

if (isset($_GET['del'])) {
    setcookie('username', '', time() - 3600, '/');
    header('Location: bai20.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 20 - Ghi nhớ tên</title>
</head>
<body>
    <?php if (isset($_COOKIE['username'])): ?>
        <h2>Chào mừng trở lại, <?= htmlspecialchars($_COOKIE['username']) ?>!</h2>
        <p><a href="?del=1">Xóa tên đã ghi nhớ (Xóa Cookie)</a></p>
    <?php else: ?>
        <h2>Chào bạn! Hãy nhập tên để ứng dụng ghi nhớ:</h2>
        <form method="post">
            Tên của bạn: <input type="text" name="name" required>
            <input type="submit" value="Lưu tên">
        </form>
    <?php endif; ?>
</body>
</html>
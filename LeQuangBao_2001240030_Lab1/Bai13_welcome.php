<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: Bai13_login.php');
    exit;
}
echo "Xin chào, " . htmlspecialchars($_SESSION['user']);
echo "<p><a href='Bai13_logout.php'>Đăng xuất</a></p>";
?>
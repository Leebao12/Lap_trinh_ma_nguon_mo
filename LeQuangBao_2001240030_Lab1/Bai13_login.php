<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    // Tài khoản demo
    if ($user === 'lequangbao' && $pass === '123') {
        $_SESSION['user'] = $user;
        header('Location: Bai13_welcome.php');
        exit;
    } else $err = "Sai thông tin đăng nhập.";
}
?>
<form method="post">
    Username: <input name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>
<?php if (!empty($err)) echo "<p style='color:red;'>$err</p>"; ?>
<?php
require 'connect.php';
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$stmt = $conn->prepare(
    "SELECT * FROM students
     WHERE name LIKE ?
     ORDER BY id DESC"
);
$stmt->execute([
    "%$keyword%"
]);

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


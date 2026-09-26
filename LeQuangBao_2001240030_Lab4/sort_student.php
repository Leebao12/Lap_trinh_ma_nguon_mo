<?php
require 'connect.php';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$allowedSort = ['name', 'email'];
if (!in_array($sort, $allowedSort)) {
    $sort = 'id';
}
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

if ($order !== 'ASC' && $order !== 'DESC') {
    $order = 'ASC';
}
if ($sort == 'name') {
    $orderBy = "SUBSTRING_INDEX(name, ' ', -1)";
} else {
    $orderBy = "email";
}

$sql = "SELECT * FROM students
        ORDER BY $orderBy $order";

$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

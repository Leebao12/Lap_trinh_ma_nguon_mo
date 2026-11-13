<?php
require 'connect.php';

$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$limit = 3; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$sqlCount = "SELECT COUNT(*) FROM products WHERE name LIKE :kw";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->bindValue(':kw', "%$keyword%", PDO::PARAM_STR);
$stmtCount->execute();
$totalRecords = (int)$stmtCount->fetchColumn();

$totalPages = $totalRecords > 0 ? (int)ceil($totalRecords / $limit) : 1;
if ($page > $totalPages) {
    $page = $totalPages;
}
$offset = ($page - 1) * $limit;

$sql = "SELECT p.product_id, p.name, p.price, c.category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.category_id 
        WHERE p.name LIKE :kw 
        ORDER BY p.product_id ASC 
        LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':kw', "%$keyword%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'products'     => $products,
    'totalRecords' => $totalRecords,
    'totalPages'   => $totalPages,
    'currentPage'  => $page,
    'offset'       => $offset
]);
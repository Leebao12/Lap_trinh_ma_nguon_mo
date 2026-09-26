<?php
$city = strtolower($_GET['city'] ?? '');
$data = [
    "hanoi" => ["temp" => 30, "desc" => "Nắng đẹp"],
    "danang" => ["temp" => 32, "desc" => "Có mây"],
    "tphcm" => ["temp" =>25, "desc" =>"Mưa rào vài nơi"]
];
header('Content-Type: application/json');
echo json_encode($data[$city] ?? ["temp" => 0, "desc" => "Không có dữ
liệu"]);
?>
<?php
$danhSachSV = [
    ["hoten" => "Nguyễn Thế Anh", "diem" => 8.5],
    ["hoten" => "Trần Bảo Anh", "diem" => 9.2],
    ["hoten" => "Lê Quang Bảo", "diem" => 9.0],
    ["hoten" => "Trần Gia Bảo", "diem" => 9.5],
    ["hoten" => "Trần Dương Gia Bảo", "diem" => 9.5]
];

function timSinhVienDiemCaoNhat($ds) {
    if (empty($ds)) return [];
    
    $maxDiem = $ds[0]['diem'];
    foreach ($ds as $sv) {
        if ($sv['diem'] > $maxDiem) {
            $maxDiem = $sv['diem'];
        }
    }
    
    $danhSachThuKhoa = [];
    foreach ($ds as $sv) {
        if ($sv['diem'] == $maxDiem) {
            $danhSachThuKhoa[] = $sv;
        }
    }
    
    return $danhSachThuKhoa;
}

echo "<h3>Danh sách sinh viên:</h3><ul>";
foreach ($danhSachSV as $sv) {
    echo "<li>" . $sv['hoten'] . " - Điểm: " . $sv['diem'] . "</li>";
}
echo "</ul><hr>";

$thuKhoa = timSinhVienDiemCaoNhat($danhSachSV);

if (!empty($thuKhoa)) {
    echo "<h3>Danh sách sinh viên có điểm cao nhất (" . $thuKhoa[0]['diem'] . " điểm):</h3>";
    echo "<ul>";
    foreach ($thuKhoa as $sv) {
        echo "<li>Họ tên: <strong>" . $sv['hoten'] . "</strong></li>";
    }
    echo "</ul>";
} else {
    echo "Không có dữ liệu sinh viên.";
}
?>
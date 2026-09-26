<?php
function chuoiVietHoa($str) {
    return mb_strtoupper($str, 'UTF-8');
}

$chuoiBanDau = "lập trình mã nguồn mở php";
$chuoiKetQua = chuoiVietHoa($chuoiBanDau);

echo "Chuỗi ban đầu: " . $chuoiBanDau . "<br>";
echo "Chuỗi sau khi viết hoa: <strong>" . $chuoiKetQua . "</strong>";
?>
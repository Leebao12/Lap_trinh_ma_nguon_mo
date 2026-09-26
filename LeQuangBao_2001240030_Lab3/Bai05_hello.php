<?php
$name= $_POST['name'] ?? '';
if (trim($name) === '') {
    $name = 'Bạn';
}
echo "Xin chào, ".htmlspecialchars($name);
?>
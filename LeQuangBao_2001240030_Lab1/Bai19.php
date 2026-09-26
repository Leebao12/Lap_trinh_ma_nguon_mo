<?php
    $filepath = 'data/note.txt';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['note'])) {
        $note = trim($_POST['note']);
        $line = date("d/m/Y H:i:s") . " | " . str_replace(["\r", "\n"], " ", $note) . PHP_EOL;
        
        file_put_contents($filepath, $line, FILE_APPEND | LOCK_EX);
        echo "<p style='color:green;'>Đã lưu ghi chú thành công!</p>";
    }

    echo "<hr><h3>Toàn bộ ghi chú đã lưu:</h3>";
    if (file_exists($filepath) && filesize($filepath) > 0) {
        echo "<pre style='background:#f4f4f4; padding:10px;'>" . htmlspecialchars(file_get_contents($filepath)) . "</pre>";
    } else {
        echo "<p>Chưa có ghi chú nào trong file.</p>";
    }
    ?>
<?php
require 'connect.php';
require 'sort_student.php';
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$limit = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$sqlCount = "SELECT COUNT(*) FROM students WHERE name LIKE :keyword";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->execute([':keyword' => "%$keyword%"]);
$totalRecords = $stmtCount->fetchColumn();
$totalPages = ceil($totalRecords / $limit);
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

if ($sort == 'name') {
    $orderBy = "SUBSTRING_INDEX(name, ' ', -1)";
} elseif ($sort == 'email') {
    $orderBy = "email";
} else {
    $orderBy = "id";
}

if ($order != 'ASC' && $order != 'DESC') {
    $order = 'DESC';
}
//Truy vấn dữ liệu có phân trang, tìm kiếm, sắp xếp
$sql = "SELECT * FROM students
        WHERE name LIKE :keyword
        ORDER BY $orderBy $order
        LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <!--Form tìm kiếm-->
    <h2>Danh sách sinh viên</h2>
    <form method="get" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>"
                class="form-control" placeholder="Nhập tên cần tìm">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>
    <!--Form sắp xếp-->
    <form method="get" class="row g-2 mb-4 align-items-end">
        <div class="col-md-3">
            <label class="form-label fw-semibold">Sắp xếp theo</label>
            <select name="sort" class="form-select">
                <option value="name" <?= $sort == 'name' ? 'selected' : '' ?>>Tên</option>
                <option value="email" <?= $sort == 'email' ? 'selected' : '' ?>>Email</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Thứ tự</label>
            <select name="order" class="form-select">
                <option value="ASC" <?= $order == 'ASC' ? 'selected' : '' ?>>↑ Tăng dần</option>
                <option value="DESC" <?= $order == 'DESC' ? 'selected' : '' ?>>↓ Giảm dần</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Sắp xếp</button>
        </div>
    </form>
    <!--Hiển thị-->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Birthday</th>

            </tr>
        </thead>
        <tbody>
            <?php if ($students): ?>
                <?php foreach ($students as $index => $row): ?><tr>
                        <td><?= $offset + $index + 1 ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['birthday']) ?></td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=
                                                                            urlencode($keyword) ?>&page=1">Đầu</a></li>
                <li class="page-item"><a class="page-link" href="?keyword=<?=
                                                                            urlencode($keyword) ?>&page=<?= $page - 1 ?>">Trước</a></li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?keyword=<?=
                                                        urlencode($keyword) ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=
                                                                            urlencode($keyword) ?>&page=<?= $page + 1 ?>">Sau</a></li>
                <li class="page-item"><a class="page-link" href="?keyword=<?=
                                                                            urlencode($keyword) ?>&page=<?= $totalPages ?>">Cuối</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>

</html>
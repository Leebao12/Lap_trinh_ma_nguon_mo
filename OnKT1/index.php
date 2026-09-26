<?php
require 'autoload.php';
require 'connect.php';

use App\Models\Product;

$kw = isset($_GET['kw']) ? trim($_GET['kw']) : '';

$limit = 3;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$sqlCount = "SELECT COUNT(*) FROM products WHERE name LIKE :kw";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->bindValue(':kw', "%$kw%", PDO::PARAM_STR);
$stmtCount->execute();
$totalRecords = (int)$stmtCount->fetchColumn();
$totalPages = $totalRecords > 0 ? (int)ceil($totalRecords / $limit) : 1;

$sql = "SELECT p.product_id, p.name, p.price, c.category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.category_id 
        WHERE p.name LIKE :kw 
        ORDER BY p.product_id ASC 
        LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':kw', "%$kw%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Danh sách sản phẩm</h2>

    <form method="get" class="row mb-3" onsubmit="event.preventDefault();">
        <div class="col-md-4">
            <input type="text" id="keyword" name="kw" value="<?= htmlspecialchars($kw) ?>"
                   class="form-control" placeholder="Nhập tên cần tìm">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary" onclick="searchAjax(1)">Tìm kiếm</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã SP</th>
                <th>Tên SP</th>
                <th>Đơn giá</th>
                <th>Tên danh mục</th>
            </tr>
        </thead>
        <tbody id="product-list">
            <?php if ($products): ?>
                <?php foreach ($products as $index => $row): ?>
                    <?php
                    $prod = new Product($row['product_id'], $row['name'], $row['price']);
                    echo $prod->displayRow($row['category_name'], $offset + $index + 1);
                    ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination justify-content-center" id="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?kw=<?= urlencode($kw) ?>&page=1">Đầu</a></li>
                <li class="page-item"><a class="page-link" href="?kw=<?= urlencode($kw) ?>&page=<?= $page - 1 ?>">Trước</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?kw=<?= urlencode($kw) ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?kw=<?= urlencode($kw) ?>&page=<?= $page + 1 ?>">Sau</a></li>
                <li class="page-item"><a class="page-link" href="?kw=<?= urlencode($kw) ?>&page=<?= $totalPages ?>">Cuối</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <script>
    const inputKw = document.getElementById("keyword");
    const productList = document.getElementById("product-list");
    const pagination = document.getElementById("pagination");

    inputKw.addEventListener("input", function() {
        searchAjax(1);
    });

    function searchAjax(page = 1) {
        let q = inputKw.value.trim();
        fetch(`search_ajax.php?q=${encodeURIComponent(q)}&page=${page}`)
            .then(res => res.json())
            .then(data => {
                let html = "";
                if (data.products && data.products.length > 0) {
                    data.products.forEach((p, index) => {
                        let stt = data.offset + index + 1;
                        let formattedPrice = Number(p.price).toLocaleString('vi-VN') + " VNĐ";
                        let catName = p.category_name ? p.category_name : "";

                        html += `<tr>
                            <td>${stt}</td>
                            <td>${p.product_id}</td>
                            <td>${escapeHtml(p.name)}</td>
                            <td>${formattedPrice}</td>
                            <td>${escapeHtml(catName)}</td>
                        </tr>`;
                    });
                } else {
                    html = `<tr><td colspan="5" class="text-center">Không có dữ liệu</td></tr>`;
                }
                productList.innerHTML = html;

                renderPagination(data.totalPages, data.currentPage);
            })
            .catch(err => console.error("Lỗi Fetch API:", err));
    }

    function renderPagination(totalPages, currentPage) {
        let html = "";
        if (totalPages > 1) {
            if (currentPage > 1) {
                html += `<li class="page-item"><a class="page-link" href="#" onclick="searchAjax(1); return false;">Đầu</a></li>`;
                html += `<li class="page-item"><a class="page-link" href="#" onclick="searchAjax(${currentPage - 1}); return false;">Trước</a></li>`;
            }

            for (let i = 1; i <= totalPages; i++) {
                let active = (i === currentPage) ? "active" : "";
                html += `<li class="page-item ${active}"><a class="page-link" href="#" onclick="searchAjax(${i}); return false;">${i}</a></li>`;
            }

            if (currentPage < totalPages) {
                html += `<li class="page-item"><a class="page-link" href="#" onclick="searchAjax(${currentPage + 1}); return false;">Sau</a></li>`;
                html += `<li class="page-item"><a class="page-link" href="#" onclick="searchAjax(${totalPages}); return false;">Cuối</a></li>`;
            }
        }
        pagination.innerHTML = html;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/[&<>"']/g, function(m) {
            return {'&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#039;'}[m];
        });
    }
    </script>
</body>
</html>
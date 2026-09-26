<?php
require 'connect.php';
require 'sort_student.php';
require 'search_student.php';
?>
<form method="get">
    <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>"
        placeholder="Nhập tên sinh viên">
    <button type="submit">Tìm kiếm</button>
</form>
<br>
<form method="get">
    <label>Sắp xếp theo:</label>
    <select name="sort">
        <option value="name"<?= $sort == 'name' ? 'selected' : '' ?>>Tên</option>
        <option value="email"<?= $sort == 'email' ? 'selected' : '' ?>>Email</option>
    </select>

    <select name="order">
        <option value="ASC"
            <?= $order == 'ASC' ? 'selected' : '' ?>>
            Tăng dần
        </option>
        <option value="DESC"
            <?= $order == 'DESC' ? 'selected' : '' ?>>
            Giảm dần
        </option>
    </select>
    <button type="submit">Sắp xếp</button>
</form>

<br>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Birthday</th>
        <th colspan="2">Thao tác</th>
    </tr>
    <?php foreach ($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['birthday'] ?></td>
            <td><a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a></td>
            <td><a href="edit_student.php?id=<?= $row['id'] ?>">Sửa</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<style>
    .table--wrapper {
    width: 100%;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.table--wrapper .title {
    font-size: 24px;
    margin-bottom: 15px;
    text-align: center;
    color: #333;
}

.add {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.add:hover {
    background-color: #218838;
}

.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #f8f9fa;
    font-weight: bold;
    color: #333;
}

td {
    font-size: 14px;
}

.edit, .delete {
    padding: 5px 10px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 5px;
}

.edit:hover, .delete:hover {
    background-color: #0056b3;
}

.delete {
    background-color: #dc3545;
}

.delete:hover {
    background-color: #c82333;
}

.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    padding: 5px 10px;
    text-decoration: none;
    color: #007bff;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 0 5px;
}

.pagination a:hover {
    background-color: #e9ecef;
}

.pagination a.active {
    background-color: #007bff;
    color: white;
}
</style>
<!-- commentlist.php -->
<div class="table--wrapper">
    <h3 class="title">Danh sách bình luận</h3>
    <a href="?act=comment-add"><button class="add">Thêm bình luận mới</button></a>
    
    <!-- Thông báo thành công nếu có -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success" style="background-color:#d4edda;border:0.5px solid #ddd;border-radius:6px;color:#155724;border-color: #c3e6cb; margin-bottom:5px;font-family: Arial, sans-serif;">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="table-container">
        <table style="text-align: left;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Sản phẩm</th>
                    <th>ID Người dùng</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                    <th>ID Đơn hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($comments): ?>
                    <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td><?= htmlspecialchars($comment['CommentID'] ?? '') ?></td>
                            <td><?= htmlspecialchars($comment['ProductID'] ?? '') ?></td>
                            <td><?= htmlspecialchars($comment['UserID'] ?? '') ?></td>
                            <td><?= htmlspecialchars($comment['Content'] ?? '') ?></td>
                            <td><?= htmlspecialchars($comment['date'] ?? 'N/A') ?></td> <!-- Nếu không có giá trị, hiển thị "N/A" -->
                            <td><?= htmlspecialchars($comment['OrderID'] ?? '') ?></td>
                            <td>
                                <a href="?act=comment-edit&id=<?= $comment['CommentID'] ?>">
                                    <button class="edit">Sửa</button>
                                </a>
                                <a href="?act=comment-delete&id=<?= $comment['CommentID'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <button class="delete">Xóa</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if (!empty($totalPages) && $totalPages > 0): ?>
    <div class="pagination">
        <h3>Trang:</h3>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?act=comment-list&page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
<?php else: ?>
    <p>Không có dữ liệu để hiển thị phân trang.</p>
<?php endif; ?>

</div>

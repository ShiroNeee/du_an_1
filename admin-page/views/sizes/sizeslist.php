<!-- sizeslist.php -->
<div class="table--wrapper">
    <h3 class="title">Danh sách kích cỡ sản phẩm</h3>
    <a href="?act=sizes-add"><button class="add">Thêm kích cỡ mới</button></a>
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
                    <th>ID sản phẩm</th>
                    <th>Kích cỡ</th>
                    <th>Số lượng trong kho</th>
                    <th>Chỉnh sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($sizes): ?>
                    <?php foreach ($sizes as $size): ?>
                        <tr>
                            <td><?= $size['SizeID'] ?></td>
                            <td><?= $size['ProductID'] ?></td>
                            <td><?= $size['Size'] ?></td>
                            <td><?= $size['StockQuantity'] ?></td>
                            <td>
                                <a href="?act=sizes-edit&id=<?= $size['SizeID'] ?>">
                                    <button class="edit">Sửa</button>
                                </a>
                            </td>
                            <td>
                                <a href="?act=sizes-delete&id=<?= $size['SizeID'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa kích cỡ này không?')">
                                    <button class="delete">Xóa</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Phân trang -->
    <div class="pagination">
        <h3>Trang:</h3>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?act=sizes-list&page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</div>
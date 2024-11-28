<div class="table--wrapper">
    <h3 class="title">Quản lý đơn hàng</h3>
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success" style="background-color:#d4edda;border:0.5px solid #ddd;border-radius:6px;color:#155724;border-color: #c3e6cb; margin-bottom:5px;font-family: Arial, sans-serif;">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <br>
    <div class="table-container">
        <table style="text-align: left;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>ID đơn hàng</th>
                        <th>Ảnh</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Số lượng</th>
                        <th>Tính năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listOrders as $index => $orders) : ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $orders['name']; ?></td>
                            <td><?= $orders['ProductID']; ?></td>
                            <td>
                            <img src="<?= $orders['image']; ?>" width="80px">
                            </td>
                            <td><?= $orders['OrderDate']; ?></td>
                            <td><?= number_format($orders['TotalAmount'], 0, ',', '.'); ?></td>
                            <td><?= $orders['statusName']; ?></td>
                            <td><?= $orders['Quantity']; ?></td>
                            <td>
                                <a href="?act=edit-order&id=<?= $orders['OrderID']; ?>">
                                    <button class="edit">Cập nhật</button>
                                </a>
                                <form action="?act=delete-order" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn huỷ đơn?')">
                                    <input type="hidden" name="id" value="<?= $orders['OrderID']; ?>">
                                    <button type="submit" class="delete">Huỷ đơn</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
<style>
    /* Container for pagination */
    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination-container {
        display: inline-flex;
        align-items: center;
    }

    .page-link {
        display: inline-block;
        padding: 8px 15px;
        margin: 0 5px;
        text-decoration: none;
        color: #007bff;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .page-link:hover {
        background-color: #007bff;
        color: white;
    }

    .page-link.active {
        background-color: #007bff;
        color: white;
        pointer-events: none;
    }

    .page-link.disabled {
        color: #ddd;
        pointer-events: none;
    }

    .page-link[aria-label="Previous"] {
        font-weight: bold;
    }

    .page-link[aria-label="Next"] {
        font-weight: bold;
    }
</style>
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
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>ID đơn hàng</th>
                    <th>Ảnh</th>
                    <th>Ngày đặt</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalQuantity = 0;  // Khởi tạo biến để lưu tổng số lượng
                foreach ($listOrders as $index => $orders) :
                    $totalQuantity += $orders['Quantity'];  // Cộng dồn số lượng 
                ?>
                    <tr>
                        <td><?= $orders['OrderID']; ?></td>
                        <td><?= $orders['name']; ?></td>
                        <td><?= $orders['ProductID']; ?></td>
                        <td>
                            <img src="<?= $orders['image']; ?>" width="80px">
                        </td>
                        <td><?= $orders['OrderDate']; ?></td>
                        <td><?= $orders['Size']; ?></td>
                        <td><?= $orders['Quantity']; ?></td>
                        <td><?= number_format($orders['TotalAmount'], 0, ',', '.'); ?></td>
                        <td style="color:
                        <?= $orders['Status'] == 3 ? 'blue' : ($orders['Status'] == 1 ||
                            $orders['Status'] == 2 ? '#9C9900' : 'red');
                        ?>;font-size: 20px;">
                            <?= $orders['statusName']; ?>
                        </td>
                        
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
    <div class="pagination">
        <div class="pagination-container">
            <!-- Previous button -->
            <a href="?act=list-order&page=<?= max(1, $currentPage - 1); ?>" class="page-link" aria-label="Previous">
                <span aria-hidden="true">&laquo; Prev</span>
            </a>

            <!-- Các trang -->
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <a href="?act=list-order&page=<?= $page; ?>" class="page-link <?= $page == $currentPage ? 'active' : ''; ?>">
                    <?= $page; ?>
                </a>
            <?php endfor; ?>

            <!-- Next button -->
            <a href="?act=list-order&page=<?= min($totalPages, $currentPage + 1); ?>" class="page-link" aria-label="Next">
                <span aria-hidden="true">Next &raquo;</span>
            </a>
        </div>
    </div>

</div>
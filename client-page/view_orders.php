<?php
function getStatusClass($status)
{
    switch ($status) {
        case 0:
            return 'text-primary';
        case 1:
            return 'text-danger';
        case 2:
            return 'text-warning';
        case 3:
            return 'text-warning';
        default:
            return 'text-danger';
    }
}

?>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="../client-page" style="text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="#" style="text-decoration: none;">Đơn hàng của bạn</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="table-responsive">
        <form action="?act=delete-order-cart" method="POST" id="delete-form">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-secondary">
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>ID Đơn hàng</th>
                        <th>User</th>
                        <th>ID Sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Ngày đặt</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalAmountAll = 0;

                    // Duyệt qua danh sách đơn hàng đã lấy từ controller
                    foreach ($listOrders as $index => $order) :
                        $totalAmountAll += $order['TotalAmount'];  // Tính tổng giá trị đơn hàng
                        $isSuccess = ($order['Status'] == 3);
                    ?>
                        <tr style="font-size: 22px;" id="order-row-<?= $order['OrderID']; ?>">
                            <td><input type="checkbox" name="deleteOrders[]" value="<?= $order['OrderID']; ?>" class="delete-checkbox"></td>
                            <td><?= $order['OrderID']; ?></td>
                            <td><?= $order['name']; ?></td>
                            <td><?= $order['ProductID']; ?></td>
                            <td>
                                <a href="?act=detail&id=<?= $order['ProductID']; ?>">
                                    <img src="<?= $order['image']; ?>" width="80px" alt="Product Image">
                                </a>
                            </td>
                            <td><?= $order['OrderDate']; ?></td>
                            <td><?= htmlspecialchars($order['Size']); ?></td>
                            <td><?= $order['Quantity']; ?></td>
                            <td><?= number_format($order['TotalAmount'], 0, ',', '.'); ?> VNĐ</td>
                            <td class=" status-cell <?= getStatusClass($order['Status']); ?>"><?= $order['statusName']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-end" style="font-size: 18px; font-weight: bold;">
                Tổng giá trị tất cả đơn hàng: <span id="total-all-amount"><?= number_format($totalAmountAll, 0, ',', '.'); ?> VNĐ</span>
            </div>


            <button type="submit" class="btn btn-danger">Huỷ đơn đã chọn</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('.delete-checkbox');

        checkboxes.forEach(function(checkbox) {
            var row = checkbox.closest('tr'); // Lấy dòng tương ứng với checkbox
            var status = row.querySelector('.status-cell'); // Lấy trạng thái của đơn hàng

            if (status && status.textContent.trim() === 'Thành công') {
                checkbox.disabled = true; // Vô hiệu hóa checkbox
            }
        });

        // Quản lý nút "Chọn tất cả"
        document.getElementById('select-all').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('.delete-checkbox');
            checkboxes.forEach(function(checkbox) {
                if (!checkbox.disabled) { // Kiểm tra checkbox không bị vô hiệu hóa
                    checkbox.checked = this.checked;
                }
            }, this);
        });

        // Xử lý khi form được submit
        document.getElementById('delete-form').addEventListener('submit', function(event) {
            var checkboxes = document.querySelectorAll('.delete-checkbox');

            // Loại bỏ checkbox bị vô hiệu hóa khỏi form trước khi gửi
            checkboxes.forEach(function(checkbox) {
                if (checkbox.disabled) {
                    checkbox.disabled = false; // Hủy vô hiệu hóa checkbox để nó không bị gửi đi
                }
            });
        });
    });
</script>
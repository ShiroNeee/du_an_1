<?php
function getStatusClass($status)
{
    switch ($status) {
        case 0:
            return 'text-danger';
        case 1:
            return 'text-warning';
        case 2:
            return 'text-warning';
        case 3:
            return 'text-success';
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
                    <li class="breadcrumb-item"><a href="#" style="text-decoration: none;">Giỏ hàng của bạn</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>ID đơn hàng</th>
                    <th>Ảnh</th>
                    <th>Ngày đặt</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Tính năng</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalAmountAll = 0; // Khởi tạo biến tổng số tiền
                $ordersGrouped = []; // Mảng để nhóm đơn hàng theo ProductID

                // Nhóm các đơn hàng có cùng ProductID
                foreach ($listOrders as $orders) {
                    $productId = $orders['ProductID'];
                    if (!isset($ordersGrouped[$productId])) {
                        $ordersGrouped[$productId] = $orders;
                    } else {
                        $ordersGrouped[$productId]['Quantity'] += $orders['Quantity'];
                        $ordersGrouped[$productId]['TotalAmount'] += $orders['TotalAmount'];
                    }
                }

                // Hiển thị thông tin các đơn hàng đã được nhóm
                foreach ($ordersGrouped as $index => $orders) :
                    $totalAmountAll += $orders['TotalAmount']; // Cộng dồn tổng tiền tất cả các đơn hàng
                ?>
                    <tr style="font-size: 22px;" id="order-row-<?= $orders['OrderID']; ?>">
                        <form action="?act=update-order-cart" method="POST">
                            <td><?= $index + 1; ?></td>
                            <td><?= $orders['name']; ?></td>
                            <td><?= $orders['ProductID']; ?></td>
                            <td>
                                <img src="<?= $orders['image']; ?>" width="80px">
                            </td>
                            <td><?= $orders['OrderDate']; ?></td>
                            <td>
                                <input type="number" name="Quantity" value="<?= $orders['Quantity'] ?>" min="1">
                            </td>

                            <td id="total-amount-<?= $orders['OrderID']; ?>"><?= number_format($orders['TotalAmount'], 0, ',', '.'); ?></td>
                            <td class="<?= getStatusClass($orders['Status']); ?>"><?= $orders['statusName']; ?></td>
                            <td>
                                <!-- Các trường ẩn để gửi thông tin đơn hàng -->
                                <input type="hidden" name="OrderID" value="<?= $orders['OrderID']; ?>">
                                <input type="hidden" name="UserID" value="<?= $orders['UserID']; ?>">
                                <input type="hidden" name="ProductID" value="<?= $orders['ProductID']; ?>">
                                <input type="hidden" name="OrderDate" value="<?= $orders['OrderDate']; ?>">
                                <input type="hidden" name="Status" value="<?= $orders['Status']; ?>">
                                <button type="submit" name="action" value="update" class="btn btn-primary btn-sm">Update</button>

                            </td>
                        </form>
                        <td>
                            <form action="?act=delete-order-cart" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn huỷ đơn?')">
                                <input type="hidden" name="id" value="<?= $orders['OrderID']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Hiển thị tổng tiền của tất cả các đơn hàng -->
        <div class="text-end" style="font-size: 18px; font-weight: bold;">
            Tổng giá trị tất cả đơn hàng: <?= number_format($totalAmountAll, 0, ',', '.'); ?> VNĐ
        </div>

        <!-- Form thanh toán -->
        <div class="text-end mt-4">
            <form action="?act=payment" method="POST">
                <input type="hidden" name="totalAmount" value="<?= $totalAmountAll; ?>">
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>
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
        <form action="?act=delete-order-cart" method="POST" id="delete-form">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
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
                    $totalQuantity = 0;
                    $OrderID = 0;

                    foreach ($listOrders as $index => $orders) :
                        $totalAmountAll += $orders['TotalAmount'];
                        $totalQuantity += $orders['Quantity'];
                        $OrderID = $orders['OrderID'];

                    ?>
                        <tr style="font-size: 22px;" id="order-row-<?= $orders['OrderID']; ?>">
                            <td><input type="checkbox" name="deleteOrders[]" value="<?= $orders['OrderID']; ?>" class="delete-checkbox"></td>
                            <td><?= $orders['OrderID']; ?></td>
                            <td><?= $orders['name']; ?></td>
                            <td><?= $orders['ProductID']; ?></td>
                            <td>
                                <a href="?act=detail&id=<?= $orders['ProductID']; ?>">
                                    <img src="<?= $orders['image']; ?>" width="80px" alt="Product Image">
                                </a>
                            </td>
                            <td><?= $orders['OrderDate']; ?></td>
                            <td>
                                <?= htmlspecialchars($orders['Size']); ?>
                                <input type="hidden" name="SizeID[]" value="<?= $orders['SizeID']; ?>">
                            </td>

                            <td>
                                <button type="button" class="decrease-quantity" data-orderid="<?= $orders['OrderID']; ?>">-</button>
                                <span class="quantity-display" id="display-quantity-<?= $orders['OrderID']; ?>"><?= $orders['Quantity']; ?></span>
                                <button type="button" class="increase-quantity" data-orderid="<?= $orders['OrderID']; ?>">+</button>
                            </td>
                            <td id="total-amount-<?= $orders['OrderID']; ?>"><?= number_format($orders['TotalAmount'], 0, ',', '.'); ?></td>

                            <td class="<?= getStatusClass($orders['Status']); ?>"><?= $orders['statusName']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-end" style="font-size: 18px; font-weight: bold;">
                Tổng giá trị tất cả đơn hàng: <span id="total-all-amount"><?= number_format($totalAmountAll, 0, ',', '.'); ?> VNĐ</span>
            </div>


            <button type="submit" class="btn btn-danger">Huỷ đơn đã chọn</button>
        </form>

        <div class="text-end mt-4">
            <form action="?act=payment" method="POST" id="payment-form">
                <?php
                // Duyệt qua tất cả đơn hàng để tạo các trường input ẩn cho từng OrderID, Quantity và TotalAmount
                foreach ($listOrders as $orders) :
                ?>
                    <input type="hidden" name="ProductID[]" value="<?= $orders['ProductID']; ?>">
                    <input type="hidden" name="SizeID[]" value="<?= $orders['SizeID']; ?>">
                    <input type="hidden" name="OrderID[]" value="<?= $orders['OrderID']; ?>">
                    <input type="hidden" name="Quantity[]" value="<?= $orders['Quantity']; ?>" id="quantity-<?= $orders['OrderID']; ?>">
                    <input type="hidden" name="totalAmount[]" value="<?= $orders['TotalAmount']; ?>" id="total-amount-<?= $orders['OrderID']; ?>">
                <?php endforeach; ?>
                <button type="submit" class="btn btn-success">Thanh toán</button>
            </form>
        </div>

    </div>
</div>

<script>
    document.querySelectorAll('.increase-quantity, .decrease-quantity').forEach(function(button) {
        button.addEventListener('click', function() {
            var orderId = this.getAttribute('data-orderid');
            var quantityElement = document.getElementById('quantity-' + orderId);
            var displayQuantityElement = document.getElementById('display-quantity-' + orderId);
            var totalAmountElement = document.getElementById('total-amount-' + orderId);

            // Kiểm tra nếu các phần tử không tồn tại
            if (!quantityElement || !displayQuantityElement || !totalAmountElement) {
                console.error("Các phần tử không tồn tại cho OrderID: " + orderId);
                return;
            }

            // Lấy số lượng và tổng tiền hiện tại
            var currentQuantity = parseInt(quantityElement.value, 10);
            var currentTotalAmount = parseInt(totalAmountElement.textContent.replace(/\./g, '').replace(' VNĐ', ''), 10);

            // Nếu giá trị không hợp lệ (NaN), dừng lại
            if (isNaN(currentQuantity) || isNaN(currentTotalAmount)) {
                console.error("Giá trị không hợp lệ cho OrderID: " + orderId);
                return;
            }

            var pricePerUnit = currentTotalAmount / currentQuantity; // Tính giá mỗi sản phẩm

            // Xác định thao tác (tăng hoặc giảm)
            var isIncrease = this.classList.contains('increase-quantity');
            var newQuantity = isIncrease ? currentQuantity + 1 : Math.max(1, currentQuantity - 1);

            // Cập nhật số lượng và tổng tiền của đơn hàng
            quantityElement.value = newQuantity;
            displayQuantityElement.textContent = newQuantity;

            var newTotalAmount = pricePerUnit * newQuantity; // Tính tổng tiền mới
            totalAmountElement.textContent = newTotalAmount.toLocaleString() + '';

            // Cập nhật tổng tiền và tổng số lượng của tất cả đơn hàng
            updateTotalAmountAll();
        });
    });

    document.getElementById('select-all').addEventListener('click', function() {
        // Lấy tất cả các checkbox với class 'delete-checkbox'
        var checkboxes = document.querySelectorAll('.delete-checkbox');
        var isChecked = this.checked; // Lấy trạng thái của checkbox "Chọn tất cả"

        // Duyệt qua tất cả các checkbox và cập nhật trạng thái của chúng theo checkbox "Chọn tất cả"
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
    });


    function updateTotalAmountAll() {
        var totalAllAmount = 0;
        var totalQuantity = 0;

        // Tính tổng tiền của tất cả các đơn hàng
        document.querySelectorAll('[id^="total-amount-"]').forEach(function(element) {
            var amount = parseInt(element.textContent.replace(/\./g, '').replace(' VNĐ', ''), 10);
            if (!isNaN(amount)) {
                totalAllAmount += amount;
            }
        });

        // Tính tổng số lượng của tất cả các đơn hàng
        document.querySelectorAll('[id^="quantity-"]').forEach(function(element) {
            var quantity = parseInt(element.value, 10);
            if (!isNaN(quantity)) {
                totalQuantity += quantity;
            }
        });

        // Hiển thị tổng tiền tất cả đơn hàng
        document.getElementById('total-all-amount').textContent = totalAllAmount.toLocaleString() + ' VNĐ';

        // Cập nhật tổng số lượng và tổng tiền vào các trường ẩn (form thanh toán)
        document.getElementById('total-quantity-hidden').value = totalQuantity;
        document.getElementById('total-amount-hidden').value = totalAllAmount;
    }


    function updateHiddenFields() {
        // Đảm bảo cập nhật lại giá trị của tổng số lượng và tổng tiền vào các trường ẩn
        var totalQuantity = 0;
        var totalAmount = 0;

        document.querySelectorAll('[id^="quantity-"]').forEach(function(element) {
            totalQuantity += parseInt(element.textContent);
        });

        document.querySelectorAll('[id^="total-amount-"]').forEach(function(element) {
            totalAmount += parseInt(element.textContent.replace(/\./g, '').replace(' VNĐ', ''));
        });

        document.getElementById('total-quantity-hidden').value = totalQuantity;
        document.getElementById('total-amount-hidden').value = totalAmount;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Cập nhật tổng tiền và tổng số lượng ban đầu
        updateTotalAmountAll();

        // Đảm bảo cập nhật lại giá trị khi form được submit
        document.querySelector('form#payment-form').addEventListener('submit', function() {
            updateTotalAmountAll();
        });
    });
</script>
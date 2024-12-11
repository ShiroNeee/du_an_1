<div class="admin-product-form-container">
    <form action="?act=update-order" method="POST">
        <h3>Cập nhật đơn hàng</h3>
        <input type="hidden" name="OrderID" value="<?= $OrderDetail[0]['OrderID'] ?>">
        <input type="hidden" name="UserID" value="<?= $OrderDetail[0]['UserID'] ?>">
        <p>Ngày hiện tại: <strong><?= date("d-m-Y", strtotime($OrderDetail[0]['OrderDate'])) ?></strong></p>
        <input type="hidden" name="OrderDate" class="box" value="<?= $OrderDetail[0]['OrderDate'] ?>">

        <label>Status:</label>
        <select name="Status" class="box">
            <?php foreach ($statusorder as $status): ?>
                <option value="<?= $status['OrderID'] ?>" <?= $OrderDetail[0]['Status'] == $status['OrderID'] ? 'selected' : '' ?>>
                    <?= $status['statusName'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label>Size:</label>
        <select name="Size" class="box">
            <?php foreach ($siezs as $size): ?>
                <option value="<?= $size['SizeID'] ?>"
                    <?= $size['Size'] == $OrderDetail[0]['Size'] ? 'selected' : '' ?>>
                    <?= $size['Size'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Product ID:</label>
        <select name="ProductID" class="box">
            <?php foreach ($ProductIdOrder as $id): ?>
                <option value="<?= $id['id'] ?>" <?= $OrderDetail[0]['ProductID'] == $id['id'] ? 'selected' : '' ?> data-price="<?= $id['Price'] ?>">
                    <?= $id['id'] ?> <!-- Hiển thị ID thay vì tên sản phẩm -->
                </option>
            <?php endforeach; ?>
        </select>

        <label>Số lượng:</label>
        <input type="number" name="Quantity" class="box" value="<?= $OrderDetail[0]['Quantity'] ?>">

        <label>Tổng tiền:</label>
        <p id="totalAmount"><?= number_format($OrderDetail[0]['TotalAmount'], 0, ',', '.') ?> VND</p>
        <td>
            <?php foreach ($ProductIdOrder as $product): ?>
                <?php if ($OrderDetail[0]['ProductID'] == $product['id']): ?>
                    <img src="<?= $product['image'] ?>" alt="Product Image" style="width: 100px; height: auto;">
                <?php endif; ?>
            <?php endforeach; ?>
        </td><br>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-error" style="background-color:#f8d7da;border:0.5px solid #ddd;border-radius:6px;color:#721c24;border-color: #f5c6cb; margin-bottom:5px;font-family: Arial, sans-serif;">

                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                <small>
                    <?php
                    // Kiểm tra xem error có phải là mảng không
                    if (isset($_SESSION['error'])) {
                        if (is_array($_SESSION['error'])) {
                            // Nếu là mảng, lặp qua và hiển thị từng lỗi
                            foreach ($_SESSION['error'] as $key => $error) {
                                if (!empty($error)) {
                                    echo htmlspecialchars($error) . '<br>';
                                }
                            }
                        } else {
                            // Nếu là chuỗi, hiển thị trực tiếp
                            echo htmlspecialchars($_SESSION['error']);
                        }
                        unset($_SESSION['error']); // Xóa lỗi sau khi hiển thị
                    }
                    ?>
                </small>
            </div>
        <?php endif; ?>
        <button type="submit" class="add">Cập nhật</button>
    </form>
</div>
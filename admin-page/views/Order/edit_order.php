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
        <button type="submit" class="add">Cập nhật</button>
    </form>
</div>
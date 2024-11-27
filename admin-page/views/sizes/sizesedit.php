<!-- Trong view sizesedit.php -->
<h2>Chỉnh sửa kích cỡ</h2>
<form action="" method="post">
    <label for="productID">Sản phẩm:</label>
    <select name="productID" id="productID">
        <option value="<?php echo $product['id']; ?>" selected>
            <?php echo $product['ProductName']; ?> (Giá: <?php echo number_format($product['Price'], 0, ',', '.'); ?>)
        </option>
        <!-- Nếu bạn có nhiều sản phẩm, có thể liệt kê thêm các sản phẩm khác ở đây -->
    </select>
    <br>

    <label for="size">Kích cỡ:</label>
    <input type="text" name="size" id="size" value="<?php echo $size['Size']; ?>" required>
    <br>

    <label for="stockQuantity">Số lượng tồn kho:</label>
    <input type="number" name="stockQuantity" id="stockQuantity" value="<?php echo $size['StockQuantity']; ?>" required>
    <br>

    <button type="submit">Cập nhật</button>
</form>

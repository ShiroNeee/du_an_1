<style>
    .admin-product-form-container {
        margin: 20px auto;
        max-width: 800px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
    }

    .admin-product-form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .admin-product-form-container .form-group {
        margin-bottom: 15px;
    }

    .admin-product-form-container label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .admin-product-form-container input,
    .admin-product-form-container select,
    .admin-product-form-container button {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .admin-product-form-container button {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .admin-product-form-container button:hover {
        background-color: #0056b3;
    }
</style>

<div class="admin-product-form-container">
    <h2>Chỉnh sửa kích cỡ</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="productID">Sản phẩm:</label>
            <select name="productID" id="productID" required>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['id']; ?>"
                        <?php echo $size['ProductID'] == $product['id'] ? 'selected' : ''; ?>>
                        <?php echo $product['ProductName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="size">Kích cỡ:</label>
            <input type="text" name="size" id="size"
                value="<?php echo $size['Size']; ?>"
                placeholder="Nhập kích cỡ mới"
                required>
        </div>

        <div class="form-group">
            <label for="stockQuantity">Số lượng tồn kho:</label>
            <input type="number" name="stockQuantity" id="stockQuantity"
                value="<?php echo $size['StockQuantity']; ?>"
                placeholder="Nhập số lượng tồn kho mới"
                min="0"
                required>
        </div>

        <button type="submit">Cập nhật</button>
    </form>
</div>
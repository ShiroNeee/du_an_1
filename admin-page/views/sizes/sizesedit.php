<!-- View: sizesedit.php -->

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Kích Cỡ</title>
    <style>
        .showErrorMessage {
            background-color: #f8d7da;
            color: red;
            border: 1px solid #f5c2c7;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            width: 90%;
        }

        .showErrorMessage ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .showErrorMessage li {
            margin-bottom: 5px;
        }

        .admin-product-form-container {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .admin-product-form-container h3 {
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

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .size-field {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .size-field .form-group {
            flex: 1;
            min-width: 45%;
        }
    </style>
</head>

<body>
    <div class="admin-product-form-container">
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="showErrorMessage">
                <ul>
                    <?php foreach ($_SESSION['error'] as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="" method="POST">
            <h3>Chỉnh sửa Kích Cỡ</h3>

            <div class="form-group">
                <label for="productID">Chọn Sản Phẩm:</label>
                <select class="form-control" name="productID" required>
                    <option value="<?= $size['ProductID']; ?>" selected>
                        <?= $productName ?> (Giá: <?= number_format($currentPrice, 0, ',', '.') ?>)
                    </option>
                    <?php
                    // Giả sử $products là danh sách sản phẩm đã được lấy từ database
                    foreach ($products as $product) {
                        echo "<option value='" . $product['id'] . "'>" . $product['ProductName'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div id="size-fields">
                <div class="size-field">
                    <div class="form-group">
                        <label for="size[]">Kích Cỡ:</label>
                        <input type="text" class="form-control" name="size[]" value="<?= $size['Size']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="stockQuantity[]">Số Lượng Tồn:</label>
                        <input type="number" class="form-control" name="stockQuantity[]" value="<?= $size['StockQuantity']; ?>" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="price[]">Giá:</label>
                        <input type="number" class="form-control" name="price[]" value="<?= $size['Price']; ?>" min="1" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>

    <script>
        function addSizeField() {
            var sizeField = document.createElement('div');
            sizeField.classList.add('size-field');
            sizeField.innerHTML = ` 
                <div class="form-group">
                    <label for="size[]">Kích Cỡ:</label>
                    <input type="text" class="form-control" name="size[]" placeholder="Nhập kích cỡ" required>
                </div>
                <div class="form-group">
                    <label for="stockQuantity[]">Số Lượng Tồn:</label>
                    <input type="number" class="form-control" name="stockQuantity[]" placeholder="Nhập số lượng" min="1" required>
                </div>
                <div class="form-group">
                    <label for="price[]">Giá:</label>
                    <input type="number" class="form-control" name="price[]" placeholder="Nhập giá" min="1" required>
                </div>
            `;
            document.getElementById('size-fields').appendChild(sizeField);
        }
    </script>
</body>

</html>

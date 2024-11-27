<div class="container">
    <h2>Thêm Kích Cỡ Mới</h2>

    <form action="" method="POST">
        <div class="form-group">
            <label for="productID">Chọn Sản Phẩm:</label>
            <select class="form-control" name="productID" required>
                <?php
                    // Duyệt qua danh sách sản phẩm và hiển thị chúng trong dropdown
                    foreach ($products as $product) {
                        echo "<option value='" . $product['id'] . "'>" . $product['ProductName'] . "</option>";
                    }
                ?>
            </select>
        </div>

        <!-- Nhóm các input cho kích cỡ và số lượng tồn kho -->
        <div id="size-fields">
            <div class="size-field">
                <div class="form-group">
                    <label for="size[]">Kích Cỡ:</label>
                    <input type="text" class="form-control" name="size[]" required>
                </div>
                <div class="form-group">
                    <label for="stockQuantity[]">Số Lượng Tồn:</label>
                    <input type="number" class="form-control" name="stockQuantity[]" required>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" onclick="addSizeField()">Thêm Kích Cỡ</button>
        <button type="submit" class="btn btn-primary">Thêm Mới</button>
    </form>
</div>

<script>
function addSizeField() {
    var sizeField = document.createElement('div');
    sizeField.classList.add('size-field');
    sizeField.innerHTML = `
        <div class="form-group">
            <label for="size[]">Kích Cỡ:</label>
            <input type="text" class="form-control" name="size[]" required>
        </div>
        <div class="form-group">
            <label for="stockQuantity[]">Số Lượng Tồn:</label>
            <input type="number" class="form-control" name="stockQuantity[]" required>
        </div>
    `;
    document.getElementById('size-fields').appendChild(sizeField);
}
</script>

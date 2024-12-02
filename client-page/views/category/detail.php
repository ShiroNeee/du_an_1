<?php if ($product): ?>
    <div class="container mt-5">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <div class="product-image-container">
                    <img src="<?= htmlspecialchars($product['image'] ?? 'no-image.jpg'); ?>"
                        alt="<?= htmlspecialchars($product['ProductName'] ?? 'Sản phẩm không tồn tại'); ?>"
                        class="img-fluid rounded shadow-sm" width="75%">
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h2 class="fw-bold text-dark"><?= htmlspecialchars($product['ProductName'] ?? 'Không có sản phẩm'); ?></h2>
                <p class="text-muted"><strong>Giá:</strong>
                    <span class="text-danger" id="price"><?= number_format($product['Price'] ?? 0, 0, ',', '.'); ?> VND</span>
                </p>

                <?php
                $outOfStock = true;
                if (!empty($productSizes) && is_array($productSizes)) {
                    foreach ($productSizes as $size) {
                        if ($size['StockQuantity'] > 0) {
                            $outOfStock = false;
                            break;
                        }
                    }
                }
                ?>

                <!-- Nếu hết hàng, thay đổi nền -->
                <?php if ($outOfStock): ?>
                    <div class="alert alert-warning mb-4" role="alert">
                        <strong>Sản phẩm hết hàng!</strong> Xin vui lòng chọn sản phẩm khác hoặc liên hệ chúng tôi để biết thêm chi tiết.
                    </div>
                <?php endif; ?>

                <!-- Danh sách kích thước và tồn kho -->
                !-- Danh sách kích thước và tồn kho -->
                <div class="mt-4">
                    <h5 class="fw-bold">Kích Cỡ và Số Lượng</h5>
                    <div class="mb-3">
                        <select name="Size" id="sizeSelect" class="form-select" required <?= $outOfStock ? 'disabled' : ''; ?>>
                            <option value="">Chọn kích cỡ</option>
                            <?php if (!empty($productSizes) && is_array($productSizes)): ?>
                                <?php foreach ($productSizes as $size): ?>
                                    <?php if ($size['StockQuantity'] > 0): ?>
                                        <option value="<?= htmlspecialchars($size['Size'] ?? 'Không xác định'); ?>"
                                            data-price="<?= htmlspecialchars($size['Price'] ?? 0); ?>"
                                            data-stock="<?= htmlspecialchars($size['StockQuantity'] ?? 0); ?>"
                                            data-size-id="<?= htmlspecialchars($size['SizeID']); ?>">
                                            <?= htmlspecialchars($size['Size'] ?? 'Không xác định'); ?> - Số lượng: <?= htmlspecialchars($size['StockQuantity'] ?? 0); ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="">Không có kích cỡ</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Số lượng, chỉ hiển thị sau khi chọn kích cỡ -->
                    <div id="quantitySection" style="display: none;">
                        <label for="quantity" class="form-label">Số lượng sản phẩm: </label>
                        <div class="input-group mb-3">
                            <button type="button" class="btn btn-outline-secondary" id="decreaseQuantity">-</button>
                            <input type="number" name="Quantity" id="quantity" class="form-control text-center" min="1" value="1" readonly>
                            <button type="button" class="btn btn-outline-secondary" id="increaseQuantity">+</button>
                        </div>
                    </div>
                </div>
                <form method="POST" action="?act=add-order" class="m-0" id="add-to-cart-form">
                    <input type="hidden" name="ProductID" value="<?= $product['id']; ?>">
                    <input type="hidden" name="SizeID" id="selectedSizeID" value="">
                    <input type="hidden" name="TotalPrice" id="totalPriceField" value="">
                    <button type="submit" class="btn btn-primary btn-lg" <?= $outOfStock ? 'disabled' : ''; ?>>Thêm vào giỏ hàng</button>
                </form>

            </div>

            <!-- Mô tả sản phẩm -->
            <div class="mt-4">
                <h5 class="fw-bold">Mô tả sản phẩm</h5>
                <p class="text-muted"><?= nl2br(htmlspecialchars($product['Description'] ?? 'Không có mô tả cho sản phẩm này.')); ?></p>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold">Chia sẻ:</h5>
                <a href="#" class="btn btn-outline-primary btn-lg me-2"><i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i> Facebook</a>
                <a href="#" class="btn btn-outline-info btn-lg me-2"><i class="fab fa-twitter fa-lg" style="color: #55acee;"></i> Twitter</a>
                <a href="#" class="btn btn-outline-danger btn-lg"><i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i> Instagram</a>
            </div>
        </div>
    </div>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            Không tìm thấy sản phẩm.
        </div>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h4 class="fw-bold">Có thể bạn quan tâm</h4>
    <div class="row g-3">
        <?php foreach ($randomProducts as $randomProduct): ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm h-100">
                    <img src="<?= htmlspecialchars($randomProduct['image']) ?>"
                        alt="<?= htmlspecialchars($randomProduct['ProductName']) ?>"
                        class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($randomProduct['ProductName']) ?></h5>
                        <p class="card-text text-danger"><?= number_format($randomProduct['Price'], 0, ',', '.') ?> VND</p>
                        <a href="?act=detail&id=<?= $randomProduct['id'] ?>" class="btn btn-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    document.getElementById('sizeSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stockQuantity = selectedOption ? parseInt(selectedOption.getAttribute('data-stock')) : 0;
        const selectedSizeID = selectedOption ? selectedOption.getAttribute('data-size-id') : '';

        if (!selectedSizeID) {
            alert('Vui lòng chọn kích cỡ!');
            return; // Nếu chưa chọn kích cỡ, ngừng tính toán giá và không cho phép tiếp tục.
        }

        const basePrice = <?= $product['Price'] ?? 0 ?>;

        // Tạo phần trăm ngẫu nhiên từ 5% đến 15%
        const randomPercent = Math.floor(Math.random() * (15 - 5 + 1)) + 5; // random từ 5% đến 15%
        const sizePrice = basePrice * (randomPercent / 100); // Tính phần giá tăng thêm

        const totalPrice = basePrice + sizePrice; // Tính giá mới

        // Cập nhật giá hiển thị
        document.getElementById('price').textContent = totalPrice > 0 ? totalPrice.toLocaleString() + ' VND' : 'Không có giá';

        // Hiển thị phần số lượng khi chọn kích cỡ
        document.getElementById('quantitySection').style.display = 'block';

        // Cập nhật lại giá tiền khi thay đổi kích cỡ
        updateTotalPrice();

        // Cập nhật số lượng tối đa có thể chọn
        const quantityInput = document.getElementById('quantity');
        quantityInput.max = stockQuantity; // Cập nhật số lượng tối đa

        // Reset giá trị số lượng nếu người dùng chọn kích cỡ khác với số lượng đã chọn lớn hơn kho
        if (parseInt(quantityInput.value) > stockQuantity) {
            quantityInput.value = stockQuantity; // Đặt lại số lượng về số lượng tối đa
        }

        // Cập nhật giá trị SizeID trong form
        document.getElementById('selectedSizeID').value = selectedSizeID;
    });


    document.getElementById('quantity').addEventListener('input', function() {
        const quantity = parseInt(this.value);
        const maxQuantity = parseInt(this.max);

        // Nếu số lượng vượt quá số lượng trong kho, hiển thị lỗi
        if (quantity > maxQuantity) {
            alert("Số lượng vượt quá số lượng trong kho. Vui lòng chọn lại.");
            this.value = maxQuantity; // Reset lại số lượng
        }

        updateTotalPrice(); // Cập nhật lại tổng giá
    });

    function updateTotalPrice() {
        const quantity = parseInt(document.getElementById('quantity').value);
        const selectedOption = document.getElementById('sizeSelect').options[document.getElementById('sizeSelect').selectedIndex];

        // Kiểm tra xem người dùng đã chọn kích cỡ chưa
        if (!selectedOption || !selectedOption.getAttribute('data-size-id')) {
            document.getElementById('price').textContent = 'Vui lòng chọn kích cỡ!';
            return; // Ngừng nếu chưa chọn kích cỡ
        }

        const stockQuantity = selectedOption ? parseInt(selectedOption.getAttribute('data-stock')) : 0;

        // Lấy giá gốc và tính phần trăm ngẫu nhiên từ 5%-15%
        const basePrice = <?= $product['Price'] ?? 0 ?>;
        const randomPercent = Math.floor(Math.random() * (15 - 5 + 1)) + 5; // random từ 5% đến 15%
        const sizePrice = basePrice * (randomPercent / 100); // Tính phần giá tăng thêm

        const totalPrice = (basePrice + sizePrice) * quantity; // Tính giá tổng

        // Hiển thị giá cập nhật
        document.getElementById('price').textContent = totalPrice > 0 ? totalPrice.toLocaleString() + ' VND' : 'Không có giá';
        // Cập nhật giá trị tổng tiền vào trường ẩn trong form
        document.getElementById('totalPriceField').value = totalPrice.toFixed(2);
    }


    // Nút cộng, trừ số lượng
    document.getElementById('increaseQuantity').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        const maxQuantity = parseInt(quantityInput.max); // Lấy số lượng tối đa
        if (parseInt(quantityInput.value) < maxQuantity) {
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotalPrice();
        } else {
            alert("Số lượng đã đạt mức tối đa trong kho.");
        }
    });


    document.getElementById('decreaseQuantity').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateTotalPrice();
        }
    });
    document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
        const quantityInput = document.getElementById('quantity');
        const quantityValue = quantityInput.value;

        // Tạo trường hidden cho quantity để gửi cùng với form
        let quantityField = document.createElement('input');
        quantityField.type = 'hidden';
        quantityField.name = 'Quantity';
        quantityField.value = quantityValue;

        // Thêm trường quantity vào form
        this.appendChild(quantityField);
    });
</script>
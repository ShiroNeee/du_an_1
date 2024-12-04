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
    </div>
    <?php else: ?>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            Không tìm thấy sản phẩm.
        </div>
    </div>
<?php endif; ?>
<div class="container mt-5">
    <h4 class="fw-bold">Bình luận về sản phẩm</h4>
    <div class="mt-4">
        <?php if (!empty($comments) && is_array($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="mb-3 p-3 border rounded">
                    <strong><?= htmlspecialchars($comment['UserName']); ?></strong>
                    <p class="mb-1 text-muted"><?= nl2br(htmlspecialchars($comment['Content'])); ?></p>
                    <small class="text-secondary"><?= htmlspecialchars($comment['date']); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
        <?php endif; ?>
    </div>
    <!-- Form nhập bình luận -->
    <?php if ($isLoggedIn): ?>
        <form method="POST" action="">
            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($errorMessage); ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="comment" class="form-label">Viết bình luận của bạn:</label>
                <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
        </form>
    <?php else: ?>
        <p class="text-danger">Vui lòng <a href="?act=login">đăng nhập</a> để bình luận.</p>
    <?php endif; ?>
</div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const sizeSelect = document.getElementById('sizeSelect');
        const quantitySection = document.getElementById('quantitySection');
        const priceDisplay = document.getElementById('price');
        const totalPriceField = document.getElementById('totalPriceField');
        const increaseBtn = document.getElementById('increaseQuantity');
        const decreaseBtn = document.getElementById('decreaseQuantity');
        const form = document.getElementById('add-to-cart-form');

        sizeSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const stockQuantity = parseInt(selectedOption?.getAttribute('data-stock') || 0);
            const selectedSizeID = selectedOption?.getAttribute('data-size-id') || '';

            if (!selectedSizeID) {
                alert('Vui lòng chọn kích cỡ!');
                return;
            }

            quantitySection.style.display = 'block';
            quantityInput.max = stockQuantity;
            quantityInput.value = Math.min(parseInt(quantityInput.value), stockQuantity);
            document.getElementById('selectedSizeID').value = selectedSizeID;
            updateTotalPrice();
        });

        quantityInput.addEventListener('input', function() {
            const quantity = Math.min(parseInt(this.value), parseInt(this.max));
            if (quantity !== parseInt(this.value)) alert("Số lượng vượt quá số lượng trong kho.");
            this.value = quantity;
            updateTotalPrice();
        });

        increaseBtn.addEventListener('click', function() {
            // Không kiểm tra giới hạn kho nữa, chỉ tăng số lượng
            quantityInput.value++;
            updateTotalPrice();
        });

        decreaseBtn.addEventListener('click', function() {
            if (parseInt(quantityInput.value) > 1) quantityInput.value--;
            updateTotalPrice();
        });

        form.addEventListener('submit', function(event) {
            const selectedSizeID = document.getElementById('selectedSizeID').value;

            // Nếu chưa chọn kích cỡ, hiển thị thông báo và ngừng submit form
            if (!selectedSizeID) {
                alert('Vui lòng chọn kích cỡ sản phẩm trước khi thêm vào giỏ hàng!');
                event.preventDefault(); // Ngừng gửi form
            } else {
                let quantityField = document.createElement('input');
                quantityField.type = 'hidden';
                quantityField.name = 'Quantity';
                quantityField.value = quantityInput.value;
                this.appendChild(quantityField);
            }
        });

        function updateTotalPrice() {
            const quantity = parseInt(quantityInput.value);
            const basePrice = <?= $product['Price'] ?? 0 ?>;
            const totalPrice = basePrice * quantity;
            priceDisplay.textContent = totalPrice > 0 ? totalPrice.toLocaleString() + ' VND' : 'Không có giá';
            totalPriceField.value = totalPrice.toFixed(2);
        }
    });
</script>
<?php if ($product): ?>
    <style>
        /* Các phần CSS đã có trong mã của bạn */
        .size-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .size-button.selected {
            background-color: #2980b9;
            color: white;
        }

        .size-button:hover {
            background-color: #ddd;
        }

        /* Hiển thị thông tin giá và tồn kho */
        .price-stock {
            margin-top: 15px;
            font-size: 1.2rem;
            color: #333;
        }

        .btn-add-to-cart {
            font-size: 1rem;
            padding: 10px 20px;
            color: #fff;
            background-color: #27ae60;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-add-to-cart:hover {
            background-color: #2ecc71;
            transform: scale(1.05);
        }
    </style>

    <div class="container mt-5">
        <div class="product-container">
            <!-- Hình ảnh sản phẩm -->
            <div class="product-image">
                <img src="<?= htmlspecialchars($product['image'] ?? 'no-image.jpg'); ?>" 
                     alt="<?= htmlspecialchars($product['ProductName'] ?? 'Sản phẩm không tồn tại'); ?>">
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="product-details">
                <h2><?= htmlspecialchars($product['ProductName'] ?? 'Không có sản phẩm'); ?></h2>

                <!-- Hiển thị nút chọn kích thước -->
                <div class="size-selection">
                    <h4><strong>Kích Cỡ:</strong></h4>
                    <?php if (!empty($productSizes) && is_array($productSizes)): ?>
                        <div class="size-options">
                            <?php 
                            foreach ($productSizes as $size): ?>
                                <button class="size-button" 
                                        data-size="<?= $size['Size']; ?>" 
                                        data-price="<?= $size['Price']; ?>" 
                                        data-stock="<?= $size['StockQuantity']; ?>"
                                        onclick="updateProductDetails(this)">
                                    <?= htmlspecialchars($size['Size']); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Không có kích cỡ nào cho sản phẩm này.</p>
                    <?php endif; ?>
                </div>

                <!-- Hiển thị giá và số lượng tồn kho -->
                <div class="price-stock">
                    <p><strong>Giá:</strong> <span id="product-price"><?= number_format($product['Price'] ?? 0, 0, ',', '.'); ?> VND</span></p>
                    <p><strong>Số lượng tồn kho:</strong> <span id="product-stock">0</span></p>
                </div>

                <!-- Thêm vào giỏ hàng -->
                <a href="#" class="btn-add-to-cart" id="add-to-cart-btn">
                    <i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng
                </a>

                <!-- Mô tả sản phẩm -->
                <div class="product-description">
                    <h5>Mô tả sản phẩm</h5>
                    <p><?= nl2br(htmlspecialchars($product['Description'] ?? 'Không có mô tả cho sản phẩm này.')); ?></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Hàm cập nhật thông tin sản phẩm khi chọn kích thước
    function updateProductDetails(selectedSizeElement) {
        const size = selectedSizeElement.getAttribute('data-size');
        const price = selectedSizeElement.getAttribute('data-price');
        const stock = selectedSizeElement.getAttribute('data-stock');

        // Cập nhật giá và số lượng tồn kho
        document.getElementById('product-price').innerText = price.toLocaleString() + ' VND';
        document.getElementById('product-stock').innerText = stock;

        // Cập nhật URL "Thêm vào giỏ hàng" với thông tin kích cỡ và tồn kho
        document.getElementById('add-to-cart-btn').href = '?ac=?act=cartshop=product_id=<?= urlencode($product['id']); ?>&size=' + encodeURIComponent(size) + '&stock=' + stock;

        // Xử lý lớp 'selected' cho các nút kích cỡ
        const allSizeButtons = document.querySelectorAll('.size-button');
        allSizeButtons.forEach(button => button.classList.remove('selected')); // Loại bỏ lớp selected khỏi tất cả các kích cỡ
        selectedSizeElement.classList.add('selected'); // Thêm lớp 'selected' cho kích cỡ người dùng chọn
    }

    // Khi trang được tải, tự động chọn kích thước đầu tiên
    window.onload = function() {
        const firstSizeButton = document.querySelector('.size-button');
        if (firstSizeButton) {
            updateProductDetails(firstSizeButton); // Gọi hàm update cho kích thước đầu tiên
            firstSizeButton.classList.add('selected'); // Thêm lớp 'selected' cho kích thước đầu tiên
        }
    };
</script>


<?php else: ?>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            Không tìm thấy sản phẩm.
        </div>
    </div>
<?php endif; ?>


<!-- Phần sản phẩm liên quan -->
<div class="related-products">
    <h4>Có thể bạn quan tâm</h4>
    <div class="product-container">
        <?php foreach ($randomProducts as $product): ?>
            <div class="product-item">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['ProductName']) ?>">
                <h5><?= htmlspecialchars($product['ProductName']) ?></h5>
                <p><?= number_format($product['Price'], 0, ',', '.') ?> VND</p>
                <a href="?act=detail&id=<?= $product['id'] ?>" class="btn-add-to-cart">
                    Xem chi tiết
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

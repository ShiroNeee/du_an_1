<?php if ($product): ?>
    <style>
        /* Tùy chỉnh CSS để bố trí layout */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        .product-image {
            flex: 1;
            max-width: 45%;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .product-image img:hover {
            transform: scale(1.05);
        }
        .product-details {
            flex: 1;
            max-width: 50%;
        }
        .product-details h2 {
            color: #2980b9;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .product-details p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 15px;
            color: #555;
        }

        /* Phần CSS cho sao đánh giá */
        .rating {
            display: flex;
            align-items: center;
            font-size: 1.4rem;
            color: #f39c12;
            margin-bottom: 20px;
        }
        .rating i {
            margin-right: 5px;
        }
        .rating .stars {
            display: flex;
            margin-right: 15px;
        }
        .rating .stars i {
            font-size: 1.8rem;
        }

        /* Danh sách kích thước và tồn kho */
        .sizes-list ul {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }
        .sizes-list ul li {
            font-size: 1.1rem;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        /* Thêm vào giỏ hàng */
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

        /* Phần CSS cho mô tả sản phẩm */
        .product-description {
            margin-top: 30px;
            font-size: 1rem;
            line-height: 1.6;
            color: #333;
        }

        /* Phần CSS cho sản phẩm liên quan */
        .related-products {
            margin-top: 40px;
        }
        .related-products h4 {
            color: #007bff;
        }
        .related-products .product-item {
            display: inline-block;
            width: 22%;
            margin-right: 2%;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            transition: transform 0.3s ease-in-out;
        }
        .related-products .product-item:hover {
            transform: scale(1.05);
        }
        .related-products .product-item img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 5px;
        }
        .related-products .product-item h5 {
            font-size: 1.1rem;
            color: #007bff;
            margin-top: 10px;
        }
        .related-products .product-item p {
            font-size: 1rem;
            color: #333;
        }

        /* Phần CSS cho chia sẻ mạng xã hội */
        .social-share a {
            text-decoration: none;
            margin-right: 15px;
            color: #333;
            font-size: 1.6rem;
            transition: color 0.3s;
        }
        .social-share a:hover {
            color: #2980b9;
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
                <p><strong>Giá:</strong> <?= number_format($product['Price'] ?? 0, 0, ',', '.'); ?> VND</p>

                <!-- Đánh giá -->
                <!-- Danh sách kích thước và tồn kho -->
                <div class="sizes-list mt-4">
                    <h4><strong>Kích Cỡ và Số Lượng Tồn Kho</strong></h4>
                    <?php if (!empty($productSizes) && is_array($productSizes)): ?>
                        <ul>
                            <?php foreach ($productSizes as $size): ?>
                                <li>
                                    <span>
                                        <strong><?= htmlspecialchars($size['Size'] ?? 'Không xác định'); ?></strong> - 
                                        Số lượng tồn kho: <?= htmlspecialchars($size['StockQuantity'] ?? 0); ?>
                                    </span>
                                    <a href="?ac=?act=cartshop=product_id=<?= urlencode($product['id']); ?>&size=<?= urlencode($size['Size']); ?>&stock=<?= urlencode($size['StockQuantity']); ?>" 
                                       class="btn-add-to-cart">
                                        <i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Không có kích cỡ nào cho sản phẩm này.</p>
                    <?php endif; ?>
                </div>
                
                <!-- Mô tả sản phẩm -->
                <div class="product-description">
                    <h5>Mô tả sản phẩm</h5>
                    <p><?= nl2br(htmlspecialchars($product['Description'] ?? 'Không có mô tả cho sản phẩm này.')); ?></p>
                </div>
                
                <!-- Chia sẻ sản phẩm -->
                <div class="social-share mt-4">
                    <h5>Chia sẻ:</h5>
                    <a href="#" class="social-link"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="social-link"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fa fa-instagram"></i></a>
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




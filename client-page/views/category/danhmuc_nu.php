<?php if ($product): ?>
    <div class="container mt-5">
        <div class="row">
            <!-- Product Detail Card -->
            <div class="col-md-6">
                <div class="card shadow-lg" style="border-radius: 10px;">
                    <!-- Hình ảnh sản phẩm -->
                    <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['ProductName']); ?>" class="card-img-top" style="height: 300px; object-fit: contain; border-radius: 10px;">
                    <div class="card-body">
                        <h2 class="card-title text-center text-primary"><?= htmlspecialchars($product['ProductName']); ?></h2>
                        
                        <!-- Hiển thị thông tin sản phẩm -->
                        <p class="card-text text-muted text-center"><strong>Giá:</strong> <?= number_format($product['Price']); ?> VND</p>
                        <p class="card-text"><strong>Danh mục:</strong> <?= htmlspecialchars($product['CategoryName']); ?></p>
                        <p class="card-text"><strong>Trạng thái:</strong> <?= htmlspecialchars($product['statusName']); ?></p>

                        <!-- Button để thêm vào giỏ hàng -->
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-success btn-lg">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description (Thêm phần mô tả) -->
            <div class="col-md-6">
                <div class="card shadow-lg" style="border-radius: 10px;">
                    <div class="card-body">
                        <h4 class="card-title text-center text-info">Mô tả sản phẩm</h4>
                        <p class="card-text"><?= nl2br(htmlspecialchars($product['Description'])); ?></p>
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

<!-- //////////// -->
<h3>Kích Cỡ và Số Lượng Tồn Kho</h3>
    
    <?php if ($productSizes): ?>
        <ul>
            <?php foreach ($productSizes as $size): ?>
                <li>
                    <strong><?php echo htmlspecialchars($size['Size']); ?></strong> - 
                    Số lượng tồn kho: <?php echo htmlspecialchars($size['StockQuantity']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Không có kích cỡ nào cho sản phẩm này.</p>
    <?php endif; ?>







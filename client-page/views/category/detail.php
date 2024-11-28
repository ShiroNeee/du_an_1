<?php if ($product): ?>
    <div class="container mt-5">
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6 mb-4">
                <img src="<?= htmlspecialchars($product['image'] ?? 'no-image.jpg'); ?>" 
                    alt="<?= htmlspecialchars($product['ProductName'] ?? 'Sản phẩm không tồn tại'); ?>" 
                    class="img-fluid rounded shadow-sm">
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h2 class="fw-bold"><?= htmlspecialchars($product['ProductName'] ?? 'Không có sản phẩm'); ?></h2>
                <p><strong>Giá:</strong> 
                    <span class="text-danger"><?= number_format($product['Price'] ?? 0, 0, ',', '.'); ?> VND</span>
                </p>

                <!-- Danh sách kích thước và tồn kho -->
                <div class="mt-4">
                    <h5 class="fw-bold">Kích Cỡ và Số Lượng Tồn Kho</h5>
                    <?php if (!empty($productSizes) && is_array($productSizes)): ?>
                        <ul class="list-group">
                            <?php
                            $validSizes = array_filter($productSizes, function ($size) {
                                return isset($size['StockQuantity']) && $size['StockQuantity'] > 0;
                            });

                            if (!empty($validSizes)):
                                foreach ($validSizes as $size): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            <strong><?= htmlspecialchars($size['Size'] ?? 'Không xác định'); ?></strong> - 
                                            Số lượng: <?= htmlspecialchars($size['StockQuantity'] ?? 0); ?>
                                        </span>
                                        <form method="POST" action="?act=add-order" class="m-0">
                                            <input type="hidden" name="ProductID" value="<?= $product['id']; ?>">
                                            <button type="submit" class="btn btn-primary btn-sm">Thêm vào giỏ hàng</button>
                                        </form>
                                    </li>
                                <?php endforeach;
                            else: ?>
                                <p class="text-muted">Không có kích cỡ nào cho sản phẩm này.</p>
                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Không có kích cỡ nào cho sản phẩm này.</p>
                    <?php endif; ?>
                </div>

                <!-- Mô tả sản phẩm -->
                <div class="mt-4">
                    <h5 class="fw-bold">Mô tả sản phẩm</h5>
                    <p><?= nl2br(htmlspecialchars($product['Description'] ?? 'Không có mô tả cho sản phẩm này.')); ?></p>
                </div>

                <!-- Chia sẻ sản phẩm -->
                <div class="mt-4">
                    <h5 class="fw-bold">Chia sẻ:</h5>
                    <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i> Facebook</a>
                    <a href="#" class="btn btn-outline-info btn-sm me-2"> <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i></i> Twitter</a>
                    <a href="#" class="btn btn-outline-danger btn-sm"> <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i></i> Instagram</a>
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

<!-- Sản phẩm liên quan -->
<div class="container mt-5">
    <h4 class="fw-bold">Có thể bạn quan tâm</h4>
    <div class="row g-3">
        <?php foreach ($randomProducts as $product): ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm h-100">
                    <img src="<?= htmlspecialchars($product['image']) ?>" 
                        alt="<?= htmlspecialchars($product['ProductName']) ?>" 
                        class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['ProductName']) ?></h5>
                        <p class="card-text text-danger"><?= number_format($product['Price'], 0, ',', '.') ?> VND</p>
                        <a href="?act=detail&id=<?= $product['id'] ?>" class="btn btn-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

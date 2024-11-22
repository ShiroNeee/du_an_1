<section class="products py-5">
    <div class="container">
        <h2>Sản phẩm <?= isset($categoryInfo) ? 'thuộc danh mục: ' . htmlspecialchars($categoryInfo['categoryName']) : 'mới nhất'; ?></h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php if (!empty($latestProductsHome)): ?>
                <?php foreach ($latestProductsHome as $product): ?>
                    <div class="col">
                        <div class="product-item text-center">
                            <!-- Hiển thị ảnh sản phẩm -->
                            <img src="<?= htmlspecialchars($product['image']); ?>" class="img-fluid" alt="<?= htmlspecialchars($product['ProductName']); ?>">
                            <h3><?= htmlspecialchars($product['ProductName']); ?></h3>
                            <!-- Hiển thị giá sản phẩm -->
                            <p><?= number_format($product['Price'], 0, ',', '.'); ?>₫</p>
                            <!-- Hiển thị mô tả ngắn -->
                            <p><?= htmlspecialchars($product['Description']); ?></p>
                            <!-- Nút thêm vào giỏ hoặc xem chi tiết -->
                            <a href="<?= $product['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Hiện tại chưa có sản phẩm.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="#"><button class="btn btn-secondary">Xem thêm</button></a>
        </div>
    </div>
</section>
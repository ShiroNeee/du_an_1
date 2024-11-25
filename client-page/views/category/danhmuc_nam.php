<section class="products py-5">
    <div class="container">
        <h2>Sản phẩm theo danh mục</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php if (!empty($productsList) && count($productsList) > 0): ?>
                <?php foreach ($productsList as $product): ?>
                    <div class="col">
                        <div class="product-item text-center">
                            <!-- Hiển thị ảnh sản phẩm -->
                            <img src="<?= $product['image']; ?>" class="img-fluid" alt="<?= htmlspecialchars($product['ProductName']); ?>">
                            <h3><?= htmlspecialchars($product['ProductName']); ?></h3>
                            <!-- Hiển thị giá sản phẩm -->
                            <p><?= number_format($product['Price'], 0, ',', '.'); ?>₫</p>
                            <!-- Hiển thị mô tả ngắn -->
                            <p><?= htmlspecialchars($product['Description']); ?></p>
                            <!-- Nút thêm vào giỏ hoặc xem chi tiết -->
                            <a href="?act=productdetail&id=<?= $product['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có sản phẩm trong danh mục này.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="#"><button class="btn btn-secondary">Xem thêm</button></a>
        </div>
    </div>
</section>

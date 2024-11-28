<!-- main.php -->
<main>
  <header>
    <div class="banner-content">
      <div class="image-section">
        <!-- Slider -->
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../client-page/images/banner.jpg" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
              <img src="../client-page/images/banner-2.jpg" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
              <img src="../client-page/images/banner-3.jpg" class="d-block w-100" alt="Banner 3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="d-flex justify-content-around align-items-start my-3">
      <div class="d-flex">
        <i class="fa-solid fa-comments-dollar me-3"></i>
        <div>
          <h4>Thanh toán khi nhận hàng (COD)</h4>
          <p class="text-muted mb-1">Giao hàng toàn quốc.</p>
        </div>
      </div>
      <div class="d-flex ">
        <i class="fa-solid fa-truck-moving me-3"></i>
        <div>
          <h4>Miễn phí giao hàng</h4>
          <p class="text-muted mb-1">Với đơn hàng trên 599.000đ.</p>
        </div>
      </div>
      <div class="d-flex ">
        <i class="fa-solid fa-box-open me-3"></i>
        <div>
          <h4>Đổi hàng miễn phí</h4>
          <p class="text-muted mb-1">Trong 15 ngày kể từ ngày mua.</p>
        </div>
      </div>
    </div>
  </div>
  <hr>
   <!-- Product Section -->
   <section class="products py-5 bg-light">
    <div class="container">
      <h2 class="text-center fw-bold mb-4">Sản phẩm mới nhất</h2>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php if (!empty($latestProductsHome) && count($latestProductsHome) > 0): ?>
          <?php foreach ($latestProductsHome as $product): ?>
            <div class="col">
              <div class="card h-100 text-center shadow-sm d-flex flex-column justify-content-between">
                <img src="<?= htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['ProductName']); ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($product['ProductName']); ?></h5>
                  <p class="card-text text-danger fw-bold"><?= number_format($product['Price'], 0, ',', '.'); ?>₫</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                  <a href="?act=detail&id=<?= $product['id']; ?>" class="btn btn-primary w-75 mx-auto">Xem chi tiết</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-center">Hiện tại chưa có sản phẩm mới.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Promotion Banner -->
  <div class="container my-5">
    <a href="#">
      <img src="../client-page/images/img sale.png" class="img-fluid rounded shadow-sm" alt="Khuyến mãi">
    </a>
  </div>

  <!-- Repeat Product Section -->
   <section class="products py-5 bg-light">
    <div class="container">
      <h2 class="text-center fw-bold mb-4">Đồ nỉ mới cập nhật</h2>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php if (!empty($latestProductsHome) && count($latestProductsHome) > 0): ?>
          <?php foreach ($latestProductsHome as $product): ?>
            <div class="col">
              <div class="card h-100 text-center shadow-sm d-flex flex-column justify-content-between">
                <img src="<?= htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['ProductName']); ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($product['ProductName']); ?></h5>
                  <p class="card-text text-danger fw-bold"><?= number_format($product['Price'], 0, ',', '.'); ?>₫</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                  <a href="?act=detail&id=<?= $product['id']; ?>" class="btn btn-primary w-75 mx-auto">Xem chi tiết</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-center">Hiện tại chưa có sản phẩm mới.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>
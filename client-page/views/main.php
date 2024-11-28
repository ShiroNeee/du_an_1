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
  <section class="products py-5">
    <div class="container">
      <h2>Sản phẩm mới nhất</h2>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php if ($latestProductsHome && count($latestProductsHome) > 0): ?>
          <?php foreach ($latestProductsHome as $product): ?>
            <div class="col">
              <div class="product-item text-center">
                <!-- Hiển thị ảnh sản phẩm -->
                <img src="<?= $product['image']; ?>" class="img-fluid" alt="<?= htmlspecialchars($product['ProductName']); ?>">
                <h3><?= htmlspecialchars($product['ProductName']); ?></h3>
                <!-- Hiển thị giá sản phẩm -->
                <p class="fw-bold"><?= number_format($product['Price'], 0, ',', '.'); ?>₫</p>

                <!-- Nút thêm vào giỏ hoặc xem chi tiết -->
                <a href="=<?= $product['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Hiện tại chưa có sản phẩm mới.</p>
        <?php endif; ?>
      </div>
      <div class="text-center mt-4">
        <a href="#"><button class="btn btn-secondary">Xem thêm</button></a>
      </div>
    </div>
  </section>
  <hr class="container pt-5">
  <div class="container">
    <a href="#">
      <img src="../client-page/images/img sale.png" class="d-block w-100">
    </a>
  </div>

  <section class="products py-5">
    <div class="container">
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php if (!empty($latestProductsHome) && count($latestProductsHome) > 0): ?>
          <?php foreach ($latestProductsHome as $product): ?>
            <div class="col">
              <div class="product-item text-center">
                <!-- Hiển thị ảnh sản phẩm -->
                <div class="card position-relative">
                  <img src="<?= htmlspecialchars($product['image']); ?>" class="img-fluid" alt="<?= htmlspecialchars($product['ProductName']); ?>">

                  <!-- Form thêm vào giỏ hàng -->
                  <form method="POST" action="?act=add-order" class="add-to-cart-form">
                    <!-- Sử dụng ProductID thay vì id -->
                    <input type="hidden" name="ProductID" value="<?= $product['id']; ?>">
                    <button type="submit"
                      class="btn btn-light position-absolute bottom-0 start-50 translate-middle-x w-75 shadow">
                      Thêm nhanh vào giỏ
                    </button>
                  </form>
                </div>
                <!-- Tên sản phẩm -->
                <a href="?act=product-detail&id=<?= $product['id']; ?>" style="text-decoration: none;">
                  <h3><?= htmlspecialchars($product['ProductName']); ?></h3>
                </a>
                <!-- Giá sản phẩm -->
                <p class="fw-bold"><?= number_format($product['Price'], 0, ',', '.'); ?>₫</p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Hiện tại chưa có sản phẩm mới.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

</main>
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



  <section class="categories py-5">
    <div class="container">
      <h2>Sản phẩm mới (New Products)</h2>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
          <a href="?act=danhmucnam">
            <div class="category-item">
              <img src="../client-page/images/cate-2.png" class="img-fluid" alt="Category 1">
            </div>
          </a>
        </div>
        <div class="col">
          <a href="?act=danhmucnu">
            <div class="category-item">
              <img src="../client-page/images/cate-1.png" class="img-fluid" alt="Category 2">
            </div>
          </a>
        </div>
        <div class="col">
          <a href="?act=danhmucspmoi">
            <div class="category-item">
              <img src="../client-page/images/cate-1.png" class="img-fluid" alt="Category 3">
            </div>
          </a>
        </div>
        <div class="col">
          <a href="?act=danhmuctreem">
            <div class="category-item">
              <img src="../client-page/images/cate-1.png" class="img-fluid" alt="Category 4">
            </div>
          </a>
        </div>
      </div>
    </div>
    <section class="products py-5">
      <div class="container">
        <h2>Sản phẩm mới nhất</h2>
        <div class="container py-5">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php if ($latestProductsHome && count($latestProductsHome) > 0): ?>
              <?php foreach ($latestProductsHome as $product): ?>
                <div class="col">
                  <div class="product-item card h-100 shadow-sm border-light text-center">
                    <!-- Hiển thị ảnh sản phẩm -->
                    <div class="img-container">
                            <img src="<?= $product['image']; ?>" alt="<?= htmlspecialchars($product['ProductName']); ?>" style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                    <div class="card-body d-flex flex-column">
                      <!-- chitiet sp -->
                      <h5 class="card-title"><?= htmlspecialchars($product['ProductName']); ?></h5>
                      <!-- Hiển thị giá sản phẩm -->

                      <p class="text-danger mb-2"><?= number_format($product['Price'], 0, ',', '.'); ?>₫</p>
                      <!-- Hiển thị mô tả ngắn -->
                      <p class="card-text text-muted" style="min-height: 60px;"><?= htmlspecialchars($product['Description']); ?></p>

                      <!-- Nút thêm vào giỏ hoặc xem chi tiết -->
                      <a href="?act=productdetail&id=<?= $product['id']; ?>" class="btn btn-primary mt-auto">Xem chi tiết</a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-center">Hiện tại chưa có sản phẩm mới.</p>
            <?php endif; ?>
          </div>
        </div>
        <div class="text-center mt-4">
          <a href="#"><button class="btn btn-secondary">Xem thêm</button></a>
        </div>
      </div>
    </section>



</main>
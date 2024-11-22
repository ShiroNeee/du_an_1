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
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php if ($latestProductsHome && count($latestProductsHome) > 0): ?>
          <?php foreach ($latestProductsHome as $product): ?>
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



</main>
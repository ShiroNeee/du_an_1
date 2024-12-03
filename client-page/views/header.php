<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNIQUE STYLE</title>
  <link rel="stylesheet" href="../client-page/public/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php if (!empty($_SESSION['success']) || !empty($_SESSION['error'])): ?>
    <div
      class="alert <?= !empty($_SESSION['success']) ? 'alert-success' : 'alert-danger'; ?> d-flex flex-column align-items-start p-3 position-fixed top-0 end-0 m-3"
      role="alert">
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
      <small>
        <?php if (!empty($_SESSION['success'])): ?>
          <?= $_SESSION['success']; ?>
          <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php
        // Kiểm tra xem error có phải là mảng không
        if (isset($_SESSION['error'])) {
          if (is_array($_SESSION['error'])) {
            // Nếu là mảng, lặp qua và hiển thị từng lỗi
            foreach ($_SESSION['error'] as $key => $error) {
              if (!empty($error)) {
                echo htmlspecialchars($error) . '<br>';
              }
            }
          } else {
            // Nếu là chuỗi, hiển thị trực tiếp
            echo htmlspecialchars($_SESSION['error']);
          }
          unset($_SESSION['error']); // Xóa lỗi sau khi hiển thị
        }
        ?>
      </small>
    </div>
<?php endif; ?>

  <header class="top-header bg-white py-3 border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- Logo -->
      <div class="logo">
        <a href="../client-page">
          <img src="../client-page/images/logo.png" alt="Logo" class="img-fluid" style="height: 50px;">
        </a>
      </div>

      <nav class="navbar">
        <ul class="nav">
          <?php if (!empty($latestCategorysHome) && count($latestCategorysHome) > 0): ?>
            <?php foreach ($latestCategorysHome as $category): ?>
              <li class="nav-item">
                <!-- Liên kết đến route shopintroduce kèm id -->
                <a href="?act=danh-muc&id=<?= isset($category['CategoryID']) ? urlencode($category['CategoryID']) : ''; ?>" class="nav-link">
                  <?= htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <p>Hiện tại chưa có danh mục nào.</p>
          <?php endif; ?>
        </ul>
      </nav>


      <!-- Header Icons -->
      <div class="header-icons d-flex align-items-center gap-3">
        <!-- Search Form -->
        <div class="search-container">
          <form class="d-flex" role="search" method="POST">
            <button class="btn btn-link dropdown-toggle" type="button" id="search-dropdown" data-bs-toggle="dropdown" style="text-decoration: none;">
              Kết quả tìm kiếm
            </button>
            <!-- Dropdown hiển thị kết quả tìm kiếm -->
            <?php if (isset($_POST['search'])): ?>
              <?php
              $searchQuery = $_POST['search_query'];
              $searchResults = $this->modelProduct->searchProductsByName($searchQuery); // Giả sử phương thức tìm kiếm đã có
              ?>
              <div class="dropdown">
                <ul class="dropdown-menu">
                  <?php if (!empty($searchResults)): ?>
                    <?php foreach ($searchResults as $product): ?>
                      <div class="card-body">
                        <a href="?act=detail&id=<?= $product['id']; ?>" class="d-flex align-items-center gap-3 text-decoration-none">
                          <img src="<?= $product['image']; ?>" width="80px" />
                          <br>
                          <td class="my-3">Tên: <?= $product['ProductName']; ?></td>
                          <br>
                          <td>Giá: <?= $product['Price']; ?> đ</td>
                          <hr>
                        </a>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <li class="dropdown-item">Không có sản phẩm nào phù hợp với tìm kiếm của bạn.</li>
                  <?php endif; ?>
                </ul>
              </div>
            <?php endif; ?>
            <input type="text" class="form-control" placeholder="Tìm kiếm" name="search_query" id="search-input" required />
            <button class="btn btn-link" name="search" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </form>
        </div>
        <a href="?act=cart-shop" class="fa fa-shopping-cart"></a>

        <?php if (isset($_SESSION['user'])): ?>
          <!-- Dropdown User Settings -->
          <div class="dropdown">
            <!-- Icon người dùng, có thể click để mở dropdown -->
            <a href="javascript:void(0);" class="fa fa-user dropdown-toggle" id="user-icon" data-bs-toggle="dropdown"
              aria-expanded="false"></a>

            <!-- Menu dropdown (ẩn/show khi click vào icon) -->
            <ul class="dropdown-menu" aria-labelledby="user-icon">
              <li><span class="dropdown-item">Xin chào, <?= $_SESSION['user']['name']; ?></span></li>
              <?php if ($_SESSION['user']['roleID'] == 1 || $_SESSION['user']['roleID'] == 2): ?>
                <li><a href="/du_an_1/admin-page/" class="dropdown-item">Admin</a></li>
              <?php endif; ?>
              <li><a href="?act=profile" class="dropdown-item">Thông tin cá nhân</a></li>
              <li><a href="?act=checkout" class="dropdown-item">Thanh toán</a></li>
              <li><a href="?act=my-orders" class="dropdown-item">Đơn hàng của bạn</a></li>
              <li><a href="?act=logout" class="dropdown-item">Đăng xuất</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a href="?act=login" class="fa fa-user"></a>
        <?php endif; ?>

        <a href="?act=shopintroduce" class="fa fa-home"></a>
      </div>
    </div>
  </header>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
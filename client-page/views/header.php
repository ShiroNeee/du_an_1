<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNIQUE STYLE</title>
  <link rel="stylesheet" href="../client-page/public/styles.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <?php if (!empty($_SESSION['success']) || !empty($_SESSION['error'])): ?>
    <div class="alert <?= !empty($_SESSION['success']) ? 'alert-success' : 'alert-danger'; ?> d-flex flex-column align-items-start p-3 position-fixed top-0 end-0 m-3" role="alert">
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
      <small>
        <?php if (!empty($_SESSION['success'])): ?>
          <?= $_SESSION['success']; ?>
          <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
          <?php
          foreach ($_SESSION['error'] as $key => $error) {
            if (!empty($error)) {
              echo htmlspecialchars($error) . '<br>';
            }
          }
          unset($_SESSION['error']);
          ?>
        <?php endif; ?>
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
          <li class="nav-item"><a href="?act=danhmucspmoi" class="nav-link">Sản Phẩm Mới</a></li>
          <li class="nav-item"><a href="?act=danhmucnu" class="nav-link">Nữ</a></li>
          <li class="nav-item"><a href="?act=danhmucnam" class="nav-link">Nam</a></li>
          <li class="nav-item"><a href="?act=danhmuctreem" class="nav-link">Trẻ Em</a></li>
        </ul>
      </nav>
      <!-- Header Icons -->
      <div class="header-icons d-flex align-items-center gap-3">
        <!-- Search Form -->
        <div class="search-container">
          <form class="d-flex" role="search" method="POST" action="?act=search">
            <input type="text" class="form-control" placeholder="Tìm kiếm" id="search-input" required />
            <button class="btn btn-link" name="search" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </form>
        </div>
        <a href="?act=cartshop" class="fa fa-shopping-cart"></a>
        <?php if (isset($_SESSION['user'])): ?>
          <!-- Dropdown User Settings -->
          <div class="dropdown">
            <!-- Icon người dùng, có thể click để mở dropdown -->
            <a href="javascript:void(0);" class="fa fa-user dropdown-toggle" id="user-icon" data-bs-toggle="dropdown" aria-expanded="false"></a>

            <!-- Menu dropdown (ẩn/show khi click vào icon) -->
            <ul class="dropdown-menu" aria-labelledby="user-icon">
              <li><span class="dropdown-item">Xin chào, <?= $_SESSION['user']['name']; ?></span></li>
              <?php if ($_SESSION['user']['roleID'] == 1): ?>
                <li><a href="/du_an_1/admin-page/" class="dropdown-item">Admin</a></li>
              <?php endif; ?>
              <li><a href="?act=profile" class="dropdown-item">Thông tin cá nhân</a></li>
              <li><a href="?act=payment" class="dropdown-item">Thanh toán</a></li>

              <li><a href="?act=logout" class="dropdown-item">Đăng xuất</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a href="?act=login" class="fa fa-user"></a>
        <?php endif; ?>

        <a href="?act=shopintroduce" class="fa fa-home"></a>
      </div>
    </div>
    </div>
  </header>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
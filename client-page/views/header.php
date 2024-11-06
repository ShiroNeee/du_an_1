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
</head>

<body>
  <header class="top-header">
    <div class="container">
      <div class="logo">
        <img src="../client-page/images/logo.png" />
      </div>
      <nav class="navbar">
        <ul class="nav-links">
          <li><a href="#">Sản Phẩm Mới</a></li>
          <li><a href="#">Nữ</a></li>
          <li><a href="#">Nam</a></li>
          <li><a href="#">Bé Gái</a></li>
          <li><a href="#">Bé Trai</a></li>
        </ul>
      </nav>
      <div class="header-icons">
        <div class="search-container">
          <form class="d-flex " role="search" method="POST" action="?act=search">
            <input
              type="text"
              class="search-bar"
              placeholder="Tìm kiếm"
              id="search-input"
              required />
            <button class="fa-solid fa-magnifying-glass" name="search" type="submit">
            </button>
          </form>
        </div>
        <a href="#" class="fa fa-shopping-cart"></a>
        <a href="?act=login" class="fa fa-user"></a>
        <a href="#" class="fa fa-home"></a>
      </div>
    </div>
  </header>
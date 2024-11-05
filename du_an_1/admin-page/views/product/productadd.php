<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/du_an_1/admin-page/views/product/styles.css">
    <title>Admin - thêm sản phẩm(product add)</title>
</head>

<body>
    <section id="sidebar">
        <a href="/du_an_1/admin-page/views/product/productlist.php" class="brand">
            <i class='bx bxs-user'></i>
            <span class="text">Admin Unique Style</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="/du_an_1/admin-page/">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Trang Chủ</span>
                </a>
            </li>
            <li>
                <a href="/du_an_1/client-page/index.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Cửa hàng của tôi</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Thống kê</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Tin nhắn(message)</span>
                </a>
            </li>
            <li>
                <a href="/du_an_1/admin-page/views/product/productlist.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="text">Danh sách sản phẩm</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Cài đặt</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <a href="/du_an_1/admin-page/views/category/categorylist.php" class="nav-link">Danh mục (category)</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Tìm kiếm...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">10</span>
            </a>
            <a href="#" class="profile">
                <img src="/du_an_1/admin-page/img/logo.jpg">
            </a>
        </nav>
        <script src="/du_an_1/admin-page/public/script.js"></script>
        <!-- add_product -->
        <div class="admin-product-form-container">
            <form method="post" enctype="multipart/form-data">
                <h3>Thêm sản phẩm (product)</h3>
                <input type="text" placeholder="Nhập tên sản phẩm....." name="" class="box"/>
                <input type="number" placeholder="Nhập giá sản phẩm....." name="" class="box"/>
                <input type="text" placeholder="Mô tả sản phẩm....." name="" class="box"/>
                <select class="box">
                    <option>Chọn màu sắc</option>
                    <option>Đen </option>
                    <option>Trắng</option>
                    <option>Xanh</option>
                    <option>Đỏ</option>
                    <option>Tím </option>
                </select>
                <select class="box">
                    <option>Chọn size</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                    <option>XXL</option>
                </select>
                <select class="box">
                    <option>Chọn danh mục</option>
                    <option>Nữ</option>
                    <option>Nam</option>
                    <option>Bé gái</option>
                    <option>Bé trai</option>
                </select>
                <input type="file" accept="img/png,img/jpeg,img/jpg" class="box"/>
                <button type="submit" class="add">Thêm sản phẩm</button>
            </form>
        </div>
        <!-- footer -->
        <footer class="footer">
            <div class="footer-content">
                <p>© 2024 Admin Unique Style. All Rights Reserved.</p>
            </div>
        </footer>
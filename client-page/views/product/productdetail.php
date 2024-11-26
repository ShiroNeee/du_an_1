<style>
    .size {
        display: inline-block;
        padding: 8px 16px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-right: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .size:hover {
        background-color: #f0f0f0;
        border-color: #007bff;
    }

    .size.selected {
        border: 0.5px solid #000;
    }

    /* star */
    .stars {
        display: inline-block;
    }

    .fa-star {
        font-size: 24px;
        color: #ccc;
    }

    .fa-star.checked {
        color: #FFD700;
    }

    /* img */
    .tab-pane img {
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    .tab-pane img:hover {
        box-shadow: 0 20px 20px rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }

    /*color*/
    .colors {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .color {
        display: inline-block;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        margin-right: 8px;
        border: 1px solid #ddd;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .color.blue {
        background-color: blue;
    }

    .color.green {
        background-color: green;
    }

    .color.yellow {
        background-color: yellow;
    }

    .color.black {
        background-color: black;
    }

    .color.white {
        background-color: white;
    }

    .color:hover {
        transform: scale(1.2);
    }

    .color.selected {
        border: 0.25px solid #000;
    }

    /* like */
    .like {
        background-color: transparent;
        border: 1.5px solid #ddd;
        color: #333;
    }

    .liked {
        color: red;
    }
    /* lien quan sp */
    .more-product:hover{
        transform: translateY(-5px);
        transition: all 0.3s ease-in-out;
        color:brown;
    }
</style>
<!-- detail sp -->
<?php if ($productDetail): ?>
    <div class="container mt-4">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1">
                            <img src="<?= $productDetail['image'] ?>" width="500px" height="500px" style="border:0.5px solid #ddd" />
                        </div>
                    </div>
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title"><?= $productDetail['ProductName'] ?></h3>
                    <p>Danh mục sản phẩm: <?= $productDetail['CategoryName'] ?></p>
                    <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">49 bài đánh giá</span>
                    </div>
                    <p class="product-description"><?= $productDetail['Description'] ?></p>
                    <h4 class="price">Giá sản phẩm: <span style="color:red"><?= $productDetail['Price'] ?> đ</span></h4>
                    <p class="vote"><strong>90%</strong> người dùng like sản phẩm này <strong>44 votes</strong></p>
                    <h5 class="sizes">Size:
                        <span class="size" data-toggle="tooltip" title="small" onclick="selectSize(this)">S</span>
                        <span class="size" data-toggle="tooltip" title="medium" onclick="selectSize(this)">M</span>
                        <span class="size" data-toggle="tooltip" title="large" onclick="selectSize(this)">L</span>
                        <span class="size" data-toggle="tooltip" title="xtra large" onclick="selectSize(this)">XL</span>
                        <span class="size" data-toggle="tooltip" title="xtra large" onclick="selectSize(this)">XXL</span>
                    </h5>
                    <h5 class="colors">Màu sắc:
                        <span class="color blue" onclick="selectColor(this)"></span>
                        <span class="color green" onclick="selectColor(this)"></span>
                        <span class="color yellow" onclick="selectColor(this)"></span>
                        <span class="color black" onclick="selectColor(this)"> </span>
                        <span class="color white" onclick="selectColor(this)"></span>
                    </h5>
                    <h5 class=""></h5>
                    <div class="action mt-5">
                        <button class="btn btn-primary" type="button">Thêm vào giỏ</button>
                        <button class="like btn btn-default" type="button" onclick="toggleLike(this)"><span class="fa fa-heart"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p style="color:red" class="text-center">Không tìm thấy sản phẩm.</p>
<?php endif; ?>
<hr style="width:1330px; margin-left:100px">
<!-- cmt sp -->
<section class="content-item mt-5" id="comments">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <!-- New Comment Form -->
                <form class="mb-4">
                    <h3 class="mb-3">Bình Luận Sản Phẩm</h3>
                    <div class="d-flex align-items-start mb-3">
                        <img class="rounded-circle me-3" src="../client-page/images/logo.png" alt="err img" style="width: 50px; height: 50px;" />
                        <textarea class="form-control" id="message" rows="4" placeholder="Viết bình luận của bạn ở đây..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Gửi bình luận</button>
                </form>
                <h5 class="mb-4">2 Bình Luận</h5>
                <!-- Khách hàng 1 -->
                <div class="comments-list">
                    <!-- Comment 1 -->
                    <div class="d-flex mb-4">
                        <img class="rounded-circle me-3" src="../client-page/images/logo.png" alt="err img" style="width: 50px; height: 50px;" />
                        <div>
                            <h5 class="mb-1">khách hàng 2</h5>
                            <p class="mb-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod ex in quam viverra, a malesuada dui tincidunt.
                            </p>
                            <ul class="list-inline text-muted mb-0">
                                <li class="list-inline-item me-3"><i class="fa fa-calendar"></i> 26/11/2024</li>
                                <li class="list-inline-item me-3"><i class="fa fa-thumbs-up"></i> 13</li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none">Thích</a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none">Trả lời</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Khách hàng 2 -->
                    <div class="d-flex mb-4">
                        <img class="rounded-circle me-3" src="../client-page/images/logo.png" alt="err img" style="width: 50px; height: 50px;" />
                        <div>
                            <h5 class="mb-1">khách hàng 1</h5>
                            <p class="mb-2">
                                Curabitur eget lorem nec velit gravida auctor. Nam volutpat justo eget nisi cursus, a luctus risus molestie.
                            </p>
                            <ul class="list-inline text-muted mb-0">
                                <li class="list-inline-item me-3"><i class="fa fa-calendar"></i> 25/11/2024</li>
                                <li class="list-inline-item me-3"><i class="fa fa-thumbs-up"></i> 8</li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none">Thích</a></li>
                                <li class="list-inline-item"><a href="#" class="text-decoration-none">Trả lời</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sp có liên quan -->
<div class="container">
        <h2 class="text-center mb-3 mt-3 more-product">Sản Phẩm Có Liên Quan</h2>
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
<!-- src -->
<script>
    function selectColor(element) {
        // Bỏ lớp selected khỏi tất cả màu sắc
        const colors = document.querySelectorAll('.color');
        colors.forEach(color => color.classList.remove('selected'));
        // Thêm lớp selected vào màu đã chọn
        element.classList.add('selected');
    }

    function selectSize(element) {
        const sizes = document.querySelectorAll('.size');
        sizes.forEach(size => size.classList.remove('selected'));
        element.classList.add('selected');
    }

    function toggleLike(button) {
        // Toggle lớp liked khi click vào nút like
        button.querySelector('span').classList.toggle('liked');
    }
</script>
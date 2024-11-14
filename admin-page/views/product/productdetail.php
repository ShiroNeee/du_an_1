<?php
require_once '../common/env.php';
require_once '../common/function.php';

$conn = connectDB();
// lấy id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_detail_product = "SELECT * FROM products WHERE id= '$id'";
    $stmt_detail_product = $conn->prepare($sql_detail_product);
    $stmt_detail_product->execute();
    $detail_product = $stmt_detail_product->fetch();
    // nếu k có
    if (!$detail_product) {
        echo "sản phẩm không có";
        exit();
    }
}
?>
<!-- xem chi tiết sp -->
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        margin-top: 20px;
    }
    .product-detail {
        display: flex;
        gap: 20px;
    }
    .product-image {
        flex: 1;
        max-width: 600px;
    }
    .product-image img {
        width: 100%;
        border-radius: 20px;
        object-fit: cover;
    }
    .product-info {
        flex: 2;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .product-info h2 {
        color: red;
        margin: 0;
        font-size: 2rem;
    }
    .product-info .title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .product-info p {
        font-size: 1rem;
        margin: 5px 0;
    }
    .product-info .price {
        color: green;
        font-weight: bold;
        font-size: 1.2rem;
    }
    .add-to-cart {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 1rem;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .add-to-cart:hover {
        background-color: #0056b3;
    }
</style>
<div class="container">
    <div class="product-detail">
        <div class="product-image">
             <img src="img/<?= $detail_product['image']?>" alt="err img" height="300"/>
        </div>
        <div class="product-info">
            <h3 class="title">Chi Tiết Sản Phẩm : <?= $detail_product['name'] ?></h3>
            <p class="price">Giá: $<?= $detail_product['price'] ?></p><br>
            <h3>Mô tả: <?= $detail_product['description'] ?></h3><br>
            <p style="border:1px solid #ddd; border-radius:5px;width:100px;background-color:aqua">Màu sắc: <?= $detail_product['id_color'] ?> color</p><br>
            <h3>Kích thước: <?= $detail_product['id_size'] ?> size</h3><br>
            <h3>Danh mục: <?= $detail_product['id_category'] ?> category</h3><br>
            <a href="?act=listproduct"><button class="edit">Trở Về</button></a>
        </div>
    </div>
</div>
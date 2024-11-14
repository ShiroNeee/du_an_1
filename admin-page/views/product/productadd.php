<?php
require_once '../common/env.php';
require_once '../common/function.php';
// kêt nối db
$conn=connectDB();

// màu
$sql_colors= "SELECT * FROM color_products";
$stmt_colors=$conn->prepare($sql_colors);
$stmt_colors->execute();
$colors= $stmt_colors->fetchAll(PDO::FETCH_ASSOC);
// size
$sql_sizes= "SELECT * FROM size_products";
$stmt_sizes=$conn->prepare($sql_sizes);
$stmt_sizes->execute();
$sizes= $stmt_sizes->fetchAll(PDO::FETCH_ASSOC);
// danh mục
$sql_categories= "SELECT * FROM categories";
$stmt_categories=$conn->prepare($sql_categories);
$stmt_categories->execute();
$categories= $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- add_product -->
        <div class="admin-product-form-container">
            <form method="POST" enctype="multipart/form-data">
                <h3>Thêm sản phẩm (product)</h3>
                <input type="text" placeholder="Nhập tên sản phẩm....." name="name_product" class="box"/>
                <input type="number" placeholder="Nhập giá sản phẩm....." name="price_product" class="box"/>
                <input type="text" placeholder="Mô tả sản phẩm....." name="description_product" class="box"/>
                <select class="box" name="color_product">
                    <option selected disabled>Chọn màu sản phẩm (color)</option>
                    <?php foreach($colors as $color) { ?>
                        <option value="<?= $color['id']?>"><?= $color['name']?></option>
                   <?php } ?>
                </select>
                <select class="box" name="size_product">
                    <option selected disabled>Chọn size sản phẩm</option>
                    <?php foreach($sizes as $size) { ?>
                        <option value="<?= $size['id']?>"><?= $size['name']?></option>
                   <?php } ?>
                </select>
                <select class="box" name="category_product">
                    <option selected disabled>Chọn danh mục sản phẩm (category)</option>
                    <?php foreach($categories as $category) { ?>
                        <option value="<?= $category['id']?>"><?= $category['name']?></option>
                   <?php } ?>
                </select>
                <input type="file" accept="img/png,img/jpeg,img/jpg" class="box" name="image_product"/>
                <button type="submit" class="add">Thêm sản phẩm</button>
            </form>
        </div>
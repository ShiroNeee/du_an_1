<?php
require_once '../common/env.php';
require_once '../common/function.php';
// kêt nối db
$conn = connectDB();

// màu
$sql_colors = "SELECT * FROM color_products";
$stmt_colors = $conn->prepare($sql_colors);
$stmt_colors->execute();
$colors = $stmt_colors->fetchAll(PDO::FETCH_ASSOC);
// size
$sql_sizes = "SELECT * FROM size_products";
$stmt_sizes = $conn->prepare($sql_sizes);
$stmt_sizes->execute();
$sizes = $stmt_sizes->fetchAll(PDO::FETCH_ASSOC);
// danh mục
$sql_categories = "SELECT * FROM categories";
$stmt_categories = $conn->prepare($sql_categories);
$stmt_categories->execute();
$categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
//thêm product - xử lí dữ liệu (post) 
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // lấy dữ liệu form
    $name_product          = trim($_POST['name_product']);
    $price_product         = trim($_POST['price_product']);
    $description_product   = trim($_POST['description_product']);
    $color_product         = $_POST['color_product'];
    $size_product          = $_POST['size_product'];
    $category_product      = $_POST['category_product'];
    // er
    if (empty($name_product)) $errors[] = 'Tên sản phẩm không được để trống.';
    if (empty($price_product)) $errors[] = 'Giá sản phẩm không được để trống.';
    if (empty($description_product)) $errors[] = 'Mô tả sản phẩm không được để trống.';
    // img
    $file_image = $_FILES['image_product'];
    if (!empty($file_image)) {
        $image_product = $file_image['name'];
        $target_file_image = '"/img/"' . $image_product;
        // move_uploaded_file($file_image['tmp_name'], $target_file_image);  
    }
    // add product (đúng tt thì mới k bị đổ nhầm dữ liệu)
    if (empty($errors)) {
        $sql_add_product = "INSERT INTO products(name,price,id_color,id_size,description,image,id_category) VALUES ('$name_product','$price_product','$color_product','$size_product','$description_product','$image_product','$category_product')";
        $stmt_add_product = $conn->prepare($sql_add_product);
        $stmt_add_product->execute();
        if ($stmt_add_product) {
            header('Location:index.php');
        } else {
            echo "k thêm dc sản phẩm";
        }
    }
}
?>
<!-- add_product -->
<style>
    .errors {
        border: 1px solid #f5c6cb;
        background-color: lightblue;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        margin-left:20px;
    }
    .error-item {
        display: block;
        margin-bottom: 5px;
        font-size: 16px;
        color: red;
    }
</style>
<div class="admin-product-form-container">
    <form method="POST" enctype="multipart/form-data">
        <h3>Thêm sản phẩm (product)</h3>
        <?php if (!empty($errors)):?>
            <div class="errors">
                <?php foreach ($errors as $error):?>
                    <span class="error-item"><?= htmlspecialchars($error) ?><span/>
                <?php endforeach; ?>
            </div>
        <?php endif;?>
        <input type="text" placeholder="Nhập tên sản phẩm....." name="name_product" class="box" />
        <input type="number" placeholder="Nhập giá sản phẩm....." name="price_product" class="box" />
        <input type="text" placeholder="Mô tả sản phẩm....." name="description_product" class="box" />
        <select class="box" name="color_product">
            <option selected >Chọn màu sản phẩm (color)</option>
            <?php foreach ($colors as $color) { ?>
                <option value="<?= $color['id'] ?>"><?= $color['name'] ?></option>
            <?php } ?>
        </select>
        <select class="box" name="size_product">
            <option selected >Chọn size sản phẩm</option>
            <?php foreach ($sizes as $size) { ?>
                <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
            <?php } ?>
        </select>
        <select class="box" name="category_product">
            <option selected>Chọn danh mục sản phẩm (category)</option>
            <?php foreach ($categories as $category) { ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php } ?>
        </select>
        <input type="file" accept="img/png,img/jpeg,img/jpg" class="box" name="image_product"/>
        <button type="submit" class="add">Thêm sản phẩm</button>
    </form>
</div>
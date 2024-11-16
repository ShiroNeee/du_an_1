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
$success = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    if (empty($color_product) || $color_product === "Chọn màu sản phẩm (color)") {
        $errors[] = 'Màu của sản phẩm không được để trống.';
    }
    if (empty($size_product) || $size_product === "Chọn size sản phẩm") {
        $errors[] = 'Size sản phẩm không được để trống.';
    }
    if (empty($category_product) || $category_product === "Chọn danh mục sản phẩm (category)") {
        $errors[] = 'Danh mục sản phẩm không được để trống.';
    }
    // img
    $file_image = $_FILES['image_product'];
    if ($file_image['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = 'Vui lòng chọn ảnh sản phẩm.';
    } else {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $max_size = 2 * 1024 * 1024; // 2MB
        if (!in_array($file_image['type'], $allowed_types)) {
            $errors[] = 'Chỉ cho ảnh JPEG, PNG, JPG';
        }
        if ($file_image['size'] > $max_size) {
            $errors[] = 'File ảnh k dc quá 2MB';
        }
        if (empty($errors)) {
            $image_product = basename($file_image['name']);
            $target_file_image = './img/' . $image_product;
            if (!move_uploaded_file($file_image['tmp_name'], $target_file_image)) {
                $errors[] = 'Ảnh k tải đc lên.';
            }
        }
    }
    // edit product 
    if (empty($errors)) {
        $sql_edit_product = "UPDATE products SET 
        name = '$name_product',
        price = '$price_product',
        description = '$description_product',
        id_color = '$color_product',
        id_size='$size_product',
        id_category='$category_product',
        image = '$image_product'
        WHERE id = '$id'";
        $stmt_edit_product = $conn->prepare($sql_edit_product);
        $stmt_edit_product->execute();
        if ($stmt_edit_product) {
            $success = 'Sửa sản phẩm product thanh công';
        } else {
            echo "chưa sửa dc sp";
        }
    }
}
?>
<!-- edit_produc -->
<style>
    @import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");
    :root{
        --poppins: "Poppins", sans-serif;
        --lato: "Lato", sans-serif;
    }
    .errors {
        border: 1px solid #f5c6cb;
        background-color: lightblue;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        margin-left: 20px;
    }
    .error-item {
        display: block;
        margin-bottom: 5px;
        font-size: 16px;
        color: red;
        font-family: var(--lato);
    }
    .success {
        border: 1px solid #c3e6cb;
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        margin-left: 20px;
        font-family: var(--lato);
    }
</style>
<div class="admin-product-form-container">
    <form method="post" enctype="multipart/form-data">
        <h3>Sửa sản phẩm (product)</h3>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <span class="error-item"><?= htmlspecialchars($error) ?><span />
                    <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="success">
                <span><?= htmlspecialchars($success) ?></span>
            </div>
        <?php endif; ?>
        <input type="text" placeholder="Nhập tên sản phẩm....." name="name_product" value="<?= $detail_product['name'] ?>" class="box" />
        <input type="number" placeholder="Nhập giá sản phẩm....." name="price_product" value="<?= $detail_product['price'] ?>" class="box" />
        <input type="text" placeholder="Mô tả sản phẩm....." name="description_product" value="<?= $detail_product['description'] ?>" class="box" />
        <select class="box" name="color_product">
            <option selected>Chọn màu sản phẩm (color)</option>
            <option value="1" <?= $detail_product['id_color'] == 1 ? 'selected' : "" ?>>Xanh</option>
            <option value="2" <?= $detail_product['id_color'] == 2 ? 'selected' : "" ?>>Đỏ</option>
            <option value="3" <?= $detail_product['id_color'] == 3 ? 'selected' : "" ?>>Vàng</option>
            <option value="4" <?= $detail_product['id_color'] == 4 ? 'selected' : "" ?>>Đen</option>
            <option value="5" <?= $detail_product['id_color'] == 5 ? 'selected' : "" ?>>Trắng</option>
        </select>
        <select class="box" name="size_product">
            <option selected>Chọn size sản phẩm</option>
            <option value="1" <?= $detail_product['id_size'] == 1 ? 'selected' : "" ?>>S</option>
            <option value="2" <?= $detail_product['id_size'] == 2 ? 'selected' : "" ?>>M</option>
            <option value="3" <?= $detail_product['id_size'] == 3 ? 'selected' : "" ?>>L</option>
            <option value="4" <?= $detail_product['id_size'] == 4 ? 'selected' : "" ?>>XL</option>
            <option value="5" <?= $detail_product['id_size'] == 5 ? 'selected' : "" ?>>XXL</option>
        </select>
        <select class="box" name="category_product">
            <option selected >Chọn danh mục sản phẩm (category)</option>
            <option value="1" <?= $detail_product['id_category'] == 1 ? 'selected' : "" ?>>Sản phẩm mới</option>
            <option value="2" <?= $detail_product['id_category'] == 2 ? 'selected' : "" ?>>Nữ</option>
            <option value="3" <?= $detail_product['id_category'] == 3 ? 'selected' : "" ?>>Nam</option>
            <option value="4" <?= $detail_product['id_category'] == 4 ? 'selected' : "" ?>>Trẻ em</option>
            <option value="5" <?= $detail_product['id_category'] == 5 ? 'selected' : "" ?>>Danh mục mới thêm</option>
            <option value="6" <?= $detail_product['id_category'] == 6 ? 'selected' : "" ?>>Category add 2</option>
        </select>
        <input type="file" accept="img/png,img/jpeg,img/jpg" class="box" name="image_product" <?= $detail_product['image']?> /><br>
        <img src="img/<?= empty($value['image']) || !isset($value['image']) ? 'logo.jpg' : $value['image'] ?>" alt="er img" width="50" height="50" /><br>
        <button type="submit" class="edit">Sửa sản phẩm</button>
    </form>
</div>
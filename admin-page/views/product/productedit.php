<?php
require_once '../common/env.php';
require_once '../common/function.php';

$conn=connectDB();
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql_detail_product="SELECT * FROM products WHERE id= '$id' ";
    $stmt_detail_product=$conn->prepare($sql_detail_product);
    $stmt_detail_product->execute();
    $detail_product=$stmt_detail_product->fetch();
    // nếu k có
    if(!$detail_product){
        echo"sản phẩm không có";
        exit();
    }
}
?>
<!-- edit_produc -->
        <div class="admin-product-form-container">
            <form method="post" enctype="multipart/form-data">
                <h3>Sửa sản phẩm (product)</h3>
                <input type="text" placeholder="Nhập tên sản phẩm....." name="name_product" value="<?= $detail_product['name']?>" class="box"/>
                <input type="number" placeholder="Nhập giá sản phẩm....." name="price_product" value="<?= $detail_product['price']?>" class="box"/>
                <input type="text" placeholder="Mô tả sản phẩm....." name="description_product" value="<?= $detail_product['description']?>" class="box"/>
                <select class="box" name="color_product">
                    <option selected disabled>Chọn màu sản phẩm (color)</option>
                    <option value="1" <?= $detail_product['id_color'] == 1 ? 'selected' : ""?>>Xanh</option>
                    <option value="2" <?= $detail_product['id_color'] == 2 ? 'selected' : ""?>>Đỏ</option>
                    <option value="3" <?= $detail_product['id_color'] == 3 ? 'selected' : ""?>>Vàng</option>
                    <option value="4" <?= $detail_product['id_color'] == 4 ? 'selected' : ""?>>Đen</option>
                    <option value="5" <?= $detail_product['id_color'] == 5 ? 'selected' : ""?>>Trắng</option>
                </select>
                <select class="box" name="size_product">
                    <option selected disabled>Chọn size sản phẩm</option>
                    <option value="1" <?= $detail_product['id_size'] == 1 ? 'selected' : ""?>>S</option>
                    <option value="2" <?= $detail_product['id_size'] == 2 ? 'selected' : ""?>>M</option>
                    <option value="3" <?= $detail_product['id_size'] == 3 ? 'selected' : ""?>>L</option>
                    <option value="4" <?= $detail_product['id_size'] == 4 ? 'selected' : ""?>>XL</option>
                    <option value="5" <?= $detail_product['id_size'] == 5 ? 'selected' : ""?>>XXL</option>
                </select>
                <select class="box" name="category_product">
                    <option selected disabled>Chọn danh mục sản phẩm (category)</option>
                    <option value="1" <?= $detail_product['id_category'] == 1 ? 'selected' : ""?>>Sản phẩm mới</option>
                    <option value="2" <?= $detail_product['id_category'] == 2 ? 'selected' : ""?>>Nữ</option>
                    <option value="3" <?= $detail_product['id_category'] == 3 ? 'selected' : ""?>>Nam</option>
                    <option value="4" <?= $detail_product['id_category'] == 4 ? 'selected' : ""?>>Trẻ em</option>
                </select>
                <input type="file" accept="img/png,img/jpeg,img/jpg" class="box" name="image_product" value="<?= $detail_product['image']?>"/>
                <button type="submit" class="edit">Sửa sản phẩm</button>
            </form>
        </div>
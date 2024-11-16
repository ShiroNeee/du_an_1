<?php
require_once '../common/env.php';
require_once '../common/function.php';

$conn = connectDB();
// AS category_name, color_name, size_name là đặt tên biến value 
$sql_product = " SELECT products.*, categories.name AS category_name, color_products.name AS color_name, size_products.name AS size_name FROM products 
    INNER JOIN 
        categories ON products.id_category = categories.id
    INNER JOIN 
        color_products ON products.id_color = color_products.id
    INNER JOIN 
        size_products ON products.id_size = size_products.id";
$stmt_product = $conn->prepare($sql_product);
$stmt_product->execute();
$products = $stmt_product->fetchAll();

?>

<!-- table product -->
<div class="table--wrapper">
    <h3 class="title">Danh sách sản phẩm (product)</h3>
    <a href="?act=addproduct"><button class="add">Thêm sản phẩm</button></a>
    <div class="table-container">
        <table style="text-align: left;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Màu sắc</th>
                    <th>Size</th>
                    <th>Mô tả sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $key => $value) { ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $value['name'] ?></td>
                        <td><img src="img/<?= empty($value['image']) || !isset($value['image']) ? 'logo.png' : $value['image']?>" alt="er img" width="50" height="50"/></td>
                        <td style="color:red"><?= $value['price'] ?> vnđ</td>
                        <td style="background-color:aqua"><?= $value['color_name'] ?></td>
                        <td style="color:blue"><?= $value['size_name'] ?></td>
                        <td><?= $value['description'] ?></td>
                        <td><?= $value['category_name'] ?></td>
                        <td>
                            <a href="?act=editproduct&id=<?= $value['id']?>"><button class="edit">Sửa</button></a>
                            <a href="?act=deleteproduct&id=<?= $value['id']?>" ><button onclick="return confirm('Bạn muốn xóa sản phẩm này?')" class="delete">Xóa</button></a> ||
                            <a href="?act=detailproduct&id=<?= $value['id']?>" ><button class="add">Chi Tiết</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
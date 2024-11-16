<?php
require_once '../common/env.php';
require_once '../common/function.php';

$conn = connectDB();
$sql_category = "SELECT * FROM categories";
$stmt_category = $conn->prepare($sql_category);
$stmt_category->execute();
$categories = $stmt_category->fetchAll();
?>

<!-- table -->
<div class="table--wrapper">
    <h3 class="title">Danh mục sản phẩm (category)</h3>
    <a href="?act=addcategory"><button class="add">Thêm danh mục</button></a>
    <div class="table-container">
        <table style="text-align: left;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $key => $value) { ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td style="color:blue;font-size:20px"><?= $value['name']?> : category</td>
                        <td>
                            <a href="?act=editcategory&id=<?= $value['id'] ?>"><button class="edit">Sửa</button></a> ||
                            <a href="?act=deletecategory&id=<?= $value['id'] ?>"><button onclick="return confirm('Bạn muốn xóa danh mục này?')" class="delete">Xóa</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
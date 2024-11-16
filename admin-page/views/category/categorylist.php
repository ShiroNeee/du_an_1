
        <div class="table--wrapper">
            <h3 class="title">Danh mục sản phẩm (category)</h3>
            <a href="?act=add-category"><button class="add">Thêm danh mục</button></a>
            <div class="table-container">
                <table style="text-align: left;">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Danh mục</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listCategories as $index => $categories) : ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= $categories['categoryName']; ?></td>
                                    <td>
                                        <a href="?act=edit-category&id=<?= $categories['id']; ?>">
                                            <button class="btn btn-primary">Sửa</button>
                                        </a>
                                        <form action="?act=delete" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            <input type="hidden" name="id" value="<?= $categories['id']; ?>">
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
        </div>
=======
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
>>>>>>> 0290402bea250885fc829a020504e963b6342d36


<!-- Form sửa danh mục -->
<div class="table--wrapper">
    <h3>Sửa danh mục (category)</h3>
    <div class="admin-product-form-container">
        <form action="?act=update-category" method="post">
        <input type="hidden" name="id" value="<?= $categoryDetail['id'] ?>">
        <label for="">Tên danh mục:</label>
            <input type="text" name="categoryName" value="<?= $categoryDetail['categoryName'] ?>" class="box"
            placeholder="Nhập tên danh mục"
            />
            <button type="submit" class="add" value="CẬP NHẬT">Cập nhật</button>
        </form>
    </div>

<?php
require_once '../common/env.php';
require_once '../common/function.php';

$conn = connectDB();
// lấy id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_detail_category = "SELECT * FROM categories WHERE id= '$id'";
    $stmt_detail_category = $conn->prepare($sql_detail_category);
    $stmt_detail_category->execute();
    $detail_category = $stmt_detail_category->fetch();
    // nếu k có
    if (!$detail_category) {
        echo "danh mục sản phẩm không có";
        exit();
    }
}
$success = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_category          = trim($_POST['name_category']);
    // er
    if (empty($name_category)) $errors[] = 'Tên danh mục sản phẩm không được để trống.';
    if (empty($errors)) {
        $sql_edit_category = "UPDATE categories SET name = '$name_category' WHERE id = '$id'";
        $stmt_edit_category = $conn->prepare($sql_edit_category);
        $stmt_edit_category->execute();
        if ($stmt_edit_category) {
            $success = 'Sửa danh mục sản phẩm category thanh công';
        } else {
            echo "chưa sửa dc danh mục sản phẩm";
        }
    }
}
?>
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
        font-family: var(--lato);
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
<!-- edit category -->
<div class="admin-product-form-container">
    <form method="post" enctype="multipart/form-data">
        <h3>Sửa danh mục (category)</h3>
        <?php if (!empty($errors)):?>
            <div class="errors">
                <?php foreach ($errors as $error):?>
                    <span class="error-item"><?= htmlspecialchars($error) ?><span/>
                <?php endforeach; ?>
            </div>
        <?php endif;?>
        <?php if (!empty($success)): ?>
            <div class="success">
                <span><?= $success?></span>
            </div>
        <?php endif; ?>
        <input type="text" placeholder="Nhập tên danh mục sản phẩm....." name="name_category" class="box" value="<?= $detail_category['name'] ?>" />
        <button type="submit" class="add">Sửa danh mục sản phẩm</button>
    </form>
</div>
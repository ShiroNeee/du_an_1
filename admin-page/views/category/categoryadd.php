<<<<<<< HEAD
<div class="table--wrapper">
  <h3>Thêm danh mục (category)</h3>
  <div class="admin-product-form-container">
    <form action="?act=create-category" method="post">
      <label for="">Tên danh mục:</label>
      <input type="text" placeholder="Nhập tên danh mục....." name="categoryName" class="box" />
      <a href="?act=list-category">
        <button type="button" class="add">Danh sách</button>
      </a>
      <button type="submit" class="add">Thêm</button>

    </form>
  </div>
=======
<?php
require_once '../common/env.php';
require_once '../common/function.php';
// kêt nối db
$conn = connectDB();
$success = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // lấy dữ liệu form
    $name_category         = trim($_POST['name_category']);
    // er
    if (empty($name_category)) $errors[] = 'Tên danh mục sản phẩm không được để trống.';
    if (empty($errors)) {
        $sql_add_category = "INSERT INTO categories(id,name) VALUES (null,'$name_category')";
        $stmt_add_category = $conn->prepare($sql_add_category);
        $stmt_add_category->execute();
        if ($stmt_add_category) {
            $success = 'Thêm danh mục sản phẩm category thanh công';
        } else {
            echo "k thêm dc danh mục sản phẩm";
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
        margin-left:20px;
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
<!-- add category -->
<div class="admin-product-form-container">
    <form method="post" enctype="multipart/form-data">
        <h3>Thêm danh mục (category)</h3>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <span class="error-item"><?= htmlspecialchars($error) ?><span />
                    <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="success">
                <span><?= $success?></span>
            </div>
        <?php endif; ?>
        <input type="text" placeholder="Nhập tên danh mục sản phẩm....." name="name_category" value="<?= htmlspecialchars($name_category) ?>" class="box"/>
        <button type="submit" class="add">Thêm danh mục sản phẩm</button>
    </form>
>>>>>>> 0290402bea250885fc829a020504e963b6342d36
</div>
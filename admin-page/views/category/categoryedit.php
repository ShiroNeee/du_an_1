<!-- Form sửa danh mục -->
<style>
    .showErrorMessage {
        background-color: #f8d7da;
        color: red;
        border: 1px solid #f5c2c7;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
        font-size: 14px;
        font-family: Arial, sans-serif;
        margin-left: 50px;
        width: 1190px;
    }

    .showErrorMessage ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    .showErrorMessage li {
        margin-bottom: 5px;
    }
</style>
<div class="admin-product-form-container">
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="showErrorMessage">
            <ul>
                <?php foreach ($_SESSION['error'] as $error): ?>
                    <li><?= htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <form action="?act=update-category" method="post">
        <h3>Sửa danh mục (category)</h3>
        <input type="hidden" name="id" value="<?= $categoryDetail['id'] ?>">
        <input type="text" name="categoryName" value="<?= $categoryDetail['categoryName'] ?>" class="box"
            placeholder="Nhập tên danh mục" />
        <button type="submit" class="add" value="CẬP NHẬT" style="margin-left:20px">Cập nhật</button>
    </form>
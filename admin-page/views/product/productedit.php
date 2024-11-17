<!-- edit_product -->
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
    <form action="?act=update-product" method="post" enctype="multipart/form-data">
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
        <?php if (!empty($_SESSION['error'])): ?>
			<div class="alert alert-danger">
				<?= $_SESSION['error']; ?>
			</div>
			<?php unset($_SESSION['error']); ?>
		<?php endif; ?>
        <?php if (!empty($_SESSION['success'])): ?>
			<div class="alert alert-success">
				<?= $_SESSION['success']; ?>
			</div>
			<?php unset($_SESSION['success']); ?>
		<?php endif; ?>
        <input type="hidden" name="id" value="<?= $productDetail['id'] ?>">
        <input type="text" placeholder="Nhập tên sản phẩm....." name="ProductName" value="<?= $productDetail['ProductName'] ?>" class="box" />
        <input type="number" placeholder="Nhập giá sản phẩm....." name="Price" value="<?= $productDetail['Price'] ?>" class="box" />
        <input type="text" placeholder="Mô tả sản phẩm....." name="Description" value="<?= $productDetail['Description'] ?>" class="box" />
        <select name="CategoryID" class="box">
                <option value="1" <?= $productDetail['CategoryID'] == '1' ? 'selected' : '' ?>>Nam</option>
                <option value="2" <?= $productDetail['CategoryID'] == '2' ? 'selected' : '' ?>>Nữ</option>
                <option value="3" <?= $productDetail['CategoryID'] == '3' ? 'selected' : '' ?>>Trẻ Em</option>
            </select>
            <select name="status" class="box">
                <option value="1" <?= $productDetail['status'] == '0' ? 'selected' : '' ?>>Còn Hàng</option>
                <option value="2" <?= $productDetail['status'] == '1' ? 'selected' : '' ?>>Hết Hàng</option>
            </select>
        <input type="file" accept="img/png,img/jpeg,img/jpg" class="box" name="image" value="<?= $productDetail['image'] ?>" /><br>
        <img src="img/<?= empty($value['image']) || !isset($value['image']) ? 'logo.jpg' : $value['image'] ?>" alt="er img" width="50" height="50" /><br>
        <button type="submit" class="edit">Sửa sản phẩm</button>
    </form>
</div>
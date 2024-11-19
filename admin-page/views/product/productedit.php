<!-- edit produc -->
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
        margin-left: 20px;
        width: 1170px;
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
    <form action="?act=update-product" method="post" enctype="multipart/form-data">
        <h3>Sửa sản phẩm (product)</h3>
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
        <input type="hidden" name="id" value="<?= $productDetail['id'] ?>">
        <input type="text" placeholder="Nhập tên của sản phẩm....." name="ProductName" value="<?= $productDetail['ProductName'] ?>" class="box" />
        <input type="number" placeholder="Nhập giá thành sản phẩm....." name="Price" value="<?= $productDetail['Price'] ?>" class="box" />
        <input type="text" placeholder="Mô tả chi tiết về sản phẩm....." name="Description" value="<?= $productDetail['Description'] ?>" class="box" />
        <select name="CategoryID" class="box">
           <option value="" selected>Chọn danh mục</option>
            <option value="1" <?= $productDetail['CategoryID'] == '1' ? 'selected' : '' ?>>Nam</option>
            <option value="2" <?= $productDetail['CategoryID'] == '2' ? 'selected' : '' ?>>Nữ</option>
            <option value="3" <?= $productDetail['CategoryID'] == '3' ? 'selected' : '' ?>>Trẻ Em</option>
        </select>
        <select name="status" class="box">
            <option value="" selected>Chọn trạng thái</option>
            <option value="1" <?= $productDetail['status'] == '0' ? 'selected' : '' ?>>Còn Hàng</option>
            <option value="2" <?= $productDetail['status'] == '1' ? 'selected' : '' ?>>Hết Hàng</option>
        </select>
        <input type="file" name="image" class="box" /><br>
        <img src="img/<?= empty($value['image']) || !isset($value['image']) ? 'logo.jpg' : $value['image'] ?>" alt="er img" width="50" height="50" /><br>
        <button type="submit" class="edit">Sửa sản phẩm</button>
    </form>
</div>
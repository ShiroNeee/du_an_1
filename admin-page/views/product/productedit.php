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
                    <?php
                    // Kiểm tra xem $_SESSION['error'] có phải là mảng không
                    $errors = is_array($_SESSION['error']) ? $_SESSION['error'] : [$_SESSION['error']];
                    foreach ($errors as $error): ?>
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
            <?php foreach ($statusCategory as $category): ?>
                <option value="<?= $category['CategoryID'] ?>" <?= $productDetail['CategoryID'] == $category['CategoryID'] ? 'selected' : '' ?>>
                    <?= $category['categoryName'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="status" class="box">
            <?php foreach ($statusList as $status): ?>
                <option value="<?= $status['statusID'] ?>" <?= $productDetail['status'] == $status['statusID'] ? 'selected' : '' ?>>
                    <?= $status['statusName'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="file" name="image" class="box" /><br>
        <td>
            <img src="<?= $productDetail['image']; ?>" alt="Hình ảnh" width="80px" style="margin-left:20px;border-radius: 10px;">
        </td><br>
        <button type="submit" class="edit" style="margin-left:20px">Sửa sản phẩm</button>
    </form>
</div>
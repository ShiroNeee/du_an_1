<!-- add product -->
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
    <form action="?act=create-product" method="POST" enctype="multipart/form-data">
        <h3>Thêm sản phẩm (product)</h3>
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
        <input type="text" placeholder="Nhập tên của sản phẩm....." name="ProductName" class="box" />
        <input type="number" placeholder="Nhập giá thành sản phẩm....." name="Price" class="box" />
        <input type="text" placeholder="Mô tả chi tiết về sản phẩm....." name="Description" class="box" />
        <select name="CategoryID" class="box">
            <option value="choose" disabled selected>Chọn danh mục</option>
            <?php foreach ($statusCategory as $category): ?>
                <option value="<?= $category['CategoryID'] ?>">
                    <?= $category['categoryName'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="status" class="box">
            <option value="choose" disabled selected>Chọn trạng thái</option>
            <?php foreach ($statusList as $status): ?>
                <option value="<?= $status['statusID'] ?>">
                    <?= $status['statusName'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="file" class="box" name="image" />
        <button type="submit" class="add">Thêm sản phẩm</button>
    </form>
</div>
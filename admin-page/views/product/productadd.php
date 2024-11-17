
<div class="admin-product-form-container">
    <form method="POST" enctype="multipart/form-data">
        <h3>Thêm sản phẩm (product)</h3>
        <?php if (!empty($errors)):?>
            <div class="errors">
                <?php foreach ($errors as $error):?>
                    <span class="error-item"><?= $error?><span/>
                <?php endforeach; ?>
            </div>
        <?php endif;?>
        <?php if (!empty($success)): ?>
            <div class="success">
                <span><?= $success?></span>
            </div>
        <?php endif; ?>
        <input type="text" placeholder="Nhập tên sản phẩm....." name="name_product" class="box" value="<?= htmlspecialchars($name_product) ?>"  />
        <input type="number" placeholder="Nhập giá sản phẩm....." name="price_product" class="box" value="<?= htmlspecialchars($price_product) ?>" />
        <input type="text" placeholder="Mô tả sản phẩm....." name="description_product" class="box" value="<?= htmlspecialchars($description_product) ?>" />
        <select class="box" name="color_product">
            <option selected>Chọn màu sản phẩm (color)</option>
            <?php foreach ($colors as $color) { ?>
                <option value="<?= $color['id'] ?>" <?= $color['id'] == $color_product ? 'selected' : ''?>>
                    <?= $color['name'] ?>
                </option>
            <?php } ?>
        </select>
        <select class="box" name="size_product">
            <option selected>Chọn size sản phẩm</option>
            <?php foreach ($sizes as $size) { ?>
                <option value="<?= $size['id'] ?>" <?= $size['id'] == $size_product ? 'selected' : ''?>>
                    <?= $size['name'] ?>
                </option>
            <?php } ?>
        </select>
        <select class="box" name="category_product">
            <option selected>Chọn danh mục sản phẩm (category)</option>
            <?php foreach ($categories as $category) { ?>
                <option value="<?= $category['id'] ?>" <?= $category['id'] == $category_product ? 'selected' : ''?>>
                    <?= $category['name'] ?>
                </option>
            <?php } ?>
        </select>
        <input type="file" accept="img/png,img/jpeg,img/jpg" class="box" name="image_product" value="<?= htmlspecialchars($image_product) ?>"/>
        <button type="submit" class="add">Thêm sản phẩm</button>
    </form>
</div>
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
</div>
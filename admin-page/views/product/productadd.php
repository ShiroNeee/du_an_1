<div class="admin-product-form-container">
    <form action="?act=create-product" method="POST" enctype="multipart/form-data">
        <h3>Thêm sản phẩm (product)</h3>
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
        <input type="text" placeholder="Nhập tên sản phẩm....." name="ProductName" class="box"/>
        <input type="number" placeholder="Nhập giá sản phẩm....." name="Price" class="box"/>
        <input type="text" placeholder="Mô tả sản phẩm....." name="Description" class="box"/>
        <select name="CategoryID" class="box" required>
            <option value="" disabled selected>Chọn danh mục</option>
            <option value="1">Nam</option>
            <option value="2">Nữ</option>
            <option value="3">Trẻ Em</option>
        </select>
        <select name="status" class="box" required>
            <option value="" disabled selected>Chọn trạng thái</option>
            <option value="1">Còn hàng</option>
            <option value="2">Hết hàng</option>
        </select>
        <input type="file" accept="img/png,img/jpeg,img/jpg" class="box" name="image"/>
        <button type="submit" class="add">Thêm sản phẩm</button>
    </form>
</div>
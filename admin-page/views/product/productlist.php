<!-- table product -->
<div class="table--wrapper">
    <h3 class="title">Danh sách sản phẩm (product)</h3>
    <a href="?act=add-product"><button class="add">Thêm sản phẩm</button></a>
    <?php if (!empty($_SESSION['success'])): ?>
			<div class="alert alert-success" style="background-color:#d4edda;border:0.5px solid #ddd;border-radius:6px;color:#155724;border-color: #c3e6cb; margin-bottom:5px;font-family: Arial, sans-serif;">
				<?= $_SESSION['success']; ?>
			</div>
			<?php unset($_SESSION['success']); ?>
		<?php endif; ?>
    <div class="table-container">
        <table style="text-align: left;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Mô tả sản phẩm</th>
                    <th>Trang thái</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listProducts as $index => $product) : ?>
                    <tr>
                        <td style="font-size:20px"><?= $index + 1; ?></td>
                        <td>
                            <img src="<?= $product['image']; ?>" width="80px">
                        </td>
                        <td style="font-size:15px"><?= $product['ProductName']; ?></td>
                        <td><?= $product['Price']; ?> đ</td>
                        <td><?= $product['CategoryName']; ?></td>
                        <td><?= $product['Description']; ?></td>

                        <td style="color:blue"><?= $product['statusName']; ?></td>
                        <td>
                            <a href="?act=edit-product&id=<?= $product['id']; ?>">
                                <button class="edit">Sửa</button>
                            </a>
                            <form action="?act=delete-product" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm?')">
                                <input type="hidden" name="id" value="<?= $product['id']; ?>">
                                <button type="submit" class="delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- table product -->
<div class="table--wrapper">
    <h3 class="title">Danh sách sản phẩm (product)</h3>
    <a href="?act=add-product"><button class="add">Thêm sản phẩm</button></a>
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
                    <th>Trang thai</th>
                    <th>Tính năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listProducts as $index => $product) : ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td>
                            <img src="<?= $product['image']; ?>" width="80px">
                        </td>
                        <td><?= $product['ProductName']; ?></td>
                        <td><?= $product['Price']; ?></td>
                        <td><?= $product['CategoryID'] == 1 ? 'Nam' : ($product['CategoryID'] == 2 ? 'Nữ' : 'Phụ kiện'); ?></td>
                        <td><?= $product['Description']; ?></td>
                        <td><?= $product['status'] == 0 ? 'Còn hàng' : 'Hết hàng'; ?></td>
                        <td>
                            <a href="?act=edit-product&id=<?= $product['id']; ?>">
                                <button class="edit">Sửa</button>
                            </a>
                            <form action="?act=delete-product" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sp?')">
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
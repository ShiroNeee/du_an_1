<style>
    /* Container for pagination */
    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination-container {
        display: inline-flex;
        align-items: center;
    }

    .page-link {
        display: inline-block;
        padding: 8px 15px;
        margin: 0 5px;
        text-decoration: none;
        color: #007bff;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .page-link:hover {
        background-color: #007bff;
        color: white;
    }

    .page-link.active {
        background-color: #007bff;
        color: white;
        pointer-events: none;
    }

    .page-link.disabled {
        color: #ddd;
        pointer-events: none;
    }

    .page-link[aria-label="Previous"] {
        font-weight: bold;
    }

    .page-link[aria-label="Next"] {
        font-weight: bold;
    }
</style>
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
                        <td><?= number_format($product['Price'], 0, ',', '.'); ?> đ</td>
                        <td><?= $product['CategoryName']; ?></td>
                        <td>
                            <?= strlen($product['Description']) > 50
                                ? htmlspecialchars(mb_substr($product['Description'], 0, 50)) . '...'
                                : htmlspecialchars($product['Description']);
                            ?>
                        </td>
                        <td style="color: <?= $product['status'] == 1 ? 'blue' : 'red'; ?>;font-size: 20px;">
                            <?= $product['statusName']; ?>
                        </td>
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
    <div class="pagination">
        <?php if ($totalPages > 1): ?>
            <div class="pagination-container">
                <a href="?act=list-product&page=<?= $page - 1; ?>" class="page-link <?= $page == 1 ? 'disabled' : ''; ?>" aria-label="Previous">
                    &laquo;
                </a>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?act=list-product&page=<?= $i; ?>" class="page-link <?= $i == $page ? 'active' : ''; ?>"><?= $i; ?></a>
                <?php endfor; ?>
                <a href="?act=list-product&page=<?= $page + 1; ?>" class="page-link <?= $page == $totalPages ? 'disabled' : ''; ?>" aria-label="Next">
                    &raquo;
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
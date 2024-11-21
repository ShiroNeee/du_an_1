<div class="table--wrapper">
    <h3 class="title">Danh mục sản phẩm (category)</h3>
    <a href="?act=add-category"><button class="add">Thêm danh mục</button></a>
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success" style="background-color:#d4edda;border:0.5px solid #ddd;border-radius:6px;color:#155724;border-color: #c3e6cb; margin-bottom:5px;font-family: Arial, sans-serif;">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <div class="table-container">
        <table style="text-align: left;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Danh mục</th>
                        <th>Tính năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listCategories as $index => $categories) : ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $categories['categoryName']; ?></td>
                            <td>
                                <a href="?act=edit-category&id=<?= $categories['id']; ?>">
                                    <button class="edit">Sửa</button>
                                </a>
                                <form action="?act=delete-category" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <input type="hidden" name="id" value="<?= $categories['id']; ?>">
                                    <button type="submit" class="delete">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
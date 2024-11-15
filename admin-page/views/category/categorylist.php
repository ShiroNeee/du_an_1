        <div class="table--wrapper">
            <h3 class="title">Danh mục sản phẩm (category)</h3>
            <a href="?act=add-category"><button class="add">Thêm danh mục</button></a>
            <div class="table-container">
                <table style="text-align: left;">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Danh mục</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listCategories as $index => $categories) : ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= $categories['categoryName']; ?></td>
                                    <td>
                                        <a href="?act=edit-category&id=<?= $categories['id']; ?>">
                                            <button class="btn btn-primary">Sửa</button>
                                        </a>
                                        <form action="?act=delete" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            <input type="hidden" name="id" value="<?= $categories['id']; ?>">
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
        </div>
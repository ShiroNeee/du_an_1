<div class="table--wrapper">
    <h3 class="title">Quản lý người dùng</h3>
    <div class="table-container">
        <table class="user-table" style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Địa chỉ</th>
                    <th>Chức vụ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listUsers as $index => $user) : ?>
                    <tr>
                        <td style="font-size: 20px;"><?= $index + 1; ?></td>
                        <td>
                            <img src="<?= $user['image']; ?>" width="80px">
                        </td>
                        </td>
                        <td style="font-size: 15px;"><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['phoneNumber']; ?></td>
                        <td><?= $user['address']; ?></td>
                        <td style="color:blue"><?= $user['roleID']== 1 ? 'Admin' : 'Người dùng';?></td>

                        <td>
                            <a href="?act=edit-user&id=<?= $user['id']; ?>">
                                <button class="edit">Sửa</button>
                            </a>
                            <form action="?act=delete-user" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                <button type="submit" class="delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
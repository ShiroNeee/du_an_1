<div class="table--wrapper">
    <h3 class="title">Quản lý người dùng</h3>
    <a href="?act=add-user"><button class="add">Thêm User</button></a>
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success" style="background-color:#d4edda;border:0.5px solid #ddd;border-radius:6px;color:#155724;border-color: #c3e6cb; margin-bottom:5px;font-family: Arial, sans-serif;">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
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
                        <td><?= $user['RoleName']; ?></td>
                        <td>
                            <?php if ($user['roleID'] != 1) : ?>
                                <a href="?act=edit-user&id=<?= $user['id']; ?>">
                                    <button class="edit">Sửa</button>
                                </a>
                                <form action="?act=delete-user" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                    <button type="submit" class="delete">Xóa</button>
                                </form>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
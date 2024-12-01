<!-- add product -->
<style>
    .showErrorMessage {
        background-color: #f8d7da;
        color: red;
        border: 1px solid #f5c2c7;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
        font-size: 14px;
        font-family: Arial, sans-serif;
        margin-left: 20px;
        width: 1170px;
    }

    .showErrorMessage ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    .showErrorMessage li {
        margin-bottom: 5px;
    }
</style>
<div class="admin-product-form-container">
    <form action="?act=create-user" method="POST" enctype="multipart/form-data">
        <h3>Thêm thành viên mới</h3>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="showErrorMessage">
                <ul>
                    <?php foreach ($_SESSION['error'] as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <input type="text" placeholder="Nhập tên người dùng mới" name="name" class="box" />
        <input type="email" class="box" name="email" placeholder="Nhập email" />
        <input type="password" class="box" name="password" placeholder="Nhập mật khẩu" />
        <input type="password" class="box" name="confirm_password" placeholder="Xác nhận mật khẩu" />
        <input type="number" class="box" name="phoneNumber" placeholder="Nhập số điện thoại" />
        <input type="text" class="box" name="address" placeholder=" Nhập địa chỉ" />

        <select name="roleID" class="box">
            <option value="choose" disabled selected>Chọn vai trò</option>
            <?php foreach ($roles as $role): ?>
                <?php if ($role['RoleID'] != 3): // Kiểm tra và ẩn RoleID = 3 
                ?>
                    <option value="<?= $role['RoleID'] ?>">
                        <?= $role['RoleName'] ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <input type="file" class="box" name="image" />
        <button type="submit" class="add">Thêm</button>
    </form>
</div>
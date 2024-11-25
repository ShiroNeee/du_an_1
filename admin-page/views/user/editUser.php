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
    <form action="?act=update-user" method="POST" enctype="multipart/form-data">
        <h3>Chỉnh Sửa Người Dùng</h3>
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
        <input type="hidden" name="id" value="<?= $userDetail['id'] ?>">

        <input type="text" name="name" class="box" value="<?= $userDetail['name'] ?>" placeholder="Nhập họ tên người dùng...">

        <input type="text" name="email" class="box" value="<?= $userDetail['email'] ?>" placeholder="Nhập email...">

        <input type="text" name="phoneNumber" class="box" value="<?= $userDetail['phoneNumber'] ?>" placeholder="Nhập số điện thoại...">

        <!-- Không hiển thị mật khẩu đã mã hóa -->
        <input type="password" name="password" class="box" placeholder="Nhập mật khẩu">
        <input type="password" name="confirm_password" class="box" placeholder="Nhập lại mật khẩu mới">

        <input type="text" name="address" class="box" value="<?= $userDetail['address'] ?>" placeholder="Nhập địa chỉ">

        <select name="roleID" class="box">
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role['RoleID'] ?>" <?= $userDetail['roleID'] == $role['RoleID'] ? 'selected' : '' ?>>
                    <?= $role['RoleName'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="file" name="image" class="box">
        <br />
        <td>
            <img src="<?= $userDetail['image']; ?>" alt="Hình ảnh" width="80px" style="margin-left:20px">
        </td>
        <br />
        <button type="submit" class="add">Cập nhật</button>
    </form>
</div>
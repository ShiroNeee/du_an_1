<div class="admin-product-form-container">
    <form action="?act=update-user" method="POST" enctype="multipart/form-data">
        <h3>Chỉnh Sửa Người Dùng</h3>
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
            <button type="submit" class="add" >Cập nhật</button>
        </form>
    </div>
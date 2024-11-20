<div class="table--wrapper">
    <h3>Chỉnh Sửa Người Dùng</h3>
    <div class="admin-product-form-container">
        <form action="?act=update-user" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $userDetail['id'] ?>">
            <label for="name">Họ và Tên</label>
            <input type="text" name="name" class="box" value="<?= $userDetail['name'] ?>" placeholder="Nhập họ tên">
            <label for="email">Email</label>
            <input type="text" name="email" class="box" value="<?= $userDetail['email'] ?>" placeholder="Nhập email">

            <label for="phoneNumber">Số Điện Thoại</label>
            <input type="text" name="phoneNumber" class="box" value="<?= $userDetail['phoneNumber'] ?>" placeholder="Nhập sđt">

            <!-- Không hiển thị mật khẩu đã mã hóa -->
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" class="box" placeholder="Nhập mật khẩu">

            <label for="confirm_password">Xác nhận mật khẩu mới</label>
            <input type="password" name="confirm_password" class="box" placeholder="Nhập lại mật khẩu mới">

            <label for="address">Địa Chỉ</label>
            <input type="text" name="address" class="box" value="<?= $userDetail['address'] ?>" placeholder="Nhập địa chỉ">

            <label for="">Role</label>
            <select name="roleID" class="box">
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['RoleID'] ?>" <?= $userDetail['roleID'] == $role['RoleID'] ? 'selected' : '' ?>>
                        <?= $role['RoleName'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="image">Hình Ảnh</label>
            <input type="file" name="image" class="box">
            <br />
            <td>
                <img src="<?= $userDetail['image']; ?>" alt="Hình ảnh" width="80px">
            </td>
            <br />
            <a href="?act=list-user">
                <button type="button" class="add">Danh sách</button>
            </a>
            <button type="submit" class="add">Cập nhật</button>
        </form>
    </div>
</div>
<div class="admin-product-form-container">
    <form action="?act=update-user" method="POST" enctype="multipart/form-data">
        <h3>Chỉnh Sửa Người Dùng</h3>
            <input type="hidden" name="id" value="<?= $userDetail['id'] ?>">
            <input type="text" name="name" class="box" value="<?= $userDetail['name'] ?>" placeholder="Nhập họ tên người dùng...">
            <input type="text" name="email" class="box" value="<?= $userDetail['email'] ?>" placeholder="Nhập email...">

            <input type="text" name="phoneNumber" class="box" value="<?= $userDetail['phoneNumber'] ?>" placeholder="Nhập số điện thoại...">

             <!-- Không hiển thị mật khẩu đã mã hóa -->
            <input type="password" name="password" class="box" placeholder="Nhập mật khẩu....">
            <input type="password" name="confirm_password" class="box" placeholder="Nhập lại mật khẩu mới....">

            <input type="text" name="address" class="box" value="<?= $userDetail['address'] ?>" placeholder="Nhập địa chỉ nhà....">

            <select name="roleID" class="box">
                <option value="1" <?= $userDetail['roleID'] == '1' ? 'selected' : '' ?>>Quản trị viên</option>
                <option value="2" <?= $userDetail['roleID'] == '2' ? 'selected' : '' ?>>Người dùng</option>
            </select>

            <input type="file" name="image" class="box">
            <br />
            <td>
            <img src="<?= $userDetail['image']; ?>" alt="Hình ảnh" width="80px">
            </td>
            <br/>
            <a href="?act=list-user">
                <button type="button" class="add">Danh sách</button>
            </a>
            <button type="submit" class="add">Cập nhật</button>
        </form>
    </div>
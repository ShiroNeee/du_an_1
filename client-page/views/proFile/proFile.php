<div class="container mt-5">
    <h2 class="text-center mb-4">Chỉnh sửa thông tin cá nhân</h2>
    <form action="?act=update-Profile" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $userDetail['id'] ?>">

        <!-- Họ và Tên -->
        <div class="mb-3">
            <label for="name" class="form-label">Họ và Tên</label>
            <input type="text" name="name" class="form-control" value="<?= $userDetail['name'] ?>" placeholder="Nhập họ tên">
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $userDetail['email'] ?>" placeholder="Nhập email">
        </div>

        <!-- Số Điện Thoại -->
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Số Điện Thoại</label>
            <input type="text" name="phoneNumber" class="form-control" value="<?= $userDetail['phoneNumber'] ?>" placeholder="Nhập sđt">
        </div>

        <!-- Mật khẩu -->
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới (nếu có)">
        </div>

        <!-- Xác nhận mật khẩu -->
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu mới">
        </div>

        <!-- Địa Chỉ -->
        <div class="mb-3">
            <label for="address" class="form-label">Địa Chỉ</label>
            <input type="text" name="address" class="form-control" value="<?= $userDetail['address'] ?>" placeholder="Nhập địa chỉ">
        </div>

        <!-- Ẩn roleID -->
        <input type="hidden" name="roleID" value="<?= $userDetail['roleID'] ?>">

        <!-- Hình Ảnh -->
        <div class="mb-3">
            <label for="image" class="form-label">Hình Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Hiển thị ảnh hiện tại -->
        <div class="mb-3">
            <label class="form-label"></label>
            <img src="<?= $userDetail['image']; ?>" alt="Hình ảnh" width="80px" class="img-fluid">
        </div>

        <!-- Nút cập nhật -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
</div>

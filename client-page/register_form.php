<main class="d-flex align-items-center justify-content-center mb-5 mt-5" style="height: 100vh;">
    <div class="col-md-4">
        <h3 class="text-center mb-3">Đăng Ký</h3>

        <form action="?act=handle-register" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>

            <input type="hidden" name="roleID" value="2" />

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
        </form>

        <div class="text-center mt-3">
            <p>Bạn đã có tài khoản? <a href="?act=login" style="text-decoration: none;">Đăng nhập tại đây</a></p>
        </div>
    </div>
</main>
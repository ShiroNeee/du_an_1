<main class="d-flex align-items-center justify-content-center mb-5 mt-5" style="height: 100vh;">
    <div class="col-md-4">
        <h3 class="text-center mb-3">Đăng Ký</h3>

        <!-- Lỗi chung -->
        <?php if (!empty($_SESSION['error']['general'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']['general']; unset($_SESSION['error']['general']); ?></div>
        <?php endif; ?>

        <form action="?act=handle-register" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="name" name="name">
                <?php if (!empty($_SESSION['error']['name'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['name']; unset($_SESSION['error']['name']); ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
                <?php if (!empty($_SESSION['error']['email'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['email']; unset($_SESSION['error']['email']); ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php if (!empty($_SESSION['error']['password'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['password']; unset($_SESSION['error']['password']); ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <?php if (!empty($_SESSION['error']['confirm_password'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['confirm_password']; unset($_SESSION['error']['confirm_password']); ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                <?php if (!empty($_SESSION['error']['phoneNumber'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['phoneNumber']; unset($_SESSION['error']['phoneNumber']); ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address">
                <?php if (!empty($_SESSION['error']['address'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['address']; unset($_SESSION['error']['address']); ?></small>
                <?php endif; ?>
            </div>
            
            <input type="hidden" name="roleID" value="2" />

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php if (!empty($_SESSION['error']['image'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['image']; unset($_SESSION['error']['image']); ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
        </form>

        <div class="text-center mt-3">
            <p>Bạn đã có tài khoản? <a href="?act=login">Đăng nhập tại đây</a></p>
        </div>
    </div>
</main>
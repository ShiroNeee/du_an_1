<main class="d-flex align-items-center justify-content-center mb-5 mt-5" style="height: 100vh;">
    <div class="col-md-4">
        <h3 class="text-center mb-3">Đăng Nhập</h3>

        <!-- Thông báo thành công -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <!-- Lỗi chung -->
        <?php if (!empty($_SESSION['error']['general'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']['general']; unset($_SESSION['error']['general']); ?></div>
        <?php endif; ?>

        <form action="?act=handle-login" method="POST">
            <div class="mb-3 position-relative">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn">

                <?php if (!empty($_SESSION['error']['email'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['email']; unset($_SESSION['error']['email']); ?></small>
                <?php endif; ?>
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">

                <?php if (!empty($_SESSION['error']['password'])): ?>
                    <small class="text-danger"><?= $_SESSION['error']['password']; unset($_SESSION['error']['password']); ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>

        <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản? <a href="?act=register">Đăng ký tại đây</a></p>
        </div>
    </div>
</main>
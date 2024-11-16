<main class="d-flex align-items-center justify-content-center mb-5 mt-5" style="height: 100vh;">
    <div class="col-md-4">
        <h3 class="text-center mb-3">Đăng Nhập</h3>
        <!-- Hiển thị thông báo thành công từ đăng ký -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Hiển thị lỗi chung nếu đăng nhập không thành công -->
        <?php if (isset($_SESSION['error']['general'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']['general']; ?>
                <?php unset($_SESSION['error']['general']); ?>
            </div>
        <?php endif; ?>

        <form action="?act=handle-login" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Nhập email của bạn">
                <span style="color: red;">
                    <?= !empty($_SESSION['error']['email']) ? $_SESSION['error']['email'] : '' ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                <span style="color: red;">
                    <?= !empty($_SESSION['error']['password']) ? $_SESSION['error']['password'] : '' ?>
                </span>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
        <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản? <a href="?act=register">Đăng ký tại đây</a></p>
        </div>
    </div>
</main>
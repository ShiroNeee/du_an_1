<main class="d-flex align-items-center justify-content-center" style="height: 60vh;">
    <div class="col-md-2">
        <h3 class="text-center mb-2">Đăng Ký</h3>
        <form>
            <div class="mb-3">
                <label for="username" class="form-label">Tên người dùng</label>
                <input type="text" class="form-control" id="username" placeholder="Nhập tên người dùng" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Nhập email của bạn" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
        </form>
        <div class="text-center mt-3">
            <p>Bạn đã có tài khoản? <a href="?act=login">Đăng nhập tại đây</a></p>
        </div>
    </div>
</main>
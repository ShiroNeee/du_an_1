
<main class="d-flex justify-content-center align-items-center my-5">
    <div class="col-md-4">
        <h3 class="text-center mb-3">Đăng Nhập</h3>

        <form action="?act=handle-login" method="POST">
            <div class="mb-3 position-relative">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn">
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>

        <div class="text-center mt-3 ">
            <p>Bạn chưa có tài khoản? <a href="?act=register" style="text-decoration: none;">Đăng ký tại đây</a></p>
        </div>
    </div>
</main>
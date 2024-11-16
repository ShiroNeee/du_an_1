<main class="d-flex align-items-center justify-content-center mb-5 mt-5" style="height: 100vh;">
    <div class="col-md-4">
        <h3 class="text-center mb-3">Đăng Ký</h3>

            <?php if (!empty($_SESSION['error']['general'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']['general']; ?>
                </div>
                <?php unset($_SESSION['error']['general']); ?>
            <?php endif; ?>

        <form action="?act=handle-register" method="POST" enctype="multipart/form-data">
            <div class="mb-3 position-relative">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="name" name="name" />
                <!-- Hiển thị lỗi bên cạnh -->
                <?php if (isset($_SESSION['error']['name'])): ?>
                    <div class="text-danger position-absolute" style="top: 100%; left: 0; font-size: 0.875rem;">
                        <?php echo $_SESSION['error']['name'];
                        unset($_SESSION['error']['name']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3 position-relative">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" />
                <!-- Hiển thị lỗi bên cạnh -->
                <?php if (isset($_SESSION['error']['email'])): ?>
                    <div class="text-danger position-absolute" style="top: 100%; left: 0; font-size: 0.875rem;">
                        <?php echo $_SESSION['error']['email'];
                        unset($_SESSION['error']['email']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" />
                <!-- Hiển thị lỗi bên cạnh -->
                <?php if (isset($_SESSION['error']['password'])): ?>
                    <div class="text-danger position-absolute" style="top: 100%; left: 0; font-size: 0.875rem;">
                        <?php echo $_SESSION['error']['password'];
                        unset($_SESSION['error']['password']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3 position-relative">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" />
                <!-- Hiển thị lỗi bên cạnh -->
                <?php if (isset($_SESSION['error']['confirm_password'])): ?>
                    <div class="text-danger position-absolute" style="top: 100%; left: 0; font-size: 0.875rem;">
                        <?php echo $_SESSION['error']['confirm_password'];
                        unset($_SESSION['error']['confirm_password']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3 position-relative">
                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" />
                <!-- Hiển thị lỗi bên cạnh -->
                <?php if (isset($_SESSION['error']['phoneNumber'])): ?>
                    <div class="text-danger position-absolute" style="top: 100%; left: 0; font-size: 0.875rem;">
                        <?php echo $_SESSION['error']['phoneNumber'];
                        unset($_SESSION['error']['phoneNumber']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3 position-relative">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" />
                <!-- Hiển thị lỗi bên cạnh -->
                <?php if (isset($_SESSION['error']['address'])): ?>
                    <div class="text-danger position-absolute" style="top: 100%; left: 0; font-size: 0.875rem;">
                        <?php echo $_SESSION['error']['address'];
                        unset($_SESSION['error']['address']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3 position-relative" >
                <label for="roleID" class="form-label">Vai trò</label>
                <select id="roleID" class="form-control" name="roleID">
                <option value="">Chọn Role</option>
                    <option value="1">Quản trị viên</option>
                    <option value="2">Người dùng</option>
                </select>
                <!-- Hiển thị lỗi bên cạnh -->
                <?php if (isset($_SESSION['error']['roleID'])): ?>
                    <div class="text-danger position-absolute" style="top: 100%; left: 0; font-size: 0.875rem;">
                        <?php echo $_SESSION['error']['roleID'];
                        unset($_SESSION['error']['roleID']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3 position-relative">
                <label for="image" class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control" id="image" name="image" />
                <!-- Hiển thị lỗi bên cạnh -->
                <?php if (isset($_SESSION['error']['image'])): ?>
                    <div class="text-danger position-absolute" style="top: 100%; left: 0; font-size: 0.875rem;">
                        <?php echo $_SESSION['error']['image'];
                        unset($_SESSION['error']['image']); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <p>Bạn đã có tài khoản? <a href="?act=login">Đăng nhập tại đây</a></p>
        </div>
    </div>
</main>
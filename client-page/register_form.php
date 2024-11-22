<style>
    .gradient-custom-2 {
        background: linear-gradient(to right, #ffffff, #87ceeb);
    }
</style>
<main class="gradient-form">
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-10">
                <div class="card border shadow-lg">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <form action="?act=handle-register" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Họ tên</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mật khẩu</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                                    </div>

                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu">
                                    </div>

                                    <div class="mb-3">
                                        <label for="phoneNumber" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Nhập ố điện thoại">
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder=" Nhập địa chỉ">
                                    </div>

                                    <input type="hidden" name="roleID" value="2" />

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ảnh đại diện</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 text-black">Đăng ký</button>
                                    <div class="d-flex align-items-center pb-4">
                                        <p class="mb-0 me-2">Bạn có tài khoản rồi ?</p>
                                        <a 
                                        href="?act=login" 
                                        class="text-decoration-none">Ấn vào đây</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                <h4>ĐĂNG KÝ TÀI KHOẢN CỦA BẠN</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
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
                                <form 
                                action="?act=handle-login" 
                                method="POST">
                                    <div class="mb-3 position-relative">
                                        <label 
                                        for="email" 
                                        class="form-label"
                                        >Email</label>
                                        <input 
                                        type="email" 
                                        class="form-control" 
                                        id="email" 
                                        name="email" 
                                        placeholder="Nhập email của bạn">
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label 
                                        for="password" 
                                        class="form-label">Mật khẩu</label>
                                        <input 
                                        type="password" 
                                        class="form-control" 
                                        id="password" 
                                        name="password"
                                        placeholder="Nhập mật khẩu">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col d-flex">
                                            <div class="col">
                                                <!-- Simple link -->
                                                <a 
                                                href="#!" 
                                                class="text-decoration-none">Forgot password?</a>
                                            </div>
                                            <!-- Checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" checked />
                                                <label class="form-check-label"> Remember me </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 text-black">
                                        Đăng nhập
                                    </button>
                                    <div class="d-flex align-items-center pb-4">
                                        <p class="mb-0 me-2">Chưa có tài khoản?</p>
                                        <a 
                                        href="?act=register" 
                                        class="text-decoration-none">Tạo mới</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                <h4>ĐĂNG NHẬP TÀI KHOẢN CỦA BẠN</h4>
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
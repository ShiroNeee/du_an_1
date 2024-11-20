<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="../client-page" style="text-decoration: none;">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" style="text-decoration: none;">Cài đặt</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <h3 class="text-center mb-4">Chỉnh sửa thông tin cá nhân</h3>
        <form action="?act=update-Profile" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $userDetail['id'] ?>">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <label class="form-label"></label>
                                <img src="<?= $userDetail['image']; ?>" alt="Hình ảnh" width="100px" class="img-fluid">
                            </div>
                            <h5 class="my-3"><?= $userDetail['name'] ?></h5>
                            <p class="text-muted mb-1"><?= $userDetail['email'] ?></p>
                            <p class="text-muted mb-1"><?= $userDetail['phoneNumber'] ?></p>
                            <p class="text-muted mb-4"><?= $userDetail['address'] ?></p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <p class="mb-0">https://mdbootstrap.com</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-github fa-lg text-body"></i>
                                <a href="https://github.com/ShiroNeee/du_an_1"
                                style="text-decoration: none; color: black;" >Github</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                <p class="mb-0">Twitter</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                <p class="mb-0">Instagram</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                <p class="mb-0">Facebook</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="<?= $userDetail['name'] ?>" placeholder="Nhập họ tên">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" value="<?= $userDetail['email'] ?>" placeholder="Nhập email">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="phoneNumber" class="form-control" value="<?= $userDetail['phoneNumber'] ?>" placeholder="Nhập số điện thoại">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" value="<?= $userDetail['address'] ?>" placeholder="Nhập địa chỉ">
                                </div>
                            </div>
                            <hr>
                            <!-- Ẩn roleID -->
                            <input type="hidden" name="roleID" value="<?= $userDetail['roleID'] ?>">

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Mật khẩu</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới (nếu có)">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Xác nhận mật khẩu</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu mới">
                                </div>
                            </div>
                            <hr>
                            <input type="file" name="image" class="form-control">
                            <hr>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="submit" class="btn btn-outline-primary">Cập nhật Thông tin</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</section>
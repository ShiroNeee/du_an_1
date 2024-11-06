<body>
    <div class="banner-content">
        <div>
            <h2>Đăng nhập</h2>
        </div>
        <div>
            <form action="?act=handle-login" method="POST">

                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Nhập email">
                <span style="color: red;">
                    <?= !empty($_SESSION['error']['email']) ? $_SESSION['error']['email'] : '' ?>
                </span>
                <br>

                <label for="mat_khau">Mật khẩu:</label>
                <input type="password" name="mat_khau" placeholder="Nhập mật khẩu">
                <span style="color: red;">
                    <?= !empty($_SESSION['error']['mat_khau']) ? $_SESSION['error']['mat_khau'] : '' ?>
                </span>
                <br>

                <button type="submit">Đăng nhập</button>
            </form>
        </div>

    </div>
</body>
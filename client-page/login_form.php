<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
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

</body>
</html>

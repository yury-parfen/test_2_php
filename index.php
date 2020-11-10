<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация и регистрация</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">

        <div class="reg">
            <h1>Форма регистрации</h1>
            <form>
                <input type="text" name="reg_login" placeholder="Введите логин" required>
                <p class="error error_login login_repeat"></p>
                <input type="password" name="reg_password" placeholder="Введите пароль" required>
                <p class="error non_confirm error_pass"></p>
                <input type="password" name="confirm_password" placeholder="Подтвердите пароль" required><br>
                <input type="email" name="reg_email" placeholder="Введите e-mail" required>
                <p class="error email_repeat"></p>
                <input type="text" name="reg_name" placeholder="Введите имя" required>
                <p class="error error_name"></p>
                <input type="submit" class="reg-btn" value="Зарегистрироваться">
                <p class="success"></p>
            </form>
        </div>

        <div class="auth">
            <h1>Форма авторизации</h1>
            <form>
                <input type="text" name="auth_login" placeholder="Введите логин" required>
                <p class="error error_user"></p>
                <input type="password" name="auth_password" placeholder="Введите пароль" required>
                <p class="error error_password error_empty"></p>
                <input type="submit" class="login-btn" value="Авторизоваться">
            </form>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
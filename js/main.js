//  Авторизация

$('.login-btn').click(function (e) {

    e.preventDefault();

    let login = $('input[name="auth_login"]').val(),
        password = $('input[name="auth_password"]').val();

    $.ajax({
        url: 'lib/auth.php',
        type: 'POST',
        dataType: 'json',
        data: {
            auth_login: login,
            auth_password: password,
        },
        success (data) {

            if (data.status === 'true') {
                document.location.href = '/profile.php';
            } else if (data.status === 'false_user') {
                $('.error_user').text(data.message);
            } else if (data.status === 'false_password') {
                $('.error_password').text(data.message);
            } else {
                $('.error_empty').text(data.message);
            }

        }
    });

});




//  Регистрация

$('.reg-btn').click(function (e) {

    e.preventDefault();

    let reg_login = $('input[name="reg_login"]').val(),
        reg_password = $('input[name="reg_password"]').val();
        confirm_password = $('input[name="confirm_password"]').val(),
        email = $('input[name="reg_email"]').val(),
        name = $('input[name="reg_name"]').val();

    $.ajax({
        url: 'lib/reg.php',
        type: 'POST',
        dataType: 'json',
        data: {
            reg_login: reg_login,
            reg_password: reg_password,
            confirm_password: confirm_password,
            reg_email: email,
            reg_name: name
        },
        success (data) {

            if (data.status === 'success') {
                $('.success').text(data.message);
            } else if (data.status === 'non_confirm_password') {
                $('.non_confirm').text(data.message);
            } else if (data.status === 'error_login') {
                $('.error_login').text(data.message);
            } else if (data.status === 'error_name') {
                $('.error_name').text(data.message);
            } else if (data.status === 'error_pass') {
                $('.error_pass').text(data.message);
            }  if (data.status === 'login_repeat') {
                $('.login_repeat').text(data.message);
            }  if (data.status === 'email_repeat') {
                $('.email_repeat').text(data.message);
            }

        }
    });

});
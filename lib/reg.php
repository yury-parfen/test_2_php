<?php
session_start();

$login = $_POST['reg_login'];
$password = $_POST['reg_password'];
$confirm_password = $_POST['confirm_password'];
$email = $_POST['reg_email']; 
$name = $_POST['reg_name'];

// Валидация логина

if(!ctype_alnum($login)) {
    $response = [
        "status" => 'error_login',
        "message" => 'Логин должен состоять только из букв и цифр'
    ];
    echo json_encode($response);
    die();
}
if (!preg_match("/\w{6,}/", $login)) {
    $response = [
        "status" => 'error_login',
        "message" => 'Логин должен состоять минимум из 6 символов'
    ];
    echo json_encode($response);
    die();
}

// Валидация пароля

if (!preg_match("/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/", $password)) {
    $response = [
        "status" => 'error_pass',
        "message" => 'Пароль обязательно должнен содержать цифру, буквы в разных регистрах и спец символ и состоять минимум из 6 символов'
    ];
    echo json_encode($response);
    die();
}

// Валидация имени

if(!ctype_alnum($name)) {
    $response = [
        "status" => 'error_name',
        "message" => 'Имя должно состоять только из букв и цифр'
    ];
    echo json_encode($response);
    die();
}
if (!preg_match("/\w{2,}/", $name)) {
    $response = [
        "status" => 'error_name',
        "message" => 'Имя должно состоять минимум из 2 символов'
    ];
    echo json_encode($response);
    die();
}

    $xml = simplexml_load_file('../bd.xml');  
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);

    foreach ($array['user'] as $user) {
        
        if ($login === $user['login']) {
            $response = [
                "status" => 'login_repeat',
                "message" => 'Такой логин занят'
            ];
            echo json_encode($response);
            die();   
        } 
        if ($email === $user['reg_email']) {
            $response = [
                "status" => 'email_repeat',
                "message" => 'Такой email занят'
            ];
            echo json_encode($response);
            die();   
        } 
    }

if ($password === $confirm_password) {

    $salt = password_hash($password, PASSWORD_DEFAULT);
    $password = md5($password . $salt);
 
    $user = $xml -> addChild('user');
    $user -> addChild("login", "$login");
    $user -> addChild('password', "$password");
    $user -> addChild('salt', "$salt");
    $user -> addChild('email', "$email");
    $user -> addChild('name', "$name");
    $xml->saveXML('../bd.xml');

    $response = [
        "status" => 'success',
        "message" => 'Регистрация прошла успешно'
    ];
    echo json_encode($response);

} else {
    $response = [
        "status" => 'non_confirm_password',
        "message" => 'Пароли не сопадают'
    ];
    echo json_encode($response);
}

?>




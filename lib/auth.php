<?php
session_start();

    $login = $_POST['auth_login'];
    $password = $_POST['auth_password'];


    // Проверка полей

    $error_fields =[];
    if ($login === '') {
        $error_fields[] = 'login';
    } 
    if ($password === '') {
        $error_fields[] = 'password';
    } 
    if (!empty($error_fields)) {
        $response = [
            "status" => 'false_empty',
            "message" => 'Проверьте правильность полей'
        ];
        echo json_encode($response);
        die();
    }


    $xml = simplexml_load_file('../bd.xml');  
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);

    foreach ($array['user'] as $user) {
        
        $i = 0;
        $j = 0;

        if ($login === $user['login']) {
            if (md5($password . $user['salt']) === $user['password']) {
                $i++;
                $name = $user['name'];
            } else {
                $j++;
            } 
        } 
    }

    if ($i == 0 && $j == 0) {

        $response = [
            "status" => 'false_user',
            "message" => 'Пользователь не найден'
        ];
        echo json_encode($response);

    } elseif ($i == 0 && $j > 0) {

        $response = [
            "status" => 'false_password',
            "message" => 'Не верный пароль'
        ];
        echo json_encode($response);

    } else {

        $_SESSION['profile'] = [
            "name" => $name
        ];
        
        $response = [
            "status" => 'true'
        ];
        echo json_encode($response);
    }
    
?>


<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

if ($_SERVER['HTTP_HOST'] != getenv("HTTP_HOST")) return false;
$res = 2;
$send_donor = 1;

$fio = strip_tags(trim($_POST["fio"]));
$email = strip_tags(trim($_POST["email"]));
$phone = strip_tags(trim($_POST["phone"]));
$city = strip_tags(trim($_POST["city"])); //Ваш город проживания
$page = strip_tags(trim($_POST["page"]));

// doc
$theme = strip_tags(trim($_POST["theme"]));

$message = "ФИО: $fio <br>E-mail: $email <br>Телефон: $phone<br>Ваш город проживания: $city";
if (strlen($theme) > 0) {
    $message .= "<br>Тема обращения: $theme";
}

$message .= "<br>Страница отправки: $page";

// database start

if (isset($_POST["fio"]) && isset($_POST["phone"])) {
    $host = 'localhost'; // адрес сервера
    $database = 'embrymama_ankets'; // имя базы данных
    $user = 'embrymama_ankets'; // имя пользователя
    $password = 'H7rXK7Lm'; // пароль
    $roistat = !empty($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie';
// подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database);
    if (!$link) {
        echo json_encode($res);
        die();
    }
// выполняем операции с базой данных
    $query = "INSERT INTO bio_international SET created = now(), fio = '$fio', email = '$email', phone = '$phone', city = '$city', roistat = '$roistat', url = '$page', theme = '$theme'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        echo json_encode($res);
        die();
    }
    $queryLastDonorId = "SELECT * FROM bio_international ORDER BY id DESC LIMIT 1";
    $resultLDI = mysqli_query($link, $queryLastDonorId) or die("Ошибка " . mysqli_error($link));
    if ($resultLDI) {
        $row = mysqli_fetch_assoc($resultLDI);
        $send_donor = $row['id'] % 2;
    }
// закрываем подключение
    mysqli_close($link);
}

// database end

// ROISTAT BEGIN

$comment = "Страница отправки формы: $page; Тема обращения: $theme; Страна обращения: Киргизия;";

$user_id = "28754977"; // Нона
if ($theme == 'Xочу стать сурмамой') {
    $user_id = '7210801'; // Artem
    // $send_donor == 0 ? '7210801' : '11684302'; // Artem / Каныкей
}

$roistatData = array(
    'roistat' => !empty($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie',
    'key' => 'Yjg1OTE3MWE0YjNlOGIzMGY4MjgxNWFkOWNlMDkxODY6MTY0NjAw',
    'title' => 'Новый лид',
    'comment' => $comment,
    'name' => $fio,
    'email' => $email,
    'phone' => $phone,
    'fields' => array(
        '727915' => $city, //Ваш город проживания
        'pipeline_id' => $theme == 'Ищу сурмаму' ? '3720811' : '7398546',
        'responsible_user_id' => $user_id,
    ),
    // 'is_skip_sending' => '1',
);

file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));

// ROISTAT END

$to = 'drgregory@mail.ru, sharonivan@yandex.ru';
$subject = 'Заявка с сайта';
$headers = "From: hello@embrymama.com" . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$result = mail($to, $subject, $message, $headers);

if ($result) {
    $res = 1;
} else {
    $res = 2;
}
echo json_encode($res);

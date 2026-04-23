<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

$res = 2;

$fio = strip_tags(trim($_REQUEST["fio"]));
$phone = strip_tags(trim($_REQUEST["phone_call"]));
$page = strip_tags(trim($_REQUEST["page"]));
$message = "ФИО: $fio <br>Телефон: $phone<br>Страница отправки: $page";

// database start
if (isset($_REQUEST["fio"]) && isset($_REQUEST["phone_call"])) {
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
    $query = "INSERT INTO bio_international SET created = now(), fio = '$fio', email = '', phone = '$phone', city = '', roistat = '$roistat', url = '$page', theme = ''";
    $result = mysqli_query($link, $query);
    if (!$result) {
        echo json_encode($res);
        die();
    }
// закрываем подключение
    mysqli_close($link);
// database end

// ROISTAT BEGIN
    $comment = "Запрос на звонок; Страница отправки формы: $page; Страна обращения: Таджикистан;";
    $roistatData = array(
        'roistat' => !empty($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie',
        'key' => 'Yjg1OTE3MWE0YjNlOGIzMGY4MjgxNWFkOWNlMDkxODY6MTY0NjAw',
        'title' => 'Новый лид',
        'comment' => $comment,
        'name' => $fio,
        'phone' => $phone,
        'fields' => array(
            'pipeline_id' => '3720811',
            'responsible_user_id' => '28754977', // Anna
        ),
    );
    file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
// ROISTAT END

    $to = 'drgregory@mail.ru, sharonivan@yandex.ru';
    $subject = 'Заявка на звонок с сайта';
    $headers = "From: hello@embrymama.com" . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $result = mail($to, $subject, $message, $headers);
}
if ($result) {
    $res = 1;
} else {
    $res = 2;
}
echo json_encode($res);

<?php

if (isset($_POST['donor_id'])) {
    $donor_id = strip_tags($_POST['donor_id']);
    $host = 'localhost'; // адрес сервера 
    $database = 'embrymama_ankets'; // имя базы данных
    $user = 'embrymama_ankets'; // имя пользователя
    $password = 'H7rXK7Lm'; // пароль
// подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
    $queryDel = "DELETE FROM ankets_donor WHERE donor_id = '$donor_id'";
    $resultDel = mysqli_query($link, $queryDel) or die("Ошибка " . mysqli_error($link));
    
    $query = "INSERT INTO ankets_donor SET donor_id = '$donor_id', started = now()";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if ($result) {
        $res = 1;
    } else {
        $res = 2;
    }
    echo json_encode($res);
// закрываем подключение
    mysqli_close($link);
}
?>

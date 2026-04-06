<?php
// 11.06.21
// 81 - У вас имеется свидетельство о расторжении брака?
// 82 - Согласны ли вы на многоплодную беременность? (перенос 2 эмбрионов родителей)
$send_donor = 1;

if (isset($_POST['q1'])) {
    $host = 'localhost'; // адрес сервера
    $database = 'embrymama_ankets'; // имя базы данных
    $user = 'embrymama_ankets'; // имя пользователя
    $password = 'H7rXK7Lm'; // пароль
    //
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    // выполняем операции с базой данных
    $step = 1;
    $query = '';
    while ($step <= 85) {
        if ($step === 1) {
            $answer = strip_tags($_POST["q$step"]);
            if (strlen($_POST["q$step"]) > 0) {
                $query .= "q$step = '$answer'";
            }
            $step++;
        } else {
            $answer = strip_tags($_POST["q$step"]);
            if (strlen($_POST["q$step"]) > 0) {
                $query .= ", q$step = '$answer'";
            }
            $step++;
        }
    }
    if (strlen($_POST["q12comment"]) > 0) {
        $comment = $answer = strip_tags($_POST["q12comment"]);
        $query .= ", q12comment = '$comment'";
    }
    $q231 = '';
    if (strlen($_POST["q231"]) > 0 || strlen($_POST["q232"]) > 0 || strlen($_POST["q233"]) > 0 || strlen($_POST["q234"]) > 0 || strlen($_POST["q235"]) > 0) {
        $comment = strip_tags($_POST["q231"]) . " " . strip_tags($_POST["q232"]) . " " . strip_tags($_POST["q233"]) . " " . strip_tags($_POST["q234"]) . " " . strip_tags($_POST["q235"]);
        $query .= ", q23 = '$comment'";
    }
    $q261 = '';
    if (strlen($_POST["q261"]) > 0 || strlen($_POST["q262"]) > 0 || strlen($_POST["q263"]) > 0 || strlen($_POST["q264"]) > 0 || strlen($_POST["q265"]) > 0) {
        $comment = strip_tags($_POST["q261"]) . " " . strip_tags($_POST["q262"]) . " " . strip_tags($_POST["q263"]) . " " . strip_tags($_POST["q264"]) . " " . strip_tags($_POST["q265"]);
        $query .= ", q26 = '$comment'";
    }
    $q331 = '';
    if (strlen($_POST["q331"]) > 0 || strlen($_POST["q332"]) > 0 || strlen($_POST["q333"]) > 0 || strlen($_POST["q334"]) > 0 || strlen($_POST["q335"]) > 0) {
        $comment = strip_tags($_POST["q331"]) . " " . strip_tags($_POST["q332"]) . " " . strip_tags($_POST["q333"]) . " " . strip_tags($_POST["q334"]) . " " . strip_tags($_POST["q335"]);
        $query .= ", q33 = '$comment'";
    }
    $q361 = '';
    if (strlen($_POST["q361"]) > 0 || strlen($_POST["q362"]) > 0 || strlen($_POST["q363"]) > 0 || strlen($_POST["q364"]) > 0 || strlen($_POST["q365"]) > 0) {
        $comment = strip_tags($_POST["q361"]) . " " . strip_tags($_POST["q362"]) . " " . strip_tags($_POST["q363"]) . " " . strip_tags($_POST["q364"]) . " " . strip_tags($_POST["q365"]);
        $query .= ", q36 = '$comment'";
    }
    $q431 = '';
    if (strlen($_POST["q431"]) > 0 || strlen($_POST["q432"]) > 0 || strlen($_POST["q433"]) > 0 || strlen($_POST["q434"]) > 0 || strlen($_POST["q435"]) > 0) {
        $comment = strip_tags($_POST["q431"]) . " " . strip_tags($_POST["q432"]) . " " . strip_tags($_POST["q433"]) . " " . strip_tags($_POST["q434"]) . " " . strip_tags($_POST["q435"]);
        $query .= ", q43 = '$comment'";
    }
    $q461 = '';
    if (strlen($_POST["q461"]) > 0 || strlen($_POST["q462"]) > 0 || strlen($_POST["q463"]) > 0 || strlen($_POST["q464"]) > 0 || strlen($_POST["q465"]) > 0) {
        $comment = strip_tags($_POST["q461"]) . " " . strip_tags($_POST["q462"]) . " " . strip_tags($_POST["q463"]) . " " . strip_tags($_POST["q464"]) . " " . strip_tags($_POST["q465"]);
        $query .= ", q46 = '$comment'";
    }

    if (strlen($_POST["q75"]) > 0) {
        $query .= ", step = 1";
    }

    $donor_id = $_POST['donor_id'];
    $queryIn = "UPDATE ankets SET $query WHERE donor_id = '$donor_id'";

    $result = mysqli_query($link, $queryIn) or die("Ошибка " . mysqli_error($link));

    $queryDonorId = "SELECT * FROM ankets WHERE donor_id = '$donor_id'";
    $resultDI = mysqli_query($link, $queryDonorId) or die("Ошибка " . mysqli_error($link));
    if ($resultDI) {
        $row = mysqli_fetch_assoc($resultDI);
        $send_donor = $row['id'] % 2;
    }

    if (strlen($_POST["q75"]) > 0) {
        $to = 'kamillakhmedovaa@gmail.com, nona@embrymama.com, nazikatakanova13@gmail.com, info@embrymama.ru, drgregory@mail.ru';

        $subject = 'Суррогатная мама ' . strip_tags($_POST['q73']) . ' заполнила форму';
        $headers = "From: hello@embrycare.ru" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message = '<html><body>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= $agent;
        $message .= "<tr><td>ФИО<td>" . strip_tags($_POST['q1']) . "</td></tr>";
        $message .= "<tr><td>Дата рождения<td>" . strip_tags($_POST['q2']) . "</td></tr>";
        $message .= "<tr><td>Укажите количество полных лет (возраст)<td>" . strip_tags($_POST['q76']) . "</td></tr>";
        $message .= "<tr><td>Гражданство<td>" . strip_tags($_POST['q3']) . "</td></tr>";
        $message .= "<tr><td>Национальность<td>" . strip_tags($_POST['q4']) . "</td></tr>";
        $message .= "<tr><td>Место жительства (страна, город)<td>" . strip_tags($_POST['q5']) . "</td></tr>";

        $message .= "<tr><td>Группа крови<td>" . strip_tags($_POST['q6']) . "</td></tr>";
        $message .= "<tr><td>Резус фактор<td>" . strip_tags($_POST['q7']) . "</td></tr>";
        $message .= "<tr><td>Были ли инъекции иммуноглобулина при беременности?<td>" . strip_tags($_POST['q77']) . "</td></tr>";
        $message .= "<tr><td>Был ли конфликт резус-фактора при рождении детей (были ли повышены антитела к резус-фактору во время беременности)?<td>" . strip_tags($_POST['q78']) . "</td></tr>";

        $message .= "<tr><td>Тип телосложения<td>" . strip_tags($_POST['q8']) . "</td></tr>";
        $message .= "<tr><td>Рост (в сантиметрах)<td>" . strip_tags($_POST['q9']) . "</td></tr>";

        $message .= "<tr><td>Вес<td>" . strip_tags($_POST['q10']) . "</td></tr>";
        $message .= "<tr><td>Наличие хронических заболеваний и их указание<td>" . strip_tags($_POST['q11']) . "</td></tr>";
        $message .= "<tr><td>Наличие операций и их указание<td>" . strip_tags($_POST['q12']) . "</td></tr>";
        //12 Наличие операций и их указание
        $message .= "<tr><td>Наличие заболеваний, передающихся половым путем<td>" . strip_tags($_POST['q13']) . "</td></tr>";

        $message .= "<tr><td>Комментарий<td>" . strip_tags($_POST['q12comment']) . "</td></tr>";

        $message .= "<tr><td>Курите ли Вы? (сигареты/кальян)<td>" . strip_tags($_POST['q14']) . "</td></tr>";
        $message .= "<tr><td>Частота употребления и вид потребляемого (сигареты или кальян)<td>" . strip_tags($_POST['q15']) . "</td></tr>";
        $message .= "<tr><td>Употребляете ли Вы наркотики?<td>" . strip_tags($_POST['q16']) . "</td></tr>";
        $message .= "<tr><td>Общее количество беременностей<td>" . strip_tags($_POST['q17']) . "</td></tr>";
        $message .= "<tr><td>Общее количество родов<td>" . strip_tags($_POST['q18']) . "</td></tr>";

        //1
        $message .= "<tr><td>Роды № 1</td></tr>";
        $message .= "<tr><td>На какой неделе были роды?<td>" . strip_tags($_POST['q19']) . "</td></tr>";
        $message .= "<tr><td>Рост новорожденного<td>" . strip_tags($_POST['q20']) . "</td></tr>";
        $message .= "<tr><td>Вес новорожденного<td>" . strip_tags($_POST['q21']) . "</td></tr>";
        $message .= "<tr><td>Имеются ли у ребенка какие либо заболевания<td>" . strip_tags($_POST['q22']) . "</td></tr>";
        $message .= "<tr><td>Как протекала Ваша беременность?<td>" . strip_tags($_POST['q231']) . " " . strip_tags($_POST['q232']) . " " . strip_tags($_POST['q233']) . " " . strip_tags($_POST['q234']) . " " . strip_tags($_POST['q235']) . "</td></tr>";
        $message .= "<tr><td>По какой причине была госпитализация?<td>" . strip_tags($_POST['q24']) . "</td></tr>";
        $message .= "<tr><td>По какой причине назначались капельницы?<td>" . strip_tags($_POST['q25']) . "</td></tr>";
        $message .= "<tr><td>Как протекали Ваши роды?<td>" . strip_tags($_POST['q261']) . " " . strip_tags($_POST['q262']) . " " . strip_tags($_POST['q263']) . " " . strip_tags($_POST['q264']) . " " . strip_tags($_POST['q265']) . "</td></tr>";

        $message .= "<tr><td>Какие осложнения возникли во время родов?<td>" . strip_tags($_POST['q27']) . "</td></tr>";
        $message .= "<tr><td>Было ли кесарево сечение?<td>" . strip_tags($_POST['q28']) . "</td></tr>"; // 28
        //1 end

        //2
        if (intval(strip_tags($_POST['q18'])) > 1) {
            $message .= "<tr><td>Роды № 2</td></tr>";
            $message .= "<tr><td>На какой неделе были роды?<td>" . strip_tags($_POST['q29']) . "</td></tr>";
            $message .= "<tr><td>Рост новорожденного<td>" . strip_tags($_POST['q30']) . "</td></tr>";
            $message .= "<tr><td>Вес новорожденного<td>" . strip_tags($_POST['q31']) . "</td></tr>";
            $message .= "<tr><td>Имеются ли у ребенка какие либо заболевания<td>" . strip_tags($_POST['q32']) . "</td></tr>";
            $message .= "<tr><td>Как протекала Ваша беременность?<td>" . strip_tags($_POST['q331']) . " " . strip_tags($_POST['q332']) . " " . strip_tags($_POST['q333']) . " " . strip_tags($_POST['q334']) . " " . strip_tags($_POST['q335']) . "</td></tr>";
            $message .= "<tr><td>По какой причине была госпитализация?<td>" . strip_tags($_POST['q34']) . "</td></tr>";
            $message .= "<tr><td>По какой причине назначались капельницы?<td>" . strip_tags($_POST['q35']) . "</td></tr>";
            $message .= "<tr><td>Как протекали Ваши роды?<td>" . strip_tags($_POST['q361']) . " " . strip_tags($_POST['q362']) . " " . strip_tags($_POST['q363']) . " " . strip_tags($_POST['q364']) . " " . strip_tags($_POST['q365']) . "</td></tr>";

            $message .= "<tr><td>Какие осложнения возникли во время родов?<td>" . strip_tags($_POST['q37']) . "</td></tr>";
            $message .= "<tr><td>Было ли кесарево сечение?<td>" . strip_tags($_POST['q38']) . "</td></tr>";
        }
        //2 end

        //3
        if (intval(strip_tags($_POST['q18'])) > 2) {
            $message .= "<tr><td>Роды № 3</td></tr>";
            $message .= "<tr><td>На какой неделе были роды?<td>" . strip_tags($_POST['q39']) . "</td></tr>";
            $message .= "<tr><td>Рост новорожденного<td>" . strip_tags($_POST['q40']) . "</td></tr>";
            $message .= "<tr><td>Вес новорожденного<td>" . strip_tags($_POST['q41']) . "</td></tr>";
            $message .= "<tr><td>Имеются ли у ребенка какие либо заболевания<td>" . strip_tags($_POST['q42']) . "</td></tr>";
            $message .= "<tr><td>Как протекала Ваша беременность?<td>" . strip_tags($_POST['q431']) . " " . strip_tags($_POST['q432']) . " " . strip_tags($_POST['q433']) . " " . strip_tags($_POST['q434']) . " " . strip_tags($_POST['q435']) . "</td></tr>";
            $message .= "<tr><td>По какой причине была госпитализация?<td>" . strip_tags($_POST['q44']) . "</td></tr>";
            $message .= "<tr><td>По какой причине назначались капельницы?<td>" . strip_tags($_POST['q45']) . "</td></tr>";
            $message .= "<tr><td>Как протекали Ваши роды?<td>" . strip_tags($_POST['q461']) . " " . strip_tags($_POST['q462']) . " " . strip_tags($_POST['q463']) . " " . strip_tags($_POST['q464']) . " " . strip_tags($_POST['q465']) . "</td></tr>";

            $message .= "<tr><td>Какие осложнения возникли во время родов?<td>" . strip_tags($_POST['q47']) . "</td></tr>";
            $message .= "<tr><td>Было ли кесарево сечение?<td>" . strip_tags($_POST['q48']) . "</td></tr>";
        }
        //3 end

        $message .= "<tr><td>Были ли у Вас самопроизвольные аборты?<td>" . strip_tags($_POST['q49']) . "</td></tr>"; // 49
        $message .= "<tr><td>Сколько самопроизвольных абортов у вас было?<td>" . strip_tags($_POST['q50']) . "</td></tr>";
        $message .= "<tr><td>Было ли роды после самопроизвольного аборта?<td>" . strip_tags($_POST['q51']) . "</td></tr>"; //51
        $message .= "<tr><td>Были ли у Вас искусственные аборты?<td>" . strip_tags($_POST['q52']) . "</td></tr>";
        $message .= "<tr><td>Сколько искусственных абортов у вас было?<td>" . strip_tags($_POST['q53']) . "</td></tr>";
        $message .= "<tr><td>Были ли роды после аборта?<td>" . strip_tags($_POST['q54']) . "</td></tr>";
        $message .= "<tr><td>Есть ли у вас антитела к вирусу краснухи?<td>" . strip_tags($_POST['q55']) . "</td></tr>"; // Продолжительность менструального цикла
        $message .= "<tr><td>Дата начала последних месячных<td>" . strip_tags($_POST['q56']) . "</td></tr>"; //56

        $message .= "<tr><td>Семейное положение<td>" . strip_tags($_POST['q57']) . "</td></tr>";
        $message .= "<tr><td>Нотариальное согласие от мужа<td>" . strip_tags($_POST['q86']) . "</td></tr>";
        $message .= "<tr><td>У вас имеется свидетельство о расторжении брака?<td>" . strip_tags($_POST['q81']) . "</td></tr>";
        $message .= "<tr><td>Ведете ли Вы половую жизнь?<td>" . strip_tags($_POST['q58']) . "</td></tr>";
        $message .= "<tr><td>Какой способ контрацепции вы используете?<td>" . strip_tags($_POST['q59']) . "</td></tr>";
        $message .= "<tr><td>Принимаете ли Вы какие-либо препараты/лекарства на постоянной основе (помимо витаминных комплексов)?<td>" . strip_tags($_POST['q60']) . "</td></tr>";
        $message .= "<tr><td>Укажите препараты/лекарства, которые вы принимаете на постоянной основе<td>" . strip_tags($_POST['q61']) . "</td></tr>";

        $message .= "<tr><td>Количество детей<td>" . strip_tags($_POST['q62']) . "</td></tr>";
        $message .= "<tr><td>Дата рождения младшего ребенка<td>" . strip_tags($_POST['q63']) . "</td></tr>"; // 59

        $message .= "<tr><td>Образование<td>" . strip_tags($_POST['q64']) . "</td></tr>";
        $message .= "<tr><td>Специальность<td>" . strip_tags($_POST['q65']) . "</td></tr>";
        $message .= "<tr><td>Работаете ли Вы в данный момент?<td>" . strip_tags($_POST['q66']) . "</td></tr>";
        $message .= "<tr><td>Вы готовы оперативно уволиться с работы для участия в программе?<td>" . strip_tags($_POST['q79']) . "</td></tr>";
        $message .= "<tr><td>Программа предполагает переезд в Санкт-Петербург на время беременности. Вы готовы на переезд (переезд возможен с ребенком за счет агентства)?<td>" . strip_tags($_POST['q80']) . "</td></tr>";
        $message .= "<tr><td>Есть ли у вас кредитные задолженности?<td>" . strip_tags($_POST['q83']) . "</td></tr>";
        $message .= "<tr><td>Есть ли у вас судимости?<td>" . strip_tags($_POST['q84']) . "</td></tr>";
        $message .= "<tr><td>Есть ли у вас ограничения на переезд?<td>" . strip_tags($_POST['q85']) . "</td></tr>";

        $message .= "<tr><td>Место работы<td>" . strip_tags($_POST['q67']) . "</td></tr>"; // 63

        $message .= "<tr><td>Почему Вы решили стать суррогатной мамой?<td>" . strip_tags($_POST['q68']) . "</td></tr>";
        $message .= "<tr><td>Есть ли у Вас опыт участия в прогамме суррогатного материнства?<td>" . strip_tags($_POST['q69']) . "</td></tr>";
        $message .= "<tr><td>В каком году?<td>" . strip_tags($_POST['q70']) . "</td></tr>";
        $message .= "<tr><td>Были ли роды в ранее принимаемой программе суррогатного материнства? При отрицательном ответе, описать причину отсутствия родоразрешения<td>" . strip_tags($_POST['q71']) . "</td></tr>";
        $message .= "<tr><td>Есть ли документы подтверждающие участие?<td>" . strip_tags($_POST['q72']) . "</td></tr>";
        $message .= "<tr><td>Согласны ли вы на многоплодную беременность? (перенос 2 эмбрионов родителей)<td>" . strip_tags($_POST['q82']) . "</td></tr>";
        $message .= "<tr><td>Ваш номер телефона<td>" . strip_tags($_POST['q73']) . "</td></tr>";
        $message .= "<tr><td>Ваша электронная почта<td>" . strip_tags($_POST['q74']) . "</td></tr>";
        $message .= "<tr><td>Откуда узнали о нашем центре<td>" . strip_tags($_POST['q75']) . "</td></tr>";
        $message .= "<tr><td>DONOR_ID<td>" . strip_tags($donor_id) . "</td></tr>";
        if (strlen($doctor) > 0) {
            $message .= "<tr><td>Доктор: №<td>" . strip_tags($doctor) . "</td></tr>";
        }
        $message .= "</table>";
        $message .= "</body></html>";

        mail($to, $subject, $message, $headers);
    }
    if ($result) {
        $res = 1;
    } else {
        $res = 2;
    }
    echo json_encode($res);

    // закрываем подключение
    mysqli_close($link);
}


// ROISTAT BEGIN
if (!empty($_REQUEST['q74']) || !empty($_REQUEST['q73'])) {
    $youngestDate = getCorrectDate(strip_tags($_POST['q63']));
    $birthdate = getCorrectDate(strip_tags($_POST['q2']));
    $lastM = getCorrectDate(strip_tags($_POST['q56']));
    $type = null;

    if (stripos($_POST['q8'], 'ктоморф') !== false) {
        $type = '1. эктоморф (худой тип)';
    }
    if (stripos($_POST['q8'], 'ндоморф') !== false) {
        $type = '3. эндоморф (крупный тип)';
    }
    if (stripos($_POST['q8'], 'езоморф') !== false) {
        $type = '2. мезоморф (атлетичный тип)';
    }

    $doctor = strip_tags(trim($_POST["doctor"]));
    $agent = '';
    if (strlen(strip_tags(trim($_POST["agent_name"]))) > 0) {
        $agent = 'Заявка получена от агента: ' . strip_tags(trim($_POST["agent_name"])) . ' (' . strip_tags(trim($_POST["agent_email"])) . ') - ' . strip_tags(trim($_POST["agent"]));
    }

    $user_rsp = '28754977';

    $roistatData = array(
        'roistat' => !empty($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie',
        'key' => 'Yjg1OTE3MWE0YjNlOGIzMGY4MjgxNWFkOWNlMDkxODY6MTY0NjAw',
        'title' => !empty($_REQUEST['q1']) ? $_REQUEST['q1'] : 'Новый лид',
        'name' => $_REQUEST['q1'],
        'email' => $_REQUEST['q74'],
        'phone' => $_REQUEST['q73'],
        'comment' => $agent,
        // 'is_skip_sending' => '1',
        'fields' => array(
            '741041' => strip_tags($_POST["agent"]), // agent ID
            '735081' => $doctor, // doctor ID
            '315901' => $birthdate, // Дата рождения
            '312061' => strip_tags($_POST['q3']), // Гражданство
            '312063' => strip_tags($_POST['q4']), // Национальность
            '296031' => strip_tags($_POST['q5']), // Место жительства
            '312065' => strip_tags($_POST['q6']), // Группа крови
            '312067' => strip_tags($_POST['q7']), // Резус фактор
            '312073' => $type, // Тип телосложения
            '704951' => strip_tags($_POST['q9']), // Рост
            '704953' => strip_tags($_POST['q10']), // Вес
            '312079' => strip_tags($_POST['q11']), // Наличие хрон. заболеваний
            '312081' => strip_tags($_POST['q13']) . ' ' . strip_tags($_POST['q12comment']), // Наличие ЗППП
            '312083' => strip_tags($_POST['q14']), // Курите ли вы
            '312085' => strip_tags($_POST['q15']), // Частота употребления (курение)
            '312087' => strip_tags($_POST['q16']), // Употр. ли вы наркотики
            '312099' => strip_tags($_POST['q49']), // Были ли самопроизв. аборты
            '312101' => strip_tags($_POST['q50']), // Сколько самопроизв. абортов было?
            '312107' => strip_tags($_POST['q54']), // Были ли роды после абортов
            '312109' => strip_tags($_POST['q55']), // Есть ли у вас антитела к вирусу краснухи // Продолжительность менстр. цикла
            '310401' => strip_tags($_POST['q57']), // Семейное положение
            '747193' => strip_tags($_POST['q86']), // Нотариальное согласие от мужа
            '708255' => strip_tags($_POST['q81']), // У вас имеется свидетельство о расторжении брака?
            '312513' => strip_tags($_POST['q58']), // q58 = ведете ли вы половую жизнь
            '312517' => strip_tags($_POST['q59']), // q59 = способ контрацепции
            '312521' => strip_tags($_POST['q60']), // q60 = Принимаете ли Вы какие-либо препараты
            '312529' => strip_tags($_POST['q61']), // q61 = Укажите препараты
            '312103' => strip_tags($_POST['q51']), // q51 = были ли роды после самопроизв абортов
            '309613' => strip_tags($_POST['q62']), // Сколько детей
            '312113' => strip_tags($_POST['q64']), // Образование
            '312115' => strip_tags($_POST['q65']), // Специальность
            '312117' => strip_tags($_POST['q66']), // Работаете ли вы в д момент
            '312119' => strip_tags($_POST['q67']), // Место работы
            '312121' => strip_tags($_POST['q68']), // Почему вы решили стать сур. мамой
            '312123' => strip_tags($_POST['q69']), // Есть ли у вас опыт
            '312125' => strip_tags($_POST['q70']), // В каком году
            '321671' => strip_tags($_POST['q71']), // БЫЛИ ЛИ РОДЫ В РАНЕЕ ПРИНИМАЕМОЙ ПРОГРАММЕ СУРРОГАТНОГО МАТЕРИНСТВА?
            '312127' => strip_tags($_POST['q72']), // Есть ли документы
            '708257' => strip_tags($_POST['q82']), // Согласны ли вы на многоплодную беременность? (перенос 2 эмбрионов родителей)

            '312129' => strip_tags($_POST['q75']), // Откуда узнали о центре
            '312111' => $lastM, // Дата начала посл. месячных
            '312505' => $youngestDate, // Дата рождения младшего ребенка

            '321617' => strip_tags($_POST['q12']), // Наличие операций и их указание
            '321619' => strip_tags($_POST['q17']), // Общее кол-во беременностей
            '321621' => strip_tags($_POST['q18']), // Общее кол-во родов
            '704957' => strip_tags($_POST['q19']), // РОДЫ 1 СРОК РОДОРАЗРЕШЕНИЯ (НА КАКОЙ НЕДЕЛЕ БЫЛИ РОДЫ
            '321625' => strip_tags($_POST['q20']), // РОДЫ 1 РОСТ НОВОРОЖДЕННОГО
            '321627' => strip_tags($_POST['q21']), // РОДЫ 1 ВЕС НОВОРОЖДЕННОГО
            '321629' => strip_tags($_POST['q22']), // РОДЫ 1 ИМЕЮТСЯ ЛИ У РЕБЕНКА КАКИЕ ЛИБО ЗАБОЛЕВАНИЯ
            '312091' => strip_tags($_POST['q24']), // РОДЫ 1 ПО КАКОЙ ПРИЧИНЕ БЫЛА ГОСПИТАЛИЗАЦ
            '312093' => strip_tags($_POST['q25']), // РОДЫ 1 По какой причине назначались капельниц
            '312097' => strip_tags($_POST['q27']), // РОДЫ 1 Какие осложнения возникли во время родов?
            '309615' => strip_tags($_POST['q28']), // РОДЫ 1 БЫЛО ЛИ КЕСАРЕВО
            '312089' => strip_tags($_POST['q231']) . " " . strip_tags($_POST['q232']) . " " . strip_tags($_POST['q233']) . " " . strip_tags($_POST['q234']) . " " . strip_tags($_POST['q235']), // РОДЫ 1 КАК ПРОТЕКАЛА БЕРЕМЕННОСТЬ
            '312095' => strip_tags($_POST['q261']) . " " . strip_tags($_POST['q262']) . " " . strip_tags($_POST['q263']) . " " . strip_tags($_POST['q264']) . " " . strip_tags($_POST['q265']), // РОДЫ 1 КАК ПРОТЕКАЛИ РОДЫ
            '704955' => strip_tags($_POST['q29']), // РОДЫ 2 СРОК РОДОРАЗРЕШЕНИЯ (НА КАКОЙ НЕДЕЛЕ БЫЛИ РОДЫ
            '321633' => strip_tags($_POST['q30']), // РОДЫ 2 РОСТ НОВОРОЖДЕННОГО
            '321635' => strip_tags($_POST['q31']), // РОДЫ 2 ВЕС НОВОРОЖДЕННОГО
            '321637' => strip_tags($_POST['q32']), // РОДЫ 2 ИМЕЮТСЯ ЛИ У РЕБЕНКА КАКИЕ ЛИБО ЗАБОЛЕВАНИЯ
            '321643' => strip_tags($_POST['q34']), // РОДЫ 2 ПО КАКОЙ ПРИЧИНЕ БЫЛА ГОСПИТАЛИЗАЦ
            '321645' => strip_tags($_POST['q35']), // РОДЫ 2 По какой причине назначались капельниц
            '321647' => strip_tags($_POST['q37']), // РОДЫ 2 Какие осложнения возникли во время родов?
            '321649' => strip_tags($_POST['q38']), // РОДЫ 2 БЫЛО ЛИ КЕСАРЕВО
            '321639' => strip_tags($_POST['q331']) . " " . strip_tags($_POST['q332']) . " " . strip_tags($_POST['q333']) . " " . strip_tags($_POST['q334']) . " " . strip_tags($_POST['q335']), // РОДЫ 2 КАК ПРОТЕКАЛА БЕРЕМЕННОСТЬ
            '321641' => strip_tags($_POST['q361']) . " " . strip_tags($_POST['q362']) . " " . strip_tags($_POST['q363']) . " " . strip_tags($_POST['q364']) . " " . strip_tags($_POST['q365']), // РОДЫ 2 КАК ПРОТЕКАЛИ РОДЫ
            '704959' => strip_tags($_POST['q39']), // РОДЫ 3 СРОК РОДОРАЗРЕШЕНИЯ (НА КАКОЙ НЕДЕЛЕ БЫЛИ РОДЫ
            '321653' => strip_tags($_POST['q40']), // РОДЫ 3 РОСТ НОВОРОЖДЕННОГО
            '321655' => strip_tags($_POST['q41']), // РОДЫ 3 ВЕС НОВОРОЖДЕННОГО
            '321657' => strip_tags($_POST['q42']), // РОДЫ 3 ИМЕЮТСЯ ЛИ У РЕБЕНКА КАКИЕ ЛИБО ЗАБОЛЕВАНИЯ
            '321663' => strip_tags($_POST['q44']), // РОДЫ 3 ПО КАКОЙ ПРИЧИНЕ БЫЛА ГОСПИТАЛИЗАЦ
            '321665' => strip_tags($_POST['q45']), // РОДЫ 3 По какой причине назначались капельниц
            '321667' => strip_tags($_POST['q47']), // РОДЫ 3 Какие осложнения возникли во время родов?
            '321669' => strip_tags($_POST['q48']), // РОДЫ 3 БЫЛО ЛИ КЕСАРЕВО
            '321659' => strip_tags($_POST['q431']) . " " . strip_tags($_POST['q432']) . " " . strip_tags($_POST['q433']) . " " . strip_tags($_POST['q434']) . " " . strip_tags($_POST['q435']), // РОДЫ 3 КАК ПРОТЕКАЛА БЕРЕМЕННОСТЬ
            '321661' => strip_tags($_POST['q461']) . " " . strip_tags($_POST['q462']) . " " . strip_tags($_POST['q463']) . " " . strip_tags($_POST['q464']) . " " . strip_tags($_POST['q465']), // РОДЫ 3 КАК ПРОТЕКАЛИ РОДЫ
            '296023' => strip_tags($_POST['q52']), // Были ли искусс аборты
            '312105' => strip_tags($_POST['q53']), // Сколько абортов

            '703503' => strip_tags($_POST['q79']), // готовы ли уволиться
            '703505' => strip_tags($_POST['q80']), // готовы ли на переезд
            '747187' => strip_tags($_POST['q83']), // Есть ли у вас кредитные задолженности?
            '747189' => strip_tags($_POST['q84']), // Есть ли у вас судимости?
            '747191' => strip_tags($_POST['q85']), // Есть ли у вас ограничения на переезд?

            '703497' => strip_tags($_POST['q76']), // кол-во полных лет
            '703499' => strip_tags($_POST['q77']), // были ли инъекции иммуноглобулина
            '703501' => strip_tags($_POST['q78']), // был ли конфликт резус фактора
            'pipeline_id' => '7398546',
            'responsible_user_id' => $user_rsp,
        )
    );

    file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
}
function getCorrectDate($date)
{
    $arr = explode('-', $date);
    return $arr[2] . '-' . $arr[1] . '-' . $arr[0];
}

// ROISTAT END

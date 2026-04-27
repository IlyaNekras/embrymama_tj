<?php
/*
template name: Анкета для сурмам
template post type: page
*/
?>
<?php

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

function generate_string($input, $strength = 16)
{
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

$val = generate_string($permitted_chars, 32);
if (!$_COOKIE['donor_id']) {
    setcookie('donor_id', $val, time() + 60 * 60 * 24 * 7);
    header("Refresh:0");
    die();
}

$d = null;
if ($_COOKIE['doctor']) {
    $d = $_COOKIE['doctor'];
} else if ($_GET['doctor']) {
    $d = $_GET['doctor'];
    setcookie("doctor", $d, time() + 260000, "/", "embrymama.com/kg", 0);
}
$agent = null;
if ($_COOKIE['agent']) {
    $agent = $_COOKIE['agent'];
} else if ($_GET['agent'] && strlen($_COOKIE['agent']) == 0) {
    $agent = $_GET['agent'];
    setcookie("agent", $agent, time() + 2592000, "/", "embrymama.com/kg", 0);
}
if (strlen($agent) > 0) {
    // получаем информацию об агенте
    $host = 'localhost'; // адрес сервера
    $database = 'embrymama_agents'; // имя базы данных
    $user = 'embrymama_agents'; // имя пользователя
    $password = 'etTPhG4B'; // пароль
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
    $query = "SELECT * FROM users WHERE link = '$agent'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if ($result) {
        // echo "Выполнение запроса прошло успешно";
        $row = mysqli_fetch_assoc($result);
        // var_dump($row);
        $agent_fio = $row['fio'];
        $agent_email = $row['email'];
    }
    // закрываем подключение
    mysqli_close($link);
}
get_header(); ?>

<style>
    button {
        padding: 0;
        margin: 0;
        list-style-type: none;
        display: inline-block;
        vertical-align: middle;
        background: 0 0;
        border: none;
    }

    .step0,
    .step2,
    .step3,
    .step4,
    .step5,
    .step6,
    .step7 {
        display: none;
        width: 100% !important;
        margin: auto !important;
    }

    .step1 {
        width: 100% !important;
        margin: auto !important;
    }

    .intro_section {
        min-height: 290px;
    }

    .info_section {
        min-height: calc(100vh - 555px);
        padding-top: 190px;
        padding-bottom: 85px;
    }

    button.startNew {
        background: #f8c7b2;
        font-size: 18px;
        padding: 25px 40px;
        border-radius: 100px;
    }

    button.startNew:hover {
        background: #634f99;
        color: #fff;
    }

    button.continueOld {
        background: #f4eeea;
        font-size: 18px;
        padding: 25px 40px;
        border-radius: 100px;
        margin-right: 10px;
    }

    button.continueOld:hover {
        background: #634f99;
        color: #fff;
    }

    input {
        background: none;
        border: none;
        padding-right: 20px;
        border-bottom: 1px solid #000000;
        font-weight: bold;
        font-size: 12px;
        line-height: 18px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #323F4B;
        width: 100%;
        display: block;
        padding-bottom: 7px;
        max-width: 500px;
        margin: 0 auto 15px;
        position: relative;
        z-index: 1;
    }

    input:focus {
        border-color: #f8c7b2;
    }

    .buttons {
        display: flex;
        max-width: 500px;
        margin: auto;
        justify-content: space-between;
    }

    .buttons.buttons1 {
        display: flex;
        max-width: 500px;
        margin: auto;
        justify-content: flex-end;
    }

    button.nextStep {
        background: #f4eeea;
        padding: 20px 50px;
        border-radius: 30px;
    }

    button.nextStep:hover {
        background: #f8c7b2;
        cursor: pointer;
    }

    .center {
        text-align: center;
    }

    .relative {
        max-width: 500px;
        margin: auto;
        position: relative;
        padding: 25px 15px 5px;
        border-radius: 5px;
        background: #f4eee9;
        margin-bottom: 20px;
    }

    .relative label {
        position: absolute;
        z-index: 0;
        top: 22px;
        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
    }

    .relative input:focus~label,
    .relative input:valid~label,
    .moved {
        top: 7px !important;
        font-size: 10px;
    }

    .relativeR {
        max-width: 500px;
        margin: auto;
        position: relative;
        margin-bottom: 20px;
        background: #f4eee9;
        padding: 5px 15px;
        border-radius: 5px;
    }

    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }

    [type="radio"]:checked+label,
    [type="radio"]:not(:checked)+label {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: block;
        margin: 0 0 7px;
        color: #666;
    }

    [type="radio"]:checked+label:before,
    [type="radio"]:not(:checked)+label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 18px;
        height: 18px;
        border: 1px solid #ddd;
        border-radius: 100%;
        background: #fff;
    }

    [type="radio"]:checked+label:after,
    [type="radio"]:not(:checked)+label:after {
        content: '';
        width: 10px;
        height: 10px;
        background: #f8c7b2;
        position: absolute;
        top: 4px;
        left: 4px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    [type="radio"]:not(:checked)+label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }

    [type="radio"]:checked+label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }

    .relativeR div {
        margin: 10px 0;
        width: 48%;
        display: inline-block;
        vertical-align: top;
    }

    .relativeR div:first-child {
        font-weight: bold;
        font-size: 14px;
        margin-right: 2%;
    }

    .relativeR label {
        font-weight: 100;
    }

    .comment {
        width: 100% !important;
        margin: 10px 0;
        min-height: 80px;
        padding: 7px 10px;
    }

    .hided {
        display: none;
        width: 100% !important;
        margin: auto !important;
        margin: 0 auto 20px !important;
    }

    .anim {
        width: 100% !important;
        margin: auto !important;
        margin: 0 auto 20px !important;
    }

    .form-group input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
    }

    .form-group label {
        position: relative;
        cursor: pointer;
        display: block;
        margin: 0 0 7px;
    }

    .form-group label:before {
        content: '';
        -webkit-appearance: none;
        background-color: #ffffff;
        border: 1px solid #dddddd;
        padding: 8px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
        top: -2px;
    }

    .form-group input:checked+label:after {
        content: '';
        display: block;
        position: absolute;
        top: 3px;
        left: 6px;
        width: 6px;
        height: 10px;
        border: solid #f8c7b2;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .height2x input {
        height: 45px;
    }

    @media screen and (max-width: 767px) {
        footer::before {
            display: none;
        }

        h2 {
            margin: 30px;
        }
    }
</style>

<?php
$host = 'localhost'; // адрес сервера
$database = 'embrymama_ankets'; // имя базы данных
$user = 'embrymama_ankets'; // имя пользователя
$password = 'H7rXK7Lm'; // пароль
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$donor_id = $_COOKIE['donor_id'];
$query = "SELECT id, DATE_FORMAT(started, " . "'%d/%m/%Y %H:%i'" . ") as started, "
    . "q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, "
    . "q11, q12, q12comment, q13, q14, q15, q16, q17, q18, q19, q20, "
    . "q21, q22, q23, q24, q25, q26, q27, q28, q29, q30, "
    . "q31, q32, q33, q34, q35, q36, q37, q38, q39, q40, "
    . "q41, q42, q43, q44, q45, q46, q47, q48, q49, q50, "
    . "q51, q52, q53, q54, q55, q56, q57, q58, q59, q60, "
    . "q61, q62, q63, q64, q65, q66, q67, q68, q69, q70, "
    . "q71, q72, q73, q74, q75, q76, q77, q78, q79, q80, "
    . "q81, q82, q83, q84, q85, q86, "
    . "step FROM ankets WHERE donor_id = '$donor_id' and step = 0";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if ($result) {
    // echo "Выполнение запроса прошло успешно";
    $row = mysqli_fetch_assoc($result);
    // var_dump($row['started']);
    $started = $row['started'];
    $step = $row['step'];
}
// закрываем подключение
mysqli_close($link);
?>
<section class="info_section">
    <div class="container">
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        }
        ?>
    </div>
    <form method="post" id="form_surmama">
        <?php
        if ($_GET['from_bishkek'] == '1') {
            echo '<input type="hidden" name="from_bishkek" value="1">';
        }
        ?>
        <input type="hidden" name="donor_id" value="<?php echo $donor_id; ?>">
        <input type="hidden" name="doctor" value="<?php echo $d; ?>">
        <input type="hidden" name="agent" value="<?php echo $agent; ?>">
        <input type="hidden" name="agent_name" value="<?php echo $agent_fio; ?>">
        <input type="hidden" name="agent_email" value="<?php echo $agent_email; ?>">
        <div class="container step1">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="center" style="max-width: 600px; margin: 0px auto 20px;"><?php pll_e('Расширенная анкета на программу Суррогатного материнства с EmbryMama') ?></h2>
                    <p class="center" style="max-width: 500px; margin: 0px auto 20px;"><?php pll_e('Заполните анкету, чтобы узнать, подходите ли вы для программы. Заполнение анкеты займет 3-5 минут') ?></p>
                    <div class="relative">
                        <input type="text" name="q1" required value="<?php echo $row['q1'] ? $row['q1'] : ''; ?>">
                        <label><?php pll_e('ФИО') ?></label>
                    </div>
                    <div class="relative">
                        <input type="date" name="q2" required placeholder=""
                            value="<?php echo $row['q2'] ? $row['q2'] : ''; ?>">
                        <label class="moved"><?php pll_e('Дата рождения') ?></label>
                    </div>
                    <div class="relative">
                        <input type="number" name="q76" required placeholder=""
                            value="<?php echo $row['q76'] ? $row['q76'] : ''; ?>">
                        <label><?php pll_e('Укажите количество полных лет (возраст)') ?></label>
                    </div>
                    <div class="relative">
                        <input type="text" name="q3" required value="<?php echo $row['q3'] ? $row['q3'] : ''; ?>">
                        <label><?php pll_e('Гражданство') ?></label>
                    </div>
                    <div class="relative">
                        <input type="text" name="q4" required value="<?php echo $row['q4'] ? $row['q4'] : ''; ?>">
                        <label><?php pll_e('Национальность') ?></label>
                    </div>
                    <div class="relative">
                        <input type="text" name="q5" required value="<?php echo $row['q5'] ? $row['q5'] : ''; ?>">
                        <label><?php pll_e('Место жительства (страна, город)') ?></label>
                    </div>
                    <div class="buttons buttons1">
                        <button type="button" class="nextStep" onclick="validate(1, 5, 2, [76])"><?php pll_e('Далее') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container step2">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="center"><?php pll_e('Медицинская информация') ?></h2>
                    <div class="relativeR">
                        <div><?php pll_e('Группа крови') ?></div>
                        <div>
                            <input type="radio" name="q6" id="q61" <?php echo $row['q6'] === "1" ? "checked" : ""; ?>
                                required value="1">
                            <label for="q61">1</label>
                            <input type="radio" name="q6" id="q62" <?php echo $row['q6'] === "2" ? "checked" : ""; ?>
                                required value="2">
                            <label for="q62">2</label>
                            <input type="radio" name="q6" id="q63" <?php echo $row['q6'] === "3" ? "checked" : ""; ?>
                                required value="3">
                            <label for="q63">3</label>
                            <input type="radio" name="q6" id="q64" <?php echo $row['q6'] === "4" ? "checked" : ""; ?>
                                required value="4">
                            <label for="q64">4</label>
                            <input type="radio" name="q6"
                                id="q65" <?php echo stripos($row['q6'], "е знаю") ? "checked" : ""; ?> required
                                value="Не знаю">
                            <label for="q65"><?php pll_e('Не знаю') ?></label>
                        </div>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Резус фактор') ?></div>
                        <div>
                            <input type="radio" name="q7"
                                id="q71" <?php echo stripos($row['q7'], "оложительный") ? "checked" : ""; ?> required
                                value="Положительный" onclick="hideElement('q77Block'); hideElement('q78Block');">
                            <label for="q71"><?php pll_e('Положительный') ?></label>
                            <input type="radio" name="q7"
                                id="q72" <?php echo stripos($row['q7'], "трицательный") ? "checked" : ""; ?> required
                                value="Отрицательный" onclick="showElement('q77Block'); showElement('q78Block');">
                            <label for="q72"><?php pll_e('Отрицательный') ?></label>
                            <input type="radio" name="q7"
                                id="q73" <?php echo stripos($row['q7'], "е знаю") ? "checked" : ""; ?> required
                                value="Не знаю" onclick="hideElement('q77Block'); hideElement('q78Block');">
                            <label for="q73"><?php pll_e('Не знаю') ?></label>
                        </div>
                    </div>

                    <div class="relativeR <?php echo stripos($row['q7'], "трицательный") ? "" : "hided"; ?> anim"
                        id="q77Block">
                        <div><?php pll_e('Были ли инъекции иммуноглобулина при беременности?') ?></div>
                        <div>
                            <input type="radio" name="q77"
                                id="q771" <?php echo $row['q77'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q771"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q77"
                                id="q772" <?php echo $row['q77'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q772"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relativeR <?php echo stripos($row['q7'], "трицательный") ? "" : "hided"; ?> anim"
                        id="q78Block">
                        <div><?php pll_e('Был ли конфликт резус-фактора при рождении детей (были ли повышены антитела к резус-фактору
                            во время беременности)?') ?>
                        </div>
                        <div>
                            <input type="radio" name="q78"
                                id="q781" <?php echo $row['q78'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q781"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q78"
                                id="q782" <?php echo $row['q78'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q782"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>

                    <div class="relativeR">
                        <div><?php pll_e('Тип телосложения') ?></div>
                        <div>
                            <input type="radio" name="q8"
                                id="q81" <?php echo stripos($row['q8'], "ктоморф") ? "checked" : ""; ?> required
                                value="Эктоморф (худой тип)">
                            <label for="q81"><?php pll_e('Эктоморф (худой тип)') ?></label>
                            <input type="radio" name="q8"
                                id="q82" <?php echo stripos($row['q8'], "езоморф") ? "checked" : ""; ?> required
                                value="Мезоморф (атлетичный тип)">
                            <label for="q82"><?php pll_e('Мезоморф (атлетичный тип)') ?></label>
                            <input type="radio" name="q8"
                                id="q83" <?php echo stripos($row['q8'], "ндоморф") ? "checked" : ""; ?> required
                                value="Эндоморф (крупный тип)">
                            <label for="q83"><?php pll_e('Эндоморф (крупный тип)') ?></label>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="number" name="q9" required value="<?php echo $row['q9'] ? $row['q9'] : ''; ?>">
                        <label><?php pll_e('Рост (в сантиметрах)') ?></label>
                    </div>
                    <div class="relative">
                        <input type="number" name="q10" required value="<?php echo $row['q10'] ? $row['q10'] : ''; ?>">
                        <label><?php pll_e('Вес') ?></label>
                    </div>
                    <div class="relative">
                        <input type="text" name="q11" required value="<?php echo $row['q11'] ? $row['q11'] : ''; ?>">
                        <label><?php pll_e('Наличие хронических заболеваний и их указание') ?></label>
                    </div>
                    <div class="relative">
                        <input type="text" name="q12" required value="<?php echo $row['q12'] ? $row['q12'] : ''; ?>">
                        <label><?php pll_e('Наличие операций и их указание') ?></label>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Наличие заболеваний, передающихся половым путем') ?></div>
                        <div>
                            <input type="radio" name="q13"
                                id="q131" <?php echo $row['q13'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="showElement('q12comment')">
                            <label for="q131"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q13"
                                id="q132" <?php echo $row['q13'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('q12comment')">
                            <label for="q132"><?php pll_e('Нет') ?></label>
                            <textarea name="q12comment" id="q12comment"
                                class="<?php echo $row['q12'] === "Да" ? "" : "hided"; ?> anim comment"
                                placeholder="Комментарий"><?php echo $row['q12comment']; ?></textarea>
                        </div>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Курите ли Вы? (сигареты/кальян)') ?></div>
                        <div>
                            <input type="radio" name="q14"
                                id="q141" <?php echo $row['q14'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="hideElement('q14Block')">
                            <label for="q141"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q14"
                                id="q142" <?php echo $row['q14'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('q14Block')">
                            <label for="q142"><?php pll_e('Нет') ?></label>
                            <input type="radio" name="q14"
                                id="q143" <?php echo $row['q14'] === "Иное" ? "checked" : ""; ?> required
                                value="Иное" onclick="showElement('q14Block')">
                            <label for="q143"><?php pll_e('Иное') ?></label>
                        </div>
                    </div>
                    <div class="relative <?php echo $row['q14'] === "Иное" ? "" : "hided"; ?> anim" id="q14Block">
                        <input type="text" name="q15" required value="<?php echo $row['q15'] ? $row['q15'] : ''; ?>">
                        <label><?php pll_e('Частота употребления и вид потребляемого (сигареты или кальян)') ?></label>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Употребляете ли Вы наркотики?') ?></div>
                        <div>
                            <input type="radio" name="q16"
                                id="q161" <?php echo $row['q16'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q161"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q16"
                                id="q162" <?php echo $row['q16'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q162"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="text" name="q17" required value="<?php echo $row['q17'] ? $row['q17'] : ''; ?>">
                        <label><?php pll_e('Общее количество беременностей') ?></label>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Общее количество родов') ?></div>
                        <div>
                            <input type="radio" name="q18" id="q181" <?php echo $row['q18'] === "1" ? "checked" : ""; ?>
                                required value="1"
                                onclick="showElement('childbirth1'); hideElement('childbirth2'); hideElement('childbirth3'); ">
                            <label for="q181">1</label>
                            <input type="radio" name="q18" id="q182" <?php echo $row['q18'] === "2" ? "checked" : ""; ?>
                                required value="2"
                                onclick="showElement('childbirth1'); showElement('childbirth2'); hideElement('childbirth3'); ">
                            <label for="q182">2</label>
                            <input type="radio" name="q18"
                                id="q183" <?php echo $row['q14'] === "3 и более" ? "checked" : ""; ?> required
                                value="3 и более"
                                onclick="showElement('childbirth1'); showElement('childbirth2'); showElement('childbirth3'); ">
                            <label for="q183"><?php pll_e('3 и более') ?></label>
                        </div>
                    </div>

                    <!-- cycle start here -->

                    <div id="childbirth1" style="display: none;">
                        <h2 class="center"><?php pll_e('Роды № 1') ?></h2>
                        <div class="relative">
                            <input type="number" name="q19" required
                                value="<?php echo $row['q19'] ? $row['q19'] : ''; ?>">
                            <label><?php pll_e('На какой неделе были роды?') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q20" required
                                value="<?php echo $row['q20'] ? $row['q20'] : ''; ?>">
                            <label><?php pll_e('Рост новорожденного') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q21" required
                                value="<?php echo $row['q21'] ? $row['q21'] : ''; ?>">
                            <label><?php pll_e('Вес новорожденного') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q22" required
                                value="<?php echo $row['q22'] ? $row['q22'] : ''; ?>">
                            <label><?php pll_e('Имеются ли у ребенка какие либо заболевания') ?></label>
                        </div>
                        <div class="relativeR">
                            <div><?php pll_e('Как протекала Ваша беременность?') ?></div>
                            <div class="form-group">
                                <input type="checkbox" name="q231"
                                    id="q231" <?php echo stripos($row['q23'], "тлично без осложнений") ? "checked" : ""; ?>
                                    required value="Отлично без осложнений">
                                <label for="q231"><?php pll_e('Отлично без осложнений') ?></label>
                                <input type="checkbox" name="q232"
                                    id="q232" <?php echo stripos($row['q23'], "оксикоз") ? "checked" : ""; ?>
                                    required value="Токсикоз">
                                <label for="q232"><?php pll_e('Токсикоз') ?></label>
                                <input type="checkbox" name="q233"
                                    id="q233" <?php echo stripos($row['q23'], "естоз") ? "checked" : ""; ?> required
                                    value="Гестоз (поздний токсикоз)">
                                <label for="q233"><?php pll_e('Гестоз (поздний токсикоз)') ?></label>
                                <input type="checkbox" name="q234"
                                    id="q234" <?php echo stripos($row['q23'], "ежала на сохранении") ? "checked" : ""; ?>
                                    required value="Лежала на сохранении (была госпитализация)"
                                    onclick="toggleElement('q17Block')">
                                <label for="q234"><?php pll_e('Лежала на сохранении (была госпитализация)') ?></label>
                                <input type="checkbox" name="q235"
                                    id="q235" <?php echo stripos($row['q23'], "одила на капельницы") ? "checked" : ""; ?>
                                    required value="Ходила на капельницы" onclick="toggleElement('q18Block')">
                                <label for="q235"><?php pll_e('Ходила на капельницы') ?></label>
                            </div>
                        </div>
                        <div class="relative <?php echo stripos($row['q23'], "ежала на сохранении") ? "" : "hided"; ?> anim"
                            id="q17Block">
                            <input type="text" name="q24" required
                                value="<?php echo $row['q24'] ? $row['q24'] : ''; ?>">
                            <label><?php pll_e('По какой причине была госпитализация?') ?></label>
                        </div>
                        <div class="relative <?php echo stripos($row['q23'], "одила на капельницы") ? "" : "hided"; ?> anim"
                            id="q18Block">
                            <input type="text" name="q25" required
                                value="<?php echo $row['q25'] ? $row['q25'] : ''; ?>">
                            <label><?php pll_e('По какой причине назначались капельницы?') ?></label>
                        </div>
                        <div class="relativeR">
                            <div><?php pll_e('Как протекали Ваши роды?') ?></div>
                            <div class="form-group">
                                <input type="checkbox" name="q261"
                                    id="q261" <?php echo stripos($row['q26'], "егкие") ? "checked" : ""; ?> required
                                    value="Легкие">
                                <label for="q261"><?php pll_e('Легкие') ?></label>
                                <input type="checkbox" name="q262"
                                    id="q262" <?php echo stripos($row['q26'], "ыстрые") ? "checked" : ""; ?> required
                                    value="Быстрые">
                                <label for="q262"><?php pll_e('Быстрые') ?></label>
                                <input type="checkbox" name="q263"
                                    id="q263" <?php echo stripos($row['q26'], "яжелые") ? "checked" : ""; ?> required
                                    value="Тяжелые">
                                <label for="q263"><?php pll_e('Тяжелые') ?></label>
                                <input type="checkbox" name="q264"
                                    id="q264" <?php echo stripos($row['q26'], "олгие") ? "checked" : ""; ?> required
                                    value="Долгие">
                                <label for="q264"><?php pll_e('Долгие') ?></label>
                                <input type="checkbox" name="q265"
                                    id="q265" <?php echo stripos($row['q26'], "оды с осложнением") ? "checked" : ""; ?>
                                    required value="Роды с осложнением" onclick="toggleElement('q20Block')">
                                <label for="q265"><?php pll_e('Роды с осложнением') ?></label>
                            </div>
                        </div>
                        <div class="relative <?php echo stripos($row['q26'], "оды с осложнением") ? "" : "hided"; ?> anim"
                            id="q20Block">
                            <input type="text" name="q27" required
                                value="<?php echo $row['q27'] ? $row['q27'] : ''; ?>">
                            <label><?php pll_e('Какие осложнения возникли во время родов?') ?></label>
                        </div>
                        <div class="relativeR">
                            <div><?php pll_e('Было ли кесарево сечение?') ?></div>
                            <div>
                                <input type="radio" name="q28"
                                    id="q281" <?php echo $row['q28'] === "Да" ? "checked" : ""; ?> required
                                    value="Да">
                                <label for="q281"><?php pll_e('Да') ?></label>
                                <input type="radio" name="q28"
                                    id="q282" <?php echo $row['q28'] === "Нет" ? "checked" : ""; ?> required
                                    value="Нет">
                                <label for="q282"><?php pll_e('Нет') ?></label>
                            </div>
                        </div>
                    </div>

                    <div id="childbirth2" style="display: none;">
                        <h2 class="center"> <?php pll_e('Роды № 2') ?></h2>
                        <div class="relative">
                            <input type="number" name="q29" required
                                value="<?php echo $row['q29'] ? $row['q29'] : ''; ?>">
                            <label> <?php pll_e('На какой неделе были роды?') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q30" required
                                value="<?php echo $row['q30'] ? $row['q30'] : ''; ?>">
                            <label> <?php pll_e('Рост новорожденного') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q31" required
                                value="<?php echo $row['q31'] ? $row['q31'] : ''; ?>">
                            <label> <?php pll_e('Вес новорожденного') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q32" required
                                value="<?php echo $row['q32'] ? $row['q32'] : ''; ?>">
                            <label> <?php pll_e('Имеются ли у ребенка какие либо заболевания') ?></label>
                        </div>
                        <div class="relativeR">
                            <div> <?php pll_e('Как протекала Ваша беременность?') ?></div>
                            <div class="form-group">
                                <input type="checkbox" name="q331"
                                    id="q331" <?php echo stripos($row['q33'], "тлично без осложнений") ? "checked" : ""; ?>
                                    required value="Отлично без осложнений">
                                <label for="q331"> <?php pll_e('Отлично без осложнений') ?></label>
                                <input type="checkbox" name="q332"
                                    id="q332" <?php echo stripos($row['q33'], "оксикоз") ? "checked" : ""; ?>
                                    required value="Токсикоз">
                                <label for="q332"> <?php pll_e('Токсикоз') ?></label>
                                <input type="checkbox" name="q333"
                                    id="q333" <?php echo stripos($row['q33'], "естоз") ? "checked" : ""; ?> required
                                    value="Гестоз (поздний токсикоз)">
                                <label for="q333"> <?php pll_e('Гестоз (поздний токсикоз)') ?></label>
                                <input type="checkbox" name="q334"
                                    id="q334" <?php echo stripos($row['q33'], "ежала на сохранении") ? "checked" : ""; ?>
                                    required value="Лежала на сохранении (была госпитализация)"
                                    onclick="toggleElement('q17Block2')">
                                <label for="q334"> <?php pll_e('Лежала на сохранении (была госпитализация)') ?></label>
                                <input type="checkbox" name="q335"
                                    id="q335" <?php echo stripos($row['q33'], "одила на капельницы") ? "checked" : ""; ?>
                                    required value="Ходила на капельницы" onclick="toggleElement('q18Block2')">
                                <label for="q335"> <?php pll_e('Ходила на капельницы') ?></label>
                            </div>
                        </div>
                        <div class="relative <?php echo stripos($row['q33'], "ежала на сохранении") ? "" : "hided"; ?> anim"
                            id="q17Block2">
                            <input type="text" name="q34" required
                                value="<?php echo $row['q34'] ? $row['q34'] : ''; ?>">
                            <label> <?php pll_e('По какой причине была госпитализация?') ?></label>
                        </div>
                        <div class="relative <?php echo stripos($row['q33'], "одила на капельницы") ? "" : "hided"; ?> anim"
                            id="q18Block2">
                            <input type="text" name="q35" required
                                value="<?php echo $row['q35'] ? $row['q35'] : ''; ?>">
                            <label> <?php pll_e('По какой причине назначались капельницы?') ?></label>
                        </div>
                        <div class="relativeR">
                            <div> <?php pll_e('Как протекали Ваши роды?') ?></div>
                            <div class="form-group">
                                <input type="checkbox" name="q361"
                                    id="q361" <?php echo stripos($row['q36'], "егкие") ? "checked" : ""; ?> required
                                    value="Легкие">
                                <label for="q361"> <?php pll_e('Легкие') ?></label>
                                <input type="checkbox" name="q362"
                                    id="q362" <?php echo stripos($row['q36'], "ыстрые") ? "checked" : ""; ?> required
                                    value="Быстрые">
                                <label for="q362"> <?php pll_e('Быстрые') ?></label>
                                <input type="checkbox" name="q363"
                                    id="q363" <?php echo stripos($row['q36'], "яжелые") ? "checked" : ""; ?> required
                                    value="Тяжелые">
                                <label for="q363"> <?php pll_e('Тяжелые') ?></label>
                                <input type="checkbox" name="q364"
                                    id="q364" <?php echo stripos($row['q36'], "олгие") ? "checked" : ""; ?> required
                                    value="Долгие">
                                <label for="q364"> <?php pll_e('Долгие') ?></label>
                                <input type="checkbox" name="q365"
                                    id="q365" <?php echo stripos($row['q36'], "оды с осложнением") ? "checked" : ""; ?>
                                    required value="Роды с осложнением" onclick="toggleElement('q20Block2')">
                                <label for="q365"> <?php pll_e('Роды с осложнением') ?></label>
                            </div>
                        </div>
                        <div class="relative <?php echo stripos($row['q36'], "оды с осложнением") ? "" : "hided"; ?> anim"
                            id="q20Block2">
                            <input type="text" name="q37" required
                                value="<?php echo $row['q37'] ? $row['q37'] : ''; ?>">
                            <label> <?php pll_e('Какие осложнения возникли во время родов?') ?></label>
                        </div>
                        <div class="relativeR">
                            <div> <?php pll_e('Было ли кесарево сечение?') ?></div>
                            <div>
                                <input type="radio" name="q38"
                                    id="q381" <?php echo $row['q38'] === "Да" ? "checked" : ""; ?> required
                                    value="Да">
                                <label for="q381"> <?php pll_e('Да') ?></label>
                                <input type="radio" name="q38"
                                    id="q382" <?php echo $row['q38'] === "Нет" ? "checked" : ""; ?> required
                                    value="Нет">
                                <label for="q382"> <?php pll_e('Нет') ?></label>
                            </div>
                        </div>
                    </div>

                    <div id="childbirth3" style="display: none;">
                        <h2 class="center"><?php pll_e('Роды № 3') ?></h2>
                        <div class="relative">
                            <input type="number" name="q39" required
                                value="<?php echo $row['q39'] ? $row['q39'] : ''; ?>">
                            <label><?php pll_e('На какой неделе были роды?') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q40" required
                                value="<?php echo $row['q40'] ? $row['q40'] : ''; ?>">
                            <label><?php pll_e('Рост новорожденного') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q41" required
                                value="<?php echo $row['q41'] ? $row['q41'] : ''; ?>">
                            <label><?php pll_e('Вес новорожденного') ?></label>
                        </div>
                        <div class="relative">
                            <input type="text" name="q42" required
                                value="<?php echo $row['q42'] ? $row['q42'] : ''; ?>">
                            <label><?php pll_e('Имеются ли у ребенка какие либо заболевания') ?></label>
                        </div>
                        <div class="relativeR">
                            <div><?php pll_e('Как протекала Ваша беременность?') ?></div>
                            <div class="form-group">
                                <input type="checkbox" name="q431"
                                    id="q431" <?php echo stripos($row['q43'], "тлично без осложнений") ? "checked" : ""; ?>
                                    required value="Отлично без осложнений">
                                <label for="q431"><?php pll_e('Отлично без осложнений') ?></label>
                                <input type="checkbox" name="q432"
                                    id="q432" <?php echo stripos($row['q43'], "оксикоз") ? "checked" : ""; ?>
                                    required value="Токсикоз">
                                <label for="q432"><?php pll_e('Токсикоз') ?></label>
                                <input type="checkbox" name="q433"
                                    id="q433" <?php echo stripos($row['q43'], "естоз") ? "checked" : ""; ?> required
                                    value="Гестоз (поздний токсикоз)">
                                <label for="q433"><?php pll_e('Гестоз (поздний токсикоз)') ?></label>
                                <input type="checkbox" name="q434"
                                    id="q434" <?php echo stripos($row['q43'], "ежала на сохранении") ? "checked" : ""; ?>
                                    required value="Лежала на сохранении (была госпитализация)"
                                    onclick="toggleElement('q17Block3')">
                                <label for="q434"><?php pll_e('Лежала на сохранении (была госпитализация)') ?></label>
                                <input type="checkbox" name="q435"
                                    id="q435" <?php echo stripos($row['q43'], "одила на капельницы") ? "checked" : ""; ?>
                                    required value="Ходила на капельницы" onclick="toggleElement('q18Block3')">
                                <label for="q435"><?php pll_e('Ходила на капельницы') ?></label>
                            </div>
                        </div>
                        <div class="relative <?php echo stripos($row['q43'], "ежала на сохранении") ? "" : "hided"; ?> anim"
                            id="q17Block3">
                            <input type="text" name="q44" required
                                value="<?php echo $row['q44'] ? $row['q44'] : ''; ?>">
                            <label><?php pll_e('По какой причине была госпитализация?') ?></label>
                        </div>
                        <div class="relative <?php echo stripos($row['q43'], "одила на капельницы") ? "" : "hided"; ?> anim"
                            id="q18Block3">
                            <input type="text" name="q45" required
                                value="<?php echo $row['q45'] ? $row['q45'] : ''; ?>">
                            <label><?php pll_e('По какой причине назначались капельницы?') ?></label>
                        </div>
                        <div class="relativeR">
                            <div><?php pll_e('Как протекали Ваши роды?') ?></div>
                            <div class="form-group">
                                <input type="checkbox" name="q461"
                                    id="q461" <?php echo stripos($row['q46'], "егкие") ? "checked" : ""; ?> required
                                    value="Легкие">
                                <label for="q461"><?php pll_e('Легкие') ?></label>
                                <input type="checkbox" name="q462"
                                    id="q462" <?php echo stripos($row['q46'], "ыстрые") ? "checked" : ""; ?> required
                                    value="Быстрые">
                                <label for="q462"><?php pll_e('Быстрые') ?></label>
                                <input type="checkbox" name="q463"
                                    id="q463" <?php echo stripos($row['q46'], "яжелые") ? "checked" : ""; ?> required
                                    value="Тяжелые">
                                <label for="q463"><?php pll_e('Тяжелые') ?></label>
                                <input type="checkbox" name="q464"
                                    id="q464" <?php echo stripos($row['q46'], "олгие") ? "checked" : ""; ?> required
                                    value="Долгие">
                                <label for="q464"><?php pll_e('Долгие') ?></label>
                                <input type="checkbox" name="q465"
                                    id="q465" <?php echo stripos($row['q46'], "оды с осложнением") ? "checked" : ""; ?>
                                    required value="Роды с осложнением" onclick="toggleElement('q20Block3')">
                                <label for="q465"><?php pll_e('Роды с осложнением') ?></label>
                            </div>
                        </div>
                        <div class="relative <?php echo stripos($row['q46'], "оды с осложнением") ? "" : "hided"; ?> anim"
                            id="q20Block3">
                            <input type="text" name="q47" required
                                value="<?php echo $row['q47'] ? $row['q47'] : ''; ?>">
                            <label><?php pll_e('Какие осложнения возникли во время родов?') ?></label>
                        </div>
                        <div class="relativeR">
                            <div><?php pll_e('Было ли кесарево сечение?') ?></div>
                            <div>
                                <input type="radio" name="q48"
                                    id="q481" <?php echo $row['q48'] === "Да" ? "checked" : ""; ?> required
                                    value="Да">
                                <label for="q481"><?php pll_e('Да') ?></label>
                                <input type="radio" name="q48"
                                    id="q482" <?php echo $row['q48'] === "Нет" ? "checked" : ""; ?> required
                                    value="Нет">
                                <label for="q482"><?php pll_e('Нет') ?></label>
                            </div>
                        </div>
                    </div>


                    <!-- cycle stop here -->


                    <div class="relativeR">
                        <div> <?php pll_e('Были ли у Вас выкидыши (самопроизвольные аборты)?') ?></div>
                        <div>
                            <input type="radio" name="q49"
                                id="q491" <?php echo $row['q49'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="showElement('q23Block'); showElement('q24Block');">
                            <label for="q491"> <?php pll_e('Да') ?></label>
                            <input type="radio" name="q49"
                                id="q492" <?php echo $row['q49'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('q23Block'); hideElement('q24Block');">
                            <label for="q492"> <?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relativeR <?php echo $row['q49'] === "Да" ? "" : "hided"; ?> anim" id="q23Block">
                        <div> <?php pll_e('Сколько выкидышей у вас было?') ?></div>
                        <div>
                            <input type="radio" name="q50"
                                id="q501" <?php echo $row['q50'] === "1" ? "checked" : ""; ?> required value="1">
                            <label for="q501">1</label>
                            <input type="radio" name="q50"
                                id="q502" <?php echo $row['q50'] === "2" ? "checked" : ""; ?> required value="2">
                            <label for="q502">2</label>
                            <input type="radio" name="q50"
                                id="q503" <?php echo $row['q50'] === "3" ? "checked" : ""; ?> required value="3">
                            <label for="q503">3</label>
                            <input type="radio" name="q50"
                                id="q504" <?php echo $row['q50'] === "4 или более" ? "checked" : ""; ?> required
                                value="4 или более">
                            <label for="q504"> <?php pll_e('4 или более') ?></label>
                        </div>
                    </div>
                    <div class="relativeR <?php echo $row['q49'] === "Да" ? "" : "hided"; ?> anim" id="q24Block">
                        <div> <?php pll_e('Были ли роды после самопроизвольного аборта?') ?></div>
                        <div>
                            <input type="radio" name="q51"
                                id="q511" <?php echo $row['q51'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q511"> <?php pll_e('Да') ?></label>
                            <input type="radio" name="q51"
                                id="q512" <?php echo $row['q51'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q512"> <?php pll_e('Нет') ?></label>
                        </div>
                    </div>

                    <div class="relativeR">
                        <div><?php pll_e('Были ли у Вас искусственные аборты?') ?></div>
                        <div>
                            <input type="radio" name="q52"
                                id="q521" <?php echo $row['q52'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="showElement('q26Block'); showElement('q27Block');">
                            <label for="q521"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q52"
                                id="q522" <?php echo $row['q52'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('q26Block'); hideElement('q27Block');">
                            <label for="q522"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relativeR <?php echo $row['q52'] === "Да" ? "" : "hided"; ?> anim" id="q26Block">
                        <div><?php pll_e('Сколько искусственных абортов у вас было?') ?></div>
                        <div>
                            <input type="radio" name="q53"
                                id="q531" <?php echo $row['q53'] === "1" ? "checked" : ""; ?> required value="1">
                            <label for="q531">1</label>
                            <input type="radio" name="q53"
                                id="q532" <?php echo $row['q53'] === "2" ? "checked" : ""; ?> required value="2">
                            <label for="q532">2</label>
                            <input type="radio" name="q53"
                                id="q533" <?php echo $row['q53'] === "3" ? "checked" : ""; ?> required value="3">
                            <label for="q533">3</label>
                            <input type="radio" name="q53"
                                id="q534" <?php echo $row['q53'] === "4 или более" ? "checked" : ""; ?> required
                                value="4 или более">
                            <label for="q534"><?php pll_e('4 или более') ?></label>
                        </div>
                    </div>
                    <div class="relativeR <?php echo $row['q52'] === "Да" ? "" : "hided"; ?> anim" id="q27Block">
                        <div><?php pll_e('Были ли роды после аборта?') ?></div>
                        <div>
                            <input type="radio" name="q54"
                                id="q541" <?php echo $row['q54'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q541"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q54"
                                id="q542" <?php echo $row['q54'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q542"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>

                    <div class="relativeR">
                        <div><?php pll_e('Есть ли у вас антитела к вирусу краснухи?') ?></div>
                        <div>
                            <input type="radio" name="q55"
                                id="q551" <?php echo $row['q55'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q551"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q55"
                                id="q552" <?php echo $row['q55'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q552"><?php pll_e('Нет') ?></label>
                            <input type="radio" name="q55"
                                id="q553" <?php echo $row['q55'] === "Не знаю" ? "checked" : ""; ?> required
                                value="Не знаю">
                            <label for="q553"><?php pll_e('Не знаю') ?></label>
                        </div>
                    </div>

                    <div class="relative">
                        <input type="date" name="q56" required value="<?php echo $row['q56'] ? $row['q56'] : ''; ?>">
                        <label class="moved"><?php pll_e('Дата начала последних месячных') ?></label>
                    </div>
                    <div class="buttons">
                        <button type="button" class="nextStep" onclick="prevStep(1)"><?php pll_e('Назад') ?></button>
                        <button type="button" class="nextStep" onclick="validate(6, 55, 3, [77, 78, 56])"><?php pll_e('Далее') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container step3">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="center"><?php pll_e('Семья и дети') ?></h2>
                    <div class="relativeR">
                        <div><?php pll_e('Семейное положение') ?></div>
                        <div>
                            <input type="radio" name="q57"
                                id="q571" <?php echo $row['q57'] === "Замужем" ? "checked" : ""; ?> required
                                value="Замужем" onclick="hideElement('q81Block'),showElement('q86Block')">
                            <label for="q571"><?php pll_e('Замужем') ?></label>
                            <input type="radio" name="q57"
                                id="q572" <?php echo $row['q57'] === "Разведена" ? "checked" : ""; ?> required
                                value="Разведена" onclick="showElement('q81Block'),hideElement('q86Block')">
                            <label for="q572"><?php pll_e('Разведена') ?></label>
                            <input type="radio" name="q57"
                                id="q573" <?php echo $row['q57'] === "Не замужем" ? "checked" : ""; ?> required
                                value="Не замужем" onclick="hideElement('q81Block'),hideElement('q86Block')">
                            <label for="q573"><?php pll_e('Не замужем') ?></label>
                            <input type="radio" name="q57"
                                id="q574" <?php echo $row['q57'] === "Гражданский брак" ? "checked" : ""; ?> required
                                value="Гражданский брак" onclick="hideElement('q81Block'),hideElement('q86Block')">
                            <label for="q574"><?php pll_e('Гражданский брак') ?></label>
                            <input type="radio" name="q57"
                                id="q575" <?php echo $row['q57'] === "Вдова" ? "checked" : ""; ?> required
                                value="Вдова" onclick="hideElement('q81Block'),hideElement('q86Block')">
                            <label for="q575"><?php pll_e('Вдова') ?></label>
                        </div>
                    </div>
                    <div class="relativeR <?php echo $row['q57'] === "Замужем" ? "" : "hided"; ?> anim" id="q86Block">
                        <div><?php pll_e('Есть ли возможность получить нотариальное согласие от мужа?') ?></div>
                        <div>
                            <input type="radio" name="q86"
                                id="q861" <?php echo $row['q86'] === "Да" ? "checked" : ""; ?> required
                                value="Да" onclick="hideElement('q81Block')">
                            <label for="q861"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q86"
                                id="862" <?php echo $row['q86'] === "Нет" ? "checked" : ""; ?> required
                                value="Нет" onclick="hideElement('q81Block')">
                            <label for="862"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>

                    <div class="relativeR <?php echo $row['q57'] === "Разведена" ? "" : "hided"; ?> anim" id="q81Block">
                        <div><?php pll_e('У вас имеется свидетельство о расторжении брака?') ?></div>
                        <div>
                            <input type="radio" name="q81"
                                id="q811" <?php echo $row['q81'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q811"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q81"
                                id="q812" <?php echo $row['q81'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q812"><?php pll_e('Нет') ?></label>
                            <input type="radio" name="q81"
                                id="q813" <?php echo $row['q81'] === "Нет, но готова получить копию с ЗАГСе" ? "checked" : ""; ?>
                                required value="Нет, но готова получить копию с ЗАГСе">
                            <label for="q813"><?php pll_e('Нет, но готова получить копию с ЗАГСе') ?></label>
                        </div>
                    </div>

                    <div class="relativeR">
                        <label><?php pll_e('Ведете ли Вы половую жизнь?') ?></label>
                        <div>
                            <input type="radio" name="q58"
                                id="q581" <?php echo $row['q58'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="showElement('q59Block')">
                            <label for="q581"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q58"
                                id="q582" <?php echo $row['q58'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('q59Block')">
                            <label for="q582"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relative <?php echo $row['q58'] === "Да" ? "" : "hided"; ?> anim" id="q59Block">
                        <input type="text" name="q59" required value="<?php echo $row['q59'] ? $row['q59'] : ''; ?>">
                        <label><?php pll_e('Какой способ контрацепции вы используете?') ?></label>
                    </div>
                    <div class="relativeR">
                        <label><?php pll_e('Принимаете ли Вы какие-либо препараты/лекарства на постоянной основе (помимо витаминных комплексов)?') ?></label>
                        <div>
                            <input type="radio" name="q60"
                                id="q601" <?php echo $row['q60'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="showElement('q61Block')" ;>
                            <label for="q601"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q60"
                                id="q602" <?php echo $row['q60'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('q61Block')">
                            <label for="q602"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relative <?php echo $row['q60'] === "Да" ? "" : "hided"; ?> anim" id="q61Block">
                        <input type="text" name="q61" required value="<?php echo $row['q61'] ? $row['q61'] : ''; ?>">
                        <label><?php pll_e('Укажите препараты/лекарства, которые вы принимаете постоянно') ?></label>
                    </div>

                    <div class="relative">
                        <input type="text" name="q62" required value="<?php echo $row['q62'] ? $row['q62'] : ''; ?>">
                        <label><?php pll_e('Количество детей') ?></label>
                    </div>
                    <div class="relative">
                        <input type="date" name="q63" required value="<?php echo $row['q63'] ? $row['q63'] : ''; ?>">
                        <label class="moved"><?php pll_e('Дата рождения младшего ребенка') ?></label>
                    </div>
                    <div class="buttons">
                        <button type="button" class="nextStep" onclick="prevStep(2)"><?php pll_e('Назад') ?></button>
                        <button type="button" class="nextStep" onclick="validate(57, 63, 4, [81,86])"><?php pll_e('Далее') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container step4">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="center"><?php pll_e('Образование и карьера') ?></h2>
                    <div class="relativeR">
                        <div><?php pll_e('Образование') ?></div>
                        <div>
                            <input type="radio" name="q64"
                                id="q641" <?php echo $row['q64'] === "Высшее" ? "checked" : ""; ?> required
                                value="Высшее">
                            <label for="q641"><?php pll_e('Высшее') ?></label>
                            <input type="radio" name="q64"
                                id="q642" <?php echo $row['q64'] === "Неоконченное высшее" ? "checked" : ""; ?>
                                required value="Неоконченное высшее">
                            <label for="q642"><?php pll_e('Неоконченное высшее') ?></label>
                            <input type="radio" name="q64"
                                id="q643" <?php echo $row['q64'] === "Среднее специальное" ? "checked" : ""; ?>
                                required value="Среднее специальное">
                            <label for="q643"><?php pll_e('Среднее специальное') ?></label>
                            <input type="radio" name="q64"
                                id="q644" <?php echo $row['q64'] === "Среднее" ? "checked" : ""; ?> required
                                value="Среднее">
                            <label for="q644"><?php pll_e('Среднее') ?></label>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="text" name="q65" required value="<?php echo $row['q65'] ? $row['q65'] : ''; ?>">
                        <label><?php pll_e('Специальность') ?></label>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Работаете ли Вы в данный момент?') ?></div>
                        <div>
                            <input type="radio" name="q66"
                                id="q661" <?php echo $row['q66'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="showElement('q36Block')">
                            <label for="q661"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q66"
                                id="q662" <?php echo $row['q66'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('q36Block')">
                            <label for="q662"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Вы готовы оперативно уволиться с работы для участия в программе?') ?></div>
                        <div>
                            <input type="radio" name="q79"
                                id="q791" <?php echo $row['q79'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q791"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q79"
                                id="q792" <?php echo $row['q79'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q792"><?php pll_e('Нет') ?></label>
                            <input type="radio" name="q79"
                                id="q793" <?php echo $row['q79'] === "Не знаю" ? "checked" : ""; ?> required
                                value="Не знаю">
                            <label for="q793"><?php pll_e('Не знаю') ?></label>
                        </div>
                    </div>
                    <div class="relative <?php echo $row['q66'] === "Да" ? "" : "hided"; ?> anim" id="q36Block">
                        <input type="text" name="q67" required value="<?php echo $row['q67'] ? $row['q67'] : ''; ?>">
                        <label><?php pll_e('Место работы') ?></label>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Программа предполагает переезд (возможен частичный) в Душанбе на время беременности. Вы готовы на переезд (переезд возможен с ребенком за счет агентства)?') ?>
                        </div>
                        <div>
                            <input type="radio" name="q80"
                                id="q801" <?php echo $row['q80'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="showElement('moving'),showElement('moving1'),showElement('moving2')">
                            <label for="q801"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q80"
                                id="q802" <?php echo $row['q80'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('moving'),hideElement('moving1'),hideElement('moving2')">
                            <label for="q802"><?php pll_e('Нет') ?></label>
                            <input type="radio" name="q80"
                                id="q803" <?php echo $row['q80'] === "Не знаю" ? "checked" : ""; ?> required
                                value="Не знаю" onclick="hideElement('moving'),hideElement('moving1'),hideElement('moving2')">
                            <label for="q803"><?php pll_e('Не знаю') ?></label>
                        </div>
                    </div>
                    <div>
                        <div class="relativeR <?php echo $row['q80'] === "Да" ? "" : "hided"; ?> anim" id="moving">
                            <div><?php pll_e('Есть ли у вас кредитные задолженности?') ?></div>
                            <div>
                                <input type="radio" name="q83"
                                    id="q831" <?php echo $row['q83'] === "Да" ? "checked" : ""; ?> required value="Да">
                                <label for="q831"><?php pll_e('Да') ?></label>
                                <input type="radio" name="q83"
                                    id="q832" <?php echo $row['q83'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                                <label for="q832"><?php pll_e('Нет') ?></label>
                            </div>
                        </div>
                        <div class="relativeR <?php echo $row['q80'] === "Да" ? "" : "hided"; ?> anim" id="moving1">
                            <div><?php pll_e('Есть ли у вас судимости?') ?></div>
                            <div>
                                <input type="radio" name="q84"
                                    id="q841" <?php echo $row['q84'] === "Да" ? "checked" : ""; ?> required value="Да">
                                <label for="q841"><?php pll_e('Да') ?></label>
                                <input type="radio" name="q84"
                                    id="q842" <?php echo $row['q84'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                                <label for="q842"><?php pll_e('Нет') ?></label>
                            </div>
                        </div>
                        <div class="relativeR <?php echo $row['q80'] === "Да" ? "" : "hided"; ?> anim" id="moving2">
                            <div><?php pll_e('Есть ли у вас ограничения на переезд?') ?></div>
                            <div>
                                <input type="radio" name="q85"
                                    id="q851" <?php echo $row['q85'] === "Да" ? "checked" : ""; ?> required value="Да">
                                <label for="q851"><?php pll_e('Да') ?></label>
                                <input type="radio" name="q85"
                                    id="q852" <?php echo $row['q85'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                                <label for="q852"><?php pll_e('Нет') ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="button" class="nextStep" onclick="prevStep(3)"><?php pll_e('Назад') ?></button>
                        <button type="button" class="nextStep" onclick="validate(64, 67, 5,  [79, 80, 83, 84, 85])"><?php pll_e('Далее') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container step5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="center"><?php pll_e('Дополнительные вопросы') ?></h2>
                    <div class="relative">
                        <input type="text" name="q68" required value="<?php echo $row['q68'] ? $row['q68'] : ''; ?>">
                        <label><?php pll_e('Почему Вы решили стать суррогатной мамой?') ?></label>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Есть ли у Вас опыт участия в прогамме суррогатного материнства?') ?></div>
                        <div>
                            <input type="radio" name="q69"
                                id="q691" <?php echo $row['q69'] === "Да" ? "checked" : ""; ?> required value="Да"
                                onclick="showElement('q39Block'); showElement('q39Block2'); showElement('q40Block');">
                            <label for="q691"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q69"
                                id="q692" <?php echo $row['q69'] === "Нет" ? "checked" : ""; ?> required value="Нет"
                                onclick="hideElement('q39Block'); hideElement('q39Block2'); hideElement('q40Block');">
                            <label for="q692"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relative <?php echo $row['q69'] === "Да" ? "" : "hided"; ?> anim" id="q39Block">
                        <input type="text" name="q70" required value="<?php echo $row['q70'] ? $row['q70'] : ''; ?>">
                        <label><?php pll_e('В каком году?') ?></label>
                    </div>
                    <div class="relative <?php echo $row['q69'] === "Да" ? "" : "hided"; ?> anim" id="q39Block2"
                        style="padding-top: 65px;">
                        <input type="text" name="q71" required value="<?php echo $row['q71'] ? $row['q71'] : ''; ?>">
                        <label><?php pll_e('Были ли роды в ранее принимаемой программе суррогатного материнства? При отрицательном ответе, описать причину отсутствия родоразрешения') ?></label>
                    </div>
                    <div class="relativeR <?php echo $row['q69'] === "Да" ? "" : "hided"; ?> anim" id="q40Block">
                        <div><?php pll_e('Есть ли документы подтверждающие участие?') ?></div>
                        <div>
                            <input type="radio" name="q72"
                                id="q721" <?php echo $row['q72'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q721"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q72"
                                id="q722" <?php echo $row['q72'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q722"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="relativeR">
                        <div><?php pll_e('Согласны ли вы на многоплодную беременность? (перенос 2 эмбрионов родителей)') ?></div>
                        <div>
                            <input type="radio" name="q82"
                                id="q821" <?php echo $row['q82'] === "Да" ? "checked" : ""; ?> required value="Да">
                            <label for="q821"><?php pll_e('Да') ?></label>
                            <input type="radio" name="q82"
                                id="q822" <?php echo $row['q82'] === "Нет" ? "checked" : ""; ?> required value="Нет">
                            <label for="q822"><?php pll_e('Нет') ?></label>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="button" class="nextStep" onclick="prevStep(4)"><?php pll_e('Назад') ?></button>
                        <button type="button" class="nextStep" onclick="validate(68, 72, 6, [82])"><?php pll_e('Далее') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container step6">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="center"><?php pll_e('Контактная информация') ?></h2>
                    <div class="relative">
                        <input type="text" name="q73" required value="<?php echo $row['q73'] ? $row['q73'] : ''; ?>">
                        <label><?php pll_e('Ваш номер телефона') ?></label>
                    </div>
                    <div class="relative">
                        <input type="text" name="q74" required value="<?php echo $row['q74'] ? $row['q74'] : ''; ?>">
                        <label><?php pll_e('Ваша электронная почта') ?></label>
                    </div>
                    <div class="relative">
                        <input type="text" name="q75" required value="<?php echo $row['q75'] ? $row['q75'] : ''; ?>">
                        <label><?php pll_e('Откуда узнали о нашем центре') ?></label>
                    </div>
                    <div class="buttons buttons6">
                        <button type="button" class="nextStep" onclick="prevStep(5)"><?php pll_e('Назад') ?></button>
                        <button type="button" class="nextStep" onclick="validate(73, 75, 7)"
                            style="margin-bottom: 0; width: auto;">
                            <?php pll_e('Отправить') ?>
                        </button>
                    </div>

                    <p style="max-width: 500px; margin: 20px auto 0;"
                        class="p_data"><?php pll_e('Вы даете согласие на обработку своих персональных данных') ?> </p>
                </div>
            </div>
        </div>
    </form>
    <div class="container step7">
        <div class="row">
            <div class="col-md-12">
                <h2 class="center"><?php pll_e('Спасибо! Ваша анкета отправлена.') ?></h2>
            </div>
        </div>
    </div>
</section>

<?php if (!$started) { ?>
    <script>
        $(document).ready(function() {
            start();
        });
    </script>
<?php } ?>

<script>
    $('input').focus(function() {
        $(this).css('border-color', '');
        $(this).parent().find("label").css('color', '');
        $(this).parent().parent().find("div:first-child").css('color', '');
    })
    $('.relativeR label').click(function() {
        $(this).parent().find('label').css('color', '');
        $(this).parent().parent().find("div:first-child").css('color', '');
    })

    function showElement(id) {
        $("#" + id).show('fast');
    }

    function hideElement(id) {
        $("#" + id).hide('fast');
    }

    function toggleElement(id) {
        $("#" + id).toggle('fast');
    }

    function start() {

        $('input[type="radio"]').prop("checked", false);
        $('input[type="checkbox"]').prop("checked", false);
        $('input[type="text"]').val("");
        $('input[type="date"]').val("");

        $.ajax({
            type: "POST",
            url: "//embrymama.com/kg/wp-content/themes/embrymama/api/start.php",
            data: {
                donor_id: '<?php echo $_COOKIE['donor_id']; ?>',
                doctor: '<?php echo $d; ?>',
                agent: '<?php echo $agent; ?>',
                agent_name: '<?php echo $agent_fio; ?>',
                agent_email: '<?php echo $agent_email; ?>'
            },
            success: function(data) {
                if (data == 1) {} else if (data == 2) {
                    setTimeout(function() {

                    }, 1000);
                }
            },
            error: function() {
                console.error("Что-то пошло не так.")
            }
        });
    };

    function validate(min, max, next, added = null) {
        var ctr = 0;
        if (added != null) {
            added.forEach(function(elem, index, array) {
                ctr++;
                if ($('input[name="q' + elem + '"]').attr('type') === 'number' && $('input[name="q' + elem + '"]').val().length == 0 && $('input[name="q' + elem + '"]').parent().css('display') !== 'none') {
                    $('input[name="q' + elem + '"]').css('border-color', 'red');
                    $('input[name="q' + elem + '"]').parent().find("label").css('color', 'red');
                    return;
                } else if ($('input[name="q' + elem + '"]').attr('type') === 'radio' && $('input[name="q' + elem + '"]').parent().parent().css('display') !== 'none' && !$('input[name="q' + elem + '"]').is(':checked')) {
                    $('input[name="q' + elem + '"]').parent().find("label").css('color', 'red');
                    $('input[name="q' + elem + '"]').parent().parent().find("div:first-child").css('color', 'red');
                    return;
                } else if (elem == 56 && $('input[name="q56"]').val().length == 0) {
                    $('input[name="q56"]').parent().find("label").css('color', 'red');
                    return;
                } else {
                    if (ctr === array.length) {
                        validateG(min, max, next, added);
                    }
                }
            });
        } else {
            validateG(min, max, next, added);
        }
    }

    function validateG(min, max, next, added = null) {
        var step = min;
        while (step <= max) {
            if (step === 23) {
                if ($('input[name="q231"]').is(':checked') || $('input[name="q232"]').is(':checked') || $('input[name="q233"]').is(':checked') || $('input[name="q234"]').is(':checked') || $('input[name="q235"]').is(':checked')) {
                    step++;
                } else {
                    $('input[name="q231"]').parent().find("label").css('color', 'red');
                    $('input[name="q231"]').parent().parent().find("div:first-child").css('color', 'red');
                    break;
                }
            } else if (step === 26) {
                if ($('input[name="q261"]').is(':checked') || $('input[name="q262"]').is(':checked') || $('input[name="q263"]').is(':checked') || $('input[name="q264"]').is(':checked') || $('input[name="q265"]').is(':checked')) {
                    step++;
                } else {
                    $('input[name="q261"]').parent().find("label").css('color', 'red');
                    $('input[name="q261"]').parent().parent().find("div:first-child").css('color', 'red');
                    break;
                }
            }

            // 2nd childbirth

            if (step === 33) {
                if ($('input[name="q331"]').is(':checked') || $('input[name="q332"]').is(':checked') || $('input[name="q333"]').is(':checked') || $('input[name="q334"]').is(':checked') || $('input[name="q335"]').is(':checked')) {
                    step++;
                } else {
                    $('input[name="q331"]').parent().find("label").css('color', 'red');
                    $('input[name="q331"]').parent().parent().find("div:first-child").css('color', 'red');
                    break;
                }
            } else if (step === 36) {
                if ($('input[name="q361"]').is(':checked') || $('input[name="q362"]').is(':checked') || $('input[name="q363"]').is(':checked') || $('input[name="q364"]').is(':checked') || $('input[name="q365"]').is(':checked')) {
                    step++;
                } else {
                    $('input[name="q361"]').parent().find("label").css('color', 'red');
                    $('input[name="q361"]').parent().parent().find("div:first-child").css('color', 'red');
                    break;
                }
            }

            // 2nd childbirth end

            // 3th childbirth

            if (step === 43) {
                if ($('input[name="q431"]').is(':checked') || $('input[name="q432"]').is(':checked') || $('input[name="q433"]').is(':checked') || $('input[name="q434"]').is(':checked') || $('input[name="q435"]').is(':checked')) {
                    step++;
                } else {
                    $('input[name="q431"]').parent().find("label").css('color', 'red');
                    $('input[name="q431"]').parent().parent().find("div:first-child").css('color', 'red');
                    break;
                }
            } else if (step === 46) {
                if ($('input[name="q461"]').is(':checked') || $('input[name="q462"]').is(':checked') || $('input[name="q463"]').is(':checked') || $('input[name="q464"]').is(':checked') || $('input[name="q465"]').is(':checked')) {
                    step++;
                } else {
                    $('input[name="q461"]').parent().find("label").css('color', 'red');
                    $('input[name="q461"]').parent().parent().find("div:first-child").css('color', 'red');
                    break;
                }
            }

            // 3th childbirth end
            else if ($('input[name="q' + step + '"]').attr('type') === 'text' || $('input[name="q' + step + '"]').attr('type') === 'date' || $('input[name="q' + step + '"]').attr('type') === 'number') {
                if ($('input[name="q' + step + '"]').parent().css('display') !== 'none') {
                    if (step === max) {
                        if ($('input[name="q' + step + '"]').val().length > 0) {
                            nextStep(next);
                            break;
                        } else {
                            $('input[name="q' + step + '"]').css('border-color', 'red');
                            $('input[name="q' + step + '"]').parent().find("label").css('color', 'red');
                            break;
                        }
                    } else {
                        if ($('input[name="q' + step + '"]').val().length > 0) {
                            step++;
                        } else {
                            $('input[name="q' + step + '"]').css('border-color', 'red');
                            $('input[name="q' + step + '"]').parent().find("label").css('color', 'red');
                            break;
                        }
                    }
                } else {
                    if (step === max) {
                        nextStep(next);
                        break;
                    } else {
                        step++;
                    }
                }
            } else if ($('input[name="q' + step + '"]').attr('type') === 'radio') {
                if ($('input[name="q' + step + '"]').parent().parent().css('display') !== 'none') {
                    if (step === max) {
                        if ($('input[name="q' + step + '"]').is(':checked')) {
                            nextStep(next);
                            break;
                        } else {
                            $('input[name="q' + step + '"]').parent().find("label").css('color', 'red');
                            $('input[name="q' + step + '"]').parent().parent().find("div:first-child").css('color', 'red');
                            break;
                        }
                    } else {
                        if ($('input[name="q' + step + '"]').is(':checked')) {
                            if (step == 28 && $('#q181').is(':checked')) {
                                step = step + 21;
                            } else if (step == 38 && $('#q182').is(':checked')) {
                                step = step + 11;
                            } else {
                                step++;
                            }
                        } else {
                            $('input[name="q' + step + '"]').parent().find("label").css('color', 'red');
                            $('input[name="q' + step + '"]').parent().parent().find("div:first-child").css('color', 'red');
                            break;
                        }
                    }
                } else {
                    if (step === max) {
                        nextStep(next);
                        break;
                    } else {
                        step++;
                    }
                }
            }
        }
    }

    function nextStep(step) {
        submitFormAnket(step);
    }

    function prevStep(step) {
        $('.step' + (step + 1)).hide();
        $('.step' + step).show('fast');
    }

    function submitFormAnket(step) {
        var form_data = $("#form_surmama").serialize();
        console.log(form_data);
        $.ajax({
            type: "POST",
            url: "//embrymama.com/kg/wp-content/themes/embrymama/api/save.php",
            data: form_data,
            success: function(data) {
                if (data == 1) {
                    if (step === 7) {
                        $('.step6').hide();
                        $('.step7').show('fast');
                        VK.Retargeting.Init("VK-RTRG-1112823-h4Ie9");
                        VK.Retargeting.Event("embrymama_macro_SurmamaForm_lead");
                        VK.Goal('lead');
                    } else {
                        $('.step' + (step - 1)).hide();
                        $('.step' + step).show('fast');
                    }
                } else if (data == 2) {
                    alert("Что-то пошло не так проверьте ваше интернет соединение и правильность заполнения формы.")
                }
            },
            error: function() {
                alert("Что-то пошло не так проверьте ваше интернет соединение.")
            }
        });
    }
</script>

<?php get_footer(); ?>
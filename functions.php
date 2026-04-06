<?php
// Подключаем стили и скрипты для фронта
add_action('wp_enqueue_scripts', 'bb_scripts_styles');
function bb_scripts_styles()
{
    wp_enqueue_style('bb-styles', get_template_directory_uri() . '/css/style/styles.min.css?12', false, null);
    wp_enqueue_style('bb-main', get_template_directory_uri() . '/css/style/main.css?' . rand(1, 100000000000), false, null);
    wp_enqueue_style('bb-media', get_template_directory_uri() . '/css/style/media.css?' . rand(1, 100000000000), false, null);
    wp_enqueue_style('bb-add-style', get_template_directory_uri() . '/css/style/add-style.css?' . rand(1, 100000000000), false, null);

    // отменяем зарегистрированный jQuery
    wp_deregister_script('jquery-core');
    wp_deregister_script('jquery');
    // регистрируем jQuery
    wp_register_script('jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, null, false);
    wp_register_script('jquery', false, ['jquery-core'], null, false);
    // подключаем jQuery
    wp_enqueue_script('jquery');


    // scripts
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/min/scripts.min.js', ['jquery'], null, true);

    // my
    // wp_enqueue_script('my', get_template_directory_uri() . '/js/my.js?73' . rand(1, 100000000000), ['jquery'], null, true);
    wp_enqueue_script('script-min', get_template_directory_uri() . '/js/min/script-min.js', ['jquery'], null, true);


    // ACF map / marker cluster (скрыпты для работы ACF map)
    if (isset($GLOBALS['acf_map'])) {
        wp_enqueue_script('yandex.maps.api', 'https://api-maps.yandex.ru/2.1/?apikey=key&lang=ru_RU', null, true);
        wp_enqueue_script('jquery.acf.map', get_template_directory_uri() . '/js/min/jquery.acf.map-min.js?' . rand(1, 100000000000), ['jquery'], null, true);
    }

    // Включить функцию ответа на комментарий
    if (is_singular() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Отключаем лишний скрипт
    wp_deregister_script('wp-embed');
}

add_theme_support('post-thumbnails');

register_sidebar(array(
    'name' => __('Main menu'),
    'id' => 'main_menu',
    'before_widget' => '',
    'after_widget' => '',
));

register_sidebar(array(
    'name' => __('Footer menu'),
    'id' => 'footer_menu',
    'before_widget' => '',
    'after_widget' => '',
));

register_sidebar(array(
    'name' => __('Language menu'),
    'id' => 'language_menu',
    'before_widget' => '',
    'after_widget' => '',
));

function glob_lng()
{
    return 'tj';
}

function home_link()
{
    switch (pll_current_language()) {
        case 'ru':
            return '/' . glob_lng();
        default:
            return '/' . glob_lng() . '/' . pll_current_language();
    }
}

function get_logo()
{
    switch (pll_current_language()) {
        case 'en':
            return '/' . glob_lng() . '/wp-content/uploads/2023/08/logo_en.svg';
        default:
            return '/' . glob_lng() . '/wp-content/uploads/2023/07/logo.svg';
    }
}

function get_logo_circle()
{
    return '/' . glob_lng() . '/wp-content/uploads/2023/08/logo_circle.svg';
}

function get_phone()
{
    return '<a class="tel" href="tel:+996503286111">+996 503 286 111</a>';
}

function get_viber()
{
    return 'viber://pa?chatURI=79111022302';
}

function get_whatsapp()
{
    return 'https://wa.me/79111022302';
}

function get_telegram()
{
    return 'https://t.me/embrymama';
}

function get_contacts()
{
    switch (pll_current_language()) {
        case 'en':
            $c[] = ['name' => 'Kyrgyz Republic', 'cords' => '[42.88741471410988,74.60214886254876]', 'phone' => '+996 503 286 111', 'phone_link' => '+996503286111', 'address' => 'Kyrgyz Republic'];
            break;
        case 'ky':
            $c[] = ['name' => 'Кыргыз Республикасы', 'cords' => '[42.88741471410988,74.60214886254876]', 'phone' => '+996 503 286 111', 'phone_link' => '+996503286111', 'address' => 'Кыргыз Республикасы'];
            break;
        default:
            $c[] = ['name' => 'Кыргызская Республика', 'cords' => '[42.88741471410988,74.60214886254876]', 'phone' => '+996 503 286 111', 'phone_link' => '+996503286111', 'address' => 'Кыргызская Республика'];
            break;
    }
    return $c;
}

function big_address()
{
    switch (pll_current_language()) {
        case 'en':
            $c =
                '<p>
             <b>Company name in official language:</b> Limited Company
             responsibility "Useful Tourism" / LLC "Useful Tourism"
             </p>
             <p>
             <b>
             Brand name in the state language:</b>"Paidaluu tourism"
             zoopkerchiligi chektelgen koomu
             </p>
             <p>
             <b>
             Registered</b>by the Chui-Bishkek Department of Justice
             </p>
             <p>
             <b>
             Registration number:</b>223865-3301-LLC dated November 2, 2023
             </p>
             <p>
             <b>
             OKPO code:</b>32309584
             </p>
             <p>
             <b>
             INN:</b> 00211202310146
             </p>
             <p>
             <b>
             Registration number of the Federation Council:</b>104000649073
             </p>
             <p>
             <b>
             Legal address:</b>Kyrgyz Republic, Bishkek, Leninsky district, st. Akhunbaeva, 189-17, 0709616708
             </p>
             <p>
             <b>
             Actual address:</b>Kyrgyz Republic, Bishkek, Leninsky district, st. Akhunbaeva, 189-17, 0709616708
             </p>';
            break;
        case 'ky':
            $c = '<p>
                 <b>Компаниянын расмий тилде аталышы:</b> Жоопкерчилиги чектелген коом
                 жоопкерчилик "Пайдалы туризм" / ООО "Пайдалы туризм"
                 </p>
                 <p>
                 <b>
                 Мамлекеттик тилдеги фирмалык аталышы:</b>“Пайдалуу туризм”
                 жоопкерчилиги чектелген кому
                 </p>
                 <p>
                 <b>
                 Чүй-Бишкек юстиция башкармалыгында катталган
                 </p>
                 <p>
                 <b>
                 Каттоо номери: 223865-3301-ООО 02.11.2023-ж.
                 </p>
                 <p>
                 <b>
                 OKPO коду: 32309584
                 </p>
                 <p>
                 <b>
                 ИНН: 00211202310146
                 </p>
                 <p>
                 <b>
                 SF каттоо номери: 104000649073
                 </p>
                 <p>
                 <b>
                 Jur. дареги:</b>Кыргыз Республикасы, Бишкек шаары, Ленин району, көч. Ахунбаева, 189-17, 0709616708
                 </p>
                 <p>
                 <b>
                 Иш жүзүндө дареги: Кыргыз Республикасы, Бишкек шаары, Ленин району, көч. Ахунбаева, 189-17, 0709616708
                 </p>';
            break;
        default:
            $c = '<p>
                                        <b>Фирменное наименование на официальном языке:</b> Общество с ограниченной
                                        ответственностью «Полезный туризм» / ОсОО «Полезный туризм»
                                    </p>
                                    <p>
                                        <b>
                                            Фирменное наименование на государственном языке:</b> «пайдалуу туризм»
                                        жоопкерчилиги чектелген коому
                                    </p>
                                    <p>
                                        <b>
                                            Зарегистрировано</b> Чуй-Бишкекским управлением юстиции
                                    </p>
                                    <p>
                                        <b>
                                            Регистрационный номер:</b> 223865-3301-ООО от 02.11.2023 г.
                                    </p>
                                    <p>
                                        <b>
                                            Код ОКПО:</b> 32309584
                                    </p>
                                    <p>
                                        <b>
                                            ИНН:</b> 00211202310146
                                    </p>
                                    <p>
                                        <b>
                                            Регистрационный номер СФ:</b> 104000649073
                                    </p>
                                    <p>
                                        <b>
                                            Юр. адрес:</b> Кыргызская Республика, г. Бишкек, Ленинский район, ул. Ахунбаева, 189-17, 0709616708
                                    </p>
                                    <p>
                                        <b>
                                            Фактический адрес:</b> Кыргызская Республика, г. Бишкек, Ленинский район, ул. Ахунбаева, 189-17, 0709616708
                                    </p>';
            break;
    }
    return $c;
}

function be_register_blocks()
{
    if (!function_exists('acf_register_block'))
        return;
    acf_register_block(array(
        'name' => 'block-left-img-right-text',
        'title' => __('Изображение слева текст справа'),
        'render_template' => 'parts/block-left-img-right-text.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-left-text-right-img',
        'title' => __('Изображение справа текст слева'),
        'render_template' => 'parts/block-left-text-right-img.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-questions',
        'title' => __('Вопросы'),
        'render_template' => 'parts/block-questions.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-contact-form',
        'title' => __('Форма связи'),
        'render_template' => 'parts/block-contact-form.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-icons-line',
        'title' => __('Иконки'),
        'render_template' => 'parts/block-icons-line.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-etaps',
        'title' => __('Этапы'),
        'render_template' => 'parts/block-etaps.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-docs',
        'title' => __('Документы'),
        'render_template' => 'parts/block-docs.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-about',
        'title' => __('О эмбримаме'),
        'render_template' => 'parts/block-about.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-numbers-line',
        'title' => __('Иконки - номера'),
        'render_template' => 'parts/block-numbers-line.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-join-us',
        'title' => __('Присоединяйтесь'),
        'render_template' => 'parts/block-join-us.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-payment',
        'title' => __('Выплаты'),
        'render_template' => 'parts/block-payment.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-payment-donor',
        'title' => __('Выплаты донору'),
        'render_template' => 'parts/block-payment-donor.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));

    acf_register_block(array(
        'name' => 'block-icons-treb',
        'title' => __('Иконки - требования'),
        'render_template' => 'parts/block-icons-treb.php',
        'category' => 'blocks',
        'mode' => 'edit',
    ));
}

add_action('acf/init', 'be_register_blocks');

function be_register_langs()
{
    require_once get_template_directory() . '/reg_lang/reg_lang.php';
}

add_action('init', 'be_register_langs');

add_filter('pll_rel_hreflang_attributes', function ($hreflangs) {
    $my_hreflangs['ru-TJ'] = $hreflangs['ru'];
    unset($hreflangs['ru']);
    $my_hreflangs['en-TJ'] = $hreflangs['en'];
    unset($hreflangs['en']);
    return array_merge($my_hreflangs, $hreflangs);
}, 10, 1);

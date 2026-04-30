<?php
// Подключаем стили и скрипты для фронта
add_action('wp_enqueue_scripts', 'bb_scripts_styles');
function bb_scripts_styles()
{
    // отменяем зарегистрированный jQuery
    wp_deregister_script('jquery-core');
    wp_deregister_script('jquery');
    // регистрируем jQuery
    wp_register_script('jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, null, false);
    wp_register_script('jquery', false, ['jquery-core'], null, false);
    // подключаем jQuery
    wp_enqueue_script('jquery');


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
        case 'tg':
            return '/' . glob_lng() . '/wp-content/uploads/2023/08/logo_en.svg';
        default:
            return '/' . glob_lng() . '/wp-content/uploads/2023/07/logo.svg';
    }
}

function get_logo_circle()
{
    return '/' . glob_lng() . '/wp-content/uploads/2023/08/logo_circle.svg';
}

function get_whatsapp()
{
    return 'https://wa.me/79111022302';
}

function get_telegram()
{
    return 'https://t.me/embrymama';
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

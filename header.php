<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/css/grid.css?2" />
    <link rel="stylesheet"
        href="/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/style.css?<?php echo rand(1, 1000000000); ?>">
    <style>
        a[href="<?php echo home_link(); ?>"] {
            border-color: #F8C7B2 !important;
            color: #F8C7B2 !important;
        }

        .input_item.validate.invalid input {
            border-color: #ff7272;
        }

        .input_item.validate.invalid:after {
            content: ' <?php pll_e('Обязательное поле') ?>';
            font-size: 12px;
            color: #ff7272;
        }

        .input_item.validate.invalid.email:after {
            content: '<?php pll_e('Неверный формат почты') ?>';
        }

        @font-face {
            font-family: 'Averta CY';
            src: url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Regular.eot');
            src: url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Regular.eot?#iefix') format('embedded-opentype'),
                url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Regular.woff') format('woff'),
                url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: fallback;
        }

        @font-face {
            font-family: 'Averta CY';
            src: url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Semibold.eot');
            src: url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Semibold.eot?#iefix') format('embedded-opentype'),
                url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Semibold.woff') format('woff'),
                url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Semibold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: fallback;
        }

        @font-face {
            font-family: 'Averta CY';
            src: url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Bold.eot');
            src: url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Bold.eot?#iefix') format('embedded-opentype'),
                url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Bold.woff') format('woff'),
                url('/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/fonts/AvertaCY-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: fallback;
        }
    </style>
    <link rel="stylesheet" href="/wp-content/themes/embrymama/css/intlTelInput.css?15">
    <script src="/wp-content/themes/embrymama/js/intlTelInput.js?9"></script>
    <script src="/wp-content/themes/embrymama/js/utils.js?5"></script>
    <style>
        .iti__selected-flag {
            display: flex;
            align-items: center;
            position: absolute;
            top: 4px;
            left: 0;
            cursor: pointer;
        }

        input[name="phone"],
        input#phone_call {
            padding-left: 40px;
        }

        .iti {
            width: 100%;
        }

        ul#country-listbox {
            position: absolute;
            max-height: 300px;
            min-width: 100%;
            background: #f9f9fb;
            z-index: 9;
            width: auto;
            top: 34px;
            border-radius: 7px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        ul#country-listbox li {
            cursor: pointer;
        }

        .input_item .iti span {
            position: unset !important;
            font-weight: normal;
            font-size: 14px;
            line-height: 18px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            letter-spacing: 0.05em;
            text-transform: unset;
            color: #323f4b;
        }
    </style>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5SF3TMVN');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Roistat Counter Start -->
    <script>
        (function(w, d, s, h, id) {
            w.roistatProjectId = id;
            w.roistatHost = h;
            var p = d.location.protocol == "https:" ? "https://" : "http://";
            var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/" + id + "/init?referrer=" + encodeURIComponent(d.location.href);
            var js = d.createElement(s);
            js.charset = "UTF-8";
            js.async = 1;
            js.src = p + h + u;
            var js2 = d.getElementsByTagName(s)[0];
            js2.parentNode.insertBefore(js, js2);
        })(window, document, 'script', 'cloud.roistat.com', '9af04a888be11a3ccd2d0dd92d22d2d3');
    </script>
    <!-- Roistat Counter End -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=106490259', 'ym');

        ym(106490259, 'init', {
            ssr: true,
            webvisor: true,
            clickmap: true,
            ecommerce: "dataLayer",
            referrer: document.referrer,
            url: location.href,
            accurateTrackBounce: true,
            trackLinks: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/106490259" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5SF3TMVN"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 header-container">
                    <a href="<?php echo home_link(); ?>" class="logo">
                        <img src="<?php echo get_logo(); ?>" alt="logo">
                    </a>
                    <div class="language-container">
                        <?php if (!dynamic_sidebar('Language menu')) : ?><?php endif; ?>
                    </div>
                    <div class="menu-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                        <?php pll_e('Меню') ?>
                    </div>
                    <div class="contacts-container">
                        <div class="socials">
                            <button class="requestCall" onclick="$('.modal_call').show()">
                                <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/07/phone.svg" alt="phone">
                            </button>
                            <a class="link" href="<?php echo get_viber(); ?>" target="_blank">
                                Viber
                            </a>
                            <span>|</span>
                            <a class="link" href="<?php echo get_whatsapp(); ?>" target="_blank">
                                Whatsapp
                            </a>
                            <span>|</span>
                            <a class="link" href="<?php echo get_telegram(); ?>" target="_blank">
                                Telegram
                            </a>
                        </div>
                    </div>
                    <div class="head_contact_info">
                        <button class="normb color2 modal_contact"><?php pll_e('Получить консультацию') ?></button>
                    </div>
                    <div class="open_nav"></div>
                </div>
                <div class="col-md-12 header-menu">
                    <?php if (!dynamic_sidebar('Main menu')) : ?><?php endif; ?>
                    <div class="contacts_opened_menu opened_menu">
                        <div class="socials">
                            <button class="requestCall" onclick="$('.modal_call').show()">
                                <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/07/phone.svg" alt="phone">
                            </button>
                            <a class="link" href="<?php echo get_viber(); ?>">
                                Viber
                            </a>
                            <span>|</span>
                            <a class="link" href="<?php echo get_whatsapp(); ?>">
                                Whatsapp
                            </a>
                            <span>|</span>
                            <a class="link" href="<?php echo get_telegram(); ?>">
                                Telegram
                            </a>
                        </div>
                    </div>

                    <div class="head_contact_info_opened_menu opened_menu">
                        <button class="normb color2 modal_contact"><?php pll_e('Получить консультацию') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
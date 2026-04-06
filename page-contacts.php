<?php
// Template name: Contacts
get_header();
?>
    <div class="intro_section" style="background: url(<?php the_field('bg_main'); ?>">
        <div class="container">
            <!-- Хлебные крошки -->
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (function_exists('yoast_breadcrumb') && !is_front_page()) {
                        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                    }
                    ?>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="contact_section">
        <div class="cityWrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <ul class="contact_list">
                            <?php $c = get_contacts();
                            foreach ($c as $v) { ?>
                                <li class="city">
                                    <h3><?php echo $v['name']; ?></h3>
                                    <div class="line">
                                        <div class="img">
                                            <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/07/cont1.svg" alt="cont1">
                                        </div>
                                        <p><?php echo $v['address']; ?></p>
                                    </div>
                                    <div class="line">
                                        <div class="img">
                                            <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/07/cont2.svg"
                                                 alt="cont2">
                                        </div>
                                        <div>
                                            <a href="tel:<?php echo $v['phone_link']; ?>"
                                               class="phone_foot"><?php echo $v['phone']; ?></a>
                                        </div>
                                    </div>

                                    <?php echo big_address(); ?>

                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="map"></div>
    </div>

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=6f2fe3e0-763e-4e71-9caf-ed761be8436d"
            type="text/javascript"></script>
    <script>
        <?php  $c = get_contacts(); ?>
        ymaps.ready(function () {
            var myMap = new ymaps.Map('map', {
                center: <?php echo $c[0]['cords'] ?>,
                zoom: 10,
                controls: ['smallMapDefaultSet']
            }, {
                searchControlProvider: 'yandex#search'
            });

            <?php foreach ($c as $v) { ?>
            myMap.geoObjects
                .add(new ymaps.Placemark( <?php echo $v['cords'] ?>, {}, {
                    iconLayout: 'default#image',
                    iconImageHref: '/<?php echo glob_lng() ?>/wp-content/uploads/2023/07/map.svg',
                    iconImageSize: [50, 50],
                    iconImageOffset: [-25, -50]
                }));
            <?php } ?>

            myMap.behaviors.disable('scrollZoom');
        });
    </script>
<?php
get_footer();
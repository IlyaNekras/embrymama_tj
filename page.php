<?php
get_header();

?>
<div class="intro_section" style="background: url(<?php the_field('bg_main'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (function_exists('yoast_breadcrumb') && !is_front_page()) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
                <h1><?php the_title(); ?></h1>
                <?php if (get_field('bg_main')) { ?>
                    <p class="after_h1"><?php pll_e('Главная - девиз') ?></p>
                    <a class="normb modal_contact"><?php pll_e('Получить консультацию') ?></a>
                    <a class="normb color2 modal_contact triggerSM">
                        <?php pll_e('Стать сурмамой') ?>
                    </a>
                <?php } ?>
            </div>
        </div>

        <?php if (get_field('bg_main')) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panelBot">
                        <div class="preim_panel_wrp adv">
                            <div class="preim_item modalTrigger">
                                <div class="preim_img"><img
                                        src="/wp-content/uploads/2025/04/kontrol.png"
                                        alt="kontrol">
                                </div>
                                <p><?php pll_e('Главная - преимущество 1') ?></p>
                            </div>
                            <div class="preim_item modalTrigger">
                                <div class="preim_img"><img
                                        src="/wp-content/uploads/2025/04/zakonodatelstvo-rf.png"
                                        alt="zakonodatelstvo-rf"></div>
                                <p><?php pll_e('Главная - преимущество 2') ?></p>
                            </div>
                            <div class="preim_item modalTrigger">
                                <div class="preim_img"><img
                                        src="/wp-content/uploads/2025/04/konfidenczialno.png"
                                        alt="konfidenczialno"></div>
                                <p><?php pll_e('Главная - преимущество 3') ?></p>
                            </div>
                            <div class="preim_item modalTrigger">
                                <div class="preim_img"><img
                                        src="/wp-content/uploads/2025/04/opyt-vedeniya.png"
                                        alt="opyt-vedeniya"></div>
                                <p><?php pll_e('Главная - преимущество 4') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="clean_intro_section"></div>

<div class="content_section">
    <?php the_content(); ?>
</div>
<?php
get_footer();

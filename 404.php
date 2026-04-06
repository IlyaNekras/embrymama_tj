<?php
get_header();
?>
    <div class="intro_section" style="min-height: calc(100vh - 397px);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (function_exists('yoast_breadcrumb') && !is_front_page()) {
                        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                    }
                    ?>
                    <h1 style="font-size: 120px; margin: 80px 0 40px;">404</h1>
                    <p class="after_h1"><?php pll_e('Страница не найдена') ?></p>
                    <a class="normb" href="<?php echo home_link(); ?>"
                       style="color: #fff !important;"><?php pll_e('На главную'); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
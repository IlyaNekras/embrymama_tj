<?php
// Template name: Privacy
get_header();
?>
    <div class="intro_section">
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
    <div class="content_section" style="margin-bottom: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
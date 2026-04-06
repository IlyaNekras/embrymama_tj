<div class="block" style="margin-top: <?php the_field('otstup_do') ?>px; margin-bottom: <?php the_field('otstup_posle') ?>px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 head_of_docs">
                <?php the_field('content') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-12 left mobc">
                <div class="rect_img"><span
                            style="background-image: url('/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/ur-img.jpg')"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-xs-12">
                <?php if (have_rows('files')) : ?>
                    <ul class="document_list">
                        <?php while (have_rows('files')) : the_row(); ?>
                            <li><a href="<?php the_sub_field('file') ?>"
                                   target="_blank"><?php the_sub_field('name') ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

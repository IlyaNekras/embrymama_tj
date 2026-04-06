<div class="block block-3" style="margin-top: <?php the_field('otstup_do') ?>px; margin-bottom: <?php the_field('otstup_posle') ?>px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?php pll_e('Этапы программы') ?></h2>
            </div>
        </div>
        <ul class="row etaps_flex">
            <?php if (have_rows('steps')) :
                $i = 1; ?>
                <?php while (have_rows('steps')) : the_row(); ?>
                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="etaps_wrp">
                        <div class="etap_item">
                            <p class="num"><?php echo $i < 10 ? '0' : '';
                                echo $i; ?></p>
                            <p><?php the_sub_field('title') ?></p>
                            <span><?php the_sub_field('content') ?></span>
                            <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/qu_more.svg" alt="qu_more">
                        </div>
                    </div>
                </li>
                <?php $i++;
            endwhile; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>

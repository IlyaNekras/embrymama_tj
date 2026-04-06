<div class="block block_2" style="background: url(<?php the_field('fon') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <h2><?php the_field('title') ?></h2>
                <div><?php the_field('description') ?></div>
                <?php if (have_rows('items')) : ?>
                    <div class="gon_flex">
                        <?php while (have_rows('items')) : the_row(); ?>
                            <div class="gon_item">
                                <p><?php the_sub_field('price') ?></p>
                                <span><?php the_sub_field('text') ?></span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('items_2')) : ?>
                    <div class="gon_flex">
                        <?php while (have_rows('items_2')) : the_row(); ?>
                            <div class="gon_item">
                                <p><?php the_sub_field('price') ?></p>
                                <span><?php the_sub_field('text') ?></span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <button class="normb color2" onclick="$('.modal_call').show()" style="width: auto; margin-top: 20px; padding-left: 15px; padding-right: 15px;"><?php pll_e('Заполнить анкету') ?></button>
                <div><?php the_field('description_2') ?></div>

            </div>
        </div>
    </div>
</div>


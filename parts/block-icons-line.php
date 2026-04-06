<div class="block block-icons"
     style="margin-top: <?php the_field('otstup_do') ?>px; margin-bottom: <?php the_field('otstup_posle') ?>px;">
    <div class="container icons">
        <div class="row">
            <div class="col-md-12">
                <div class="preim_panel_wrp"
                     style="background: <?php echo get_field('fon') ? get_field('fon') : '#fff'; ?>">
                    <?php
                    $icons = get_field('ikonka');
                    foreach ($icons as $i) { ?>
                        <div class="preim_item">
                            <div class="preim_img"><img src="<?php echo $i['izobrazhenie'] ?>" alt="preim_img"></div>
                            <p><?php echo $i['tekst'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

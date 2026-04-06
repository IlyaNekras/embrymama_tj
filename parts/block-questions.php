<div class="block" style="margin-top: <?php the_field('otstup_do') ?>px; margin-bottom: <?php the_field('otstup_posle') ?>px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (have_rows('faq')) : ?>
                    <div class="qu_wrp">
                        <?php while (have_rows('faq')) : the_row(); ?>
                            <div class="qu_item">
                                <div class="qu_header">
                                    <p><?php the_sub_field('title') ?></p>
                                </div>
                                <div class="qu_answer">
                                    <div class="answer_text">
                                        <?php the_sub_field('content') ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_header() ?>
<section class="page-content">
        <div class="grid-container">
            <div class="grid-x grid-margin-x blog-lists">

                <?php while ( have_posts() ) : the_post(); ?>

                    <div class="cell large-4 medium-6 small-12">
                        <article>
                            <div class="wp-block-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            
                            <h5><a href="<?= get_the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <small>
                                <?php 
                                    $controlPostCategory = get_the_category(get_the_ID());
                                    $postCategoryLength = count($controlPostCategory);
                                    $postCtr = 1;

                                ?>
                                <?php foreach ($controlPostCategory as $pc): ?>
                                    <?= $pc->name ?><?= $postCtr != $postCategoryLength ? ',' :''; ?>
                                <?php $postCtr++; endforeach; ?>
                            </small>
                        </article>
                    </div>

                <?php endwhile; ?>
            </div>
            <?php if (paginate_links()): ?>
                <div class="text-center">
                    <div id="post-pagination" style="display: none">
                        <?php  echo paginate_links(); ?>
                    </div>
                    <div class="wp-block-button">
                        <a class="wp-block-button__link" href="javascript:;" id="loadMorePosts">SEE MORE</a>
                    </div>
                </div>
            <?php endif ?>
            
        </div>     
    </section>

<?php get_footer() ?>
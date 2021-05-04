<?php get_header(); ?>

<main>

    <div class="content">
        <h1>Main content</h1>
        <?php
        $paged = (get_query_var('page')) ? get_query_var('page') : 1; //notice this
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        //query 5 posts
        query_posts("posts_per_page=1&paged=$paged");
        ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="entry">
                <div class="single_entry">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_content(__('(more...)')); ?></p>

                </div><!-- fin expert -->
            </div><!-- fin entry -->

        <?php endwhile; wp_reset_query();	?>
        <?php if(function_exists('wp_pagenavi')) { ?>
            <div id="pagination">
              <h2 style="text-align: center"> <?php wp_pagenavi();  ?></h2>
            </div>
        <?php } ?>
    </div>

        <?php get_sidebar(); ?>
        <div class="delimetr"></div>
    <?php get_footer(); ?>

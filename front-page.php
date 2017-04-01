<?php get_header(); ?>

    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <?php if ( is_active_sidebar( 'front-top' ) ) : ?>
                <div id="secondary" class="widget-area" role="complementary">
                  <?php dynamic_sidebar( 'front-top' ); ?>
                </div>
            <?php endif; ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
        </div> 
    </div>
    <br>
    <hr>
    <br>
    <div class="row">
        <div class="col-sm-6 col-xs-12 text-center">
			<div class="blog-updates blog-news">

				<h2><a href="<?php echo "./category/".get_option('front_left_block'); ?>"><?php echo ucfirst(get_option('front_left_block')); ?></a></h2>
				<?php echo wpb_postsbycategory(get_option('front_left_block')); ?>
			</div>
            <div class="vertical-line"></div>
        </div>
        <div class="col-sm-6 col-xs-12 text-center">
			<div class="blog-updates blog-events">
                <h2><a href="<?php echo "./category/".get_option('front_right_block'); ?>"><?php echo ucfirst(get_option('front_right_block')); ?></a></h2>
				<?php echo wpb_postsbycategory(get_option('front_right_block')); ?>
			</div>
        </div>
    </div>

<?php get_footer(); ?>
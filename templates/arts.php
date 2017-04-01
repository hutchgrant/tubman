<?php /* Template Name: Arts */ 
get_header(); 
 ?>
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<?php if ( is_active_sidebar( 'arts-top' ) ) : ?>
	            <div id="secondary" class="widget-area" role="complementary">
	              <?php dynamic_sidebar( 'arts-top' ); ?>
	            </div>
            <?php endif; ?>
            <hr>
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					 the_content();
				endwhile;  else: ?>
				<p><?php _e('Sorry, this page does not exist.'); ?></p>
			<?php endif; ?>
			<br>
			<hr>
			<?php if ( is_active_sidebar( 'arts-btm' ) ) : ?>
	            <div id="secondary" class="widget-area" role="complementary">
	              <?php dynamic_sidebar( 'arts-btm' ); ?>
	            </div>
            <?php endif; ?>		
		</div> 
	</div>
	<br><br>
<?php get_footer(); ?>
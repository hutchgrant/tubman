<?php /* Template Name: half-page */ 
get_header(); 
 ?>
	<div class="row">
		<div class="col-sm-9 col-xs-12 main-page">
		<br><br>
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					 the_content();
				endwhile;  else: ?>
				<p><?php _e('Sorry, this page does not exist.'); ?></p>
			<?php endif; ?>
		</div> 
        <?php get_sidebar(); ?>	
	</div>
	<br><br>
<?php get_footer(); ?>
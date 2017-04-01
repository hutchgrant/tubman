<?php /* Template Name: full-width */ 
get_header(); 
 ?>

	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					 the_content();
				endwhile;  else: ?>
				<p><?php _e('Sorry, this page does not exist.'); ?></p>
			<?php endif; ?>		
		</div> 
	</div>
	<br><br>
<?php get_footer(); ?>
<?php get_header(); ?>

	<div class="row">
		<div class="col-sm-9 col-xs-12">

			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'content-single', get_post_format() ); ?>
		  	<?php endwhile; else: ?>
				<p><?php _e('Sorry, this page does not exist.'); ?></p>
			<?php endif; ?>

		</div> 
			<?php get_sidebar(); ?>	
	</div> 

<?php get_footer(); ?>
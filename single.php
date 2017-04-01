<?php get_header(); ?>
	<div class="row">
		<div class="col-sm-9 blog-main">

			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'content-single', get_post_format() );
				endwhile;  else: ?>
				<p><?php _e('Sorry, this page does not exist.'); ?></p>
			<?php endif; ?>
		</div> 
		    <?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
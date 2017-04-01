<div class="blog-post">
	<h2 class="blog-post-title"><?php the_title(); ?></h2>
	<p class="blog-post-meta"><?php echo get_the_date( get_option('date_format') ); ?></p>
		<?php the_content(); ?>

		<?php
		$categories_list = get_the_category_list( _x( ', ', 'used between list items, there is a space after the comma', 'tubman' ) );
		$tags_list = get_the_tag_list( '', _x( ', ', 'used between list items, there is a space after the comma', 'tubman' ) );
		
		if ( $categories_list )
			printf( '<span class="cat-links block">' . __( 'Posted in %1$s.', 'tubman' ) . '</span>', $categories_list);
		if ( $tags_list )
			printf( '<span class="tag-links block">' . __( ' Tagged %1$s.', 'tubman' ) . '</span>', $tags_list);
		?>
		<br>
		<div class="prev_next">
		<?php 
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		if (is_single() && !empty( $prev_post )): ?>
			<div class="prev_post">				
				<?php previous_post_link( '%link', '<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous', TRUE ); ?>
			</div>
		<?php endif;
		if (is_single() && !empty( $next_post )): ?>
			<div class="next_post">
				<?php next_post_link( '%link', 'Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>', TRUE ); ?>
			</div>
		<?php endif; ?>
		</div>
</div>
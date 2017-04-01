<div class="blog-post">
	<h2 class="blog-archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p class="blog-post-meta"><?php echo get_the_date( get_option('date_format') ); ?></p>
	<?php the_excerpt(); ?>
	<?php
	    if(!is_category()){
			$categories_list = get_the_category_list( _x( ', ', 'used between list items, there is a space after the comma', 'tubman' ) );
			$tags_list = get_the_tag_list( '', _x( ', ', 'used between list items, there is a space after the comma', 'tubman' ) );
			
			if ( $categories_list ){
				printf( '<span class="cat-links block">' . __( 'Posted in %1$s.', 'tubman' ) . '</span>', $categories_list );
			}
			if ( $tags_list ){
				printf( '<span class="tag-links block">' . __( ' Tagged %1$s.', 'tubman' ) . '</span>', $tags_list);
			}
		}
	?>
</div>
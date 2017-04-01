<?php get_header(); ?>
	<div class="row">
		<div class="col-sm-9 col-xs-12">
		<article id="post-0" class="post error404 not-found">
			<header class="page-header text-center">
				<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'tubman' ); ?></h1>
			</header><!-- .page-header -->

			<div class="entry-content">
				<p class="text-center"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links on the right, can help.', 'tubman' ); ?></p>

				<?php get_search_form(); ?>
				<br>
			</div>
		</article>
		<br>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>